<?php
if ( !function_exists('dollarsToCents') ) {

    function dollarsToCents($price)
    {
        return (int)$price * 100;
    }

}

if ( !function_exists('centsToDollars') ) {

    function centsToDollars($price)
    {
        return $price / 100;
    }

}
