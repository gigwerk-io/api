// This block tells Terraform that we're going to provision AWS resources.
provider "aws" {
    region = "us-east-1"
    access_key = "{ACCESS_KEY}"
    secret_key = "{SECRET_KEY}"
}

// We'll also need the root domain (also known as zone apex or naked domain).
variable "root_domain_name" {
    default = "gigwerk.io"
}

// Create a variable for our domain name because we'll be using it a lot.
variable "application_domain" {
    default = "{BUSINESS_DOMAIN}"
}

resource "aws_s3_bucket" "www" {
    region = "us-east-1"
    bucket = "${var.application_domain}"
    acl    = "public-read"
    policy = <<POLICY
{
  "Version":"2012-10-17",
  "Statement":[
    {
      "Sid":"AddPerm",
      "Effect":"Allow",
      "Principal": "*",
      "Action":["s3:GetObject"],
      "Resource":["arn:aws:s3:::${var.application_domain}/*"]
    }
  ]
}
POLICY
    // S3 understands what it means to host a website.
    website {
        index_document = "index.html"
        error_document = "index.html"
    }
}

// Retrieve the certificate we generated on step 0.
data "aws_acm_certificate" "ssl_cert" {
    domain   = "*.${var.root_domain_name}"
    statuses = ["ISSUED"]
}

/**
	Define CloudFront Distribution
    - It will use the SSL certificate
    - It will redirect all the http traffic to https.
*/
resource "aws_cloudfront_distribution" "frontend_cloudfront_distribution" {
    origin {
        custom_origin_config {
            http_port              = "80"
            https_port             = "443"
            origin_protocol_policy = "http-only"
            origin_ssl_protocols   = ["TLSv1", "TLSv1.1", "TLSv1.2"]
        }
        domain_name = "${aws_s3_bucket.www.website_endpoint}"
        origin_id   = "${var.application_domain}"
    }

    enabled             = true
    default_root_object = "index.html"

    default_cache_behavior {
        viewer_protocol_policy = "redirect-to-https"
        compress               = true
        allowed_methods        = ["GET", "HEAD"]
        cached_methods         = ["GET", "HEAD"]
        target_origin_id       = "${var.application_domain}"
        min_ttl                = 0
        default_ttl            = 86400
        max_ttl                = 31536000

        forwarded_values {
            query_string = false
            cookies {
                forward = "none"
            }
        }
    }

    custom_error_response {
        error_caching_min_ttl = 3000
        error_code            = 404
        response_code         = 200
        response_page_path    = "/index.html"
    }

    custom_error_response {
        error_caching_min_ttl = 3000
        error_code            = 403
        response_code         = 200
        response_page_path    = "/index.html"
    }

    aliases = ["${var.application_domain}"]

    restrictions {
        geo_restriction {
            restriction_type = "none"
        }
    }

    viewer_certificate {
        acm_certificate_arn = "${data.aws_acm_certificate.ssl_cert.arn}"
        ssl_support_method  = "sni-only"
    }
}

data "aws_route53_zone" "zone" {
    name         = "${var.root_domain_name}"
    private_zone = false
}

resource "aws_route53_record" "frontend_record" {
    zone_id = "Z08375183E6H5RYQ43OXI"
    name    = "${var.application_domain}"
    type    = "A"
    alias {
        name = "${aws_cloudfront_distribution.frontend_cloudfront_distribution.domain_name}"
        zone_id = "${aws_cloudfront_distribution.frontend_cloudfront_distribution.hosted_zone_id}"
        evaluate_target_health = false
    }
}
