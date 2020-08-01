<?php


namespace App\Enum\Business;


class DeploymentStatus
{
    const QUEUED = 1;
    const PROCESSING = 2;
    const COMPLETED = 3;
    const FAILED = 4;
}
