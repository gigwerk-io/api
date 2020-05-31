<?php

namespace App\Events\Marketplace\Customer;

use App\Models\MarketplaceJob;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Approved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var MarketplaceJob
     */
    public $marketplaceJob;

    /**
     * @var User
     */
    public $freelancer;

    /**
     * Create a new event instance.
     *
     * @param MarketplaceJob $marketplaceJob
     * @param User $freelancer
     */
    public function __construct(MarketplaceJob $marketplaceJob, User $freelancer)
    {
        $this->marketplaceJob = $marketplaceJob;
        $this->freelancer = $freelancer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
