<?php

namespace App\Events\Marketplace\Customer;

use App\Models\MarketplaceJob;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Cancelled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var MarketplaceJob
     */
    public $marketplaceJob;

    /**
     * Create a new event instance.
     *
     * @param MarketplaceJob $marketplaceJob
     */
    public function __construct(MarketplaceJob $marketplaceJob)
    {
        $this->marketplaceJob = $marketplaceJob;
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
