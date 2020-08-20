<?php

namespace App\Enum\Notification;


class DeploymentMessage
{
    const FAILED = 'This deployment has failed';
    const SUCCESSFUL = 'This deployment has succeeded';
    const QUEUED = 'Your deployment has been queued';
    const PROCESSING = 'Your deployment has started building';
}

