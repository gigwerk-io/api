<?php

namespace App\Events\Marketplace;

use App\Models\MarketplaceJob;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerHasRequested implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var MarketplaceJob
     */
    private $marketplaceJob;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MarketplaceJob $marketplaceJob)
    {
        $this->marketplaceJob = $marketplaceJob->load('customer.profile');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('marketplace.' . $this->marketplaceJob->business->unique_id);
    }

    public function broadcastAs()
    {
        return 'new-job';
    }
}
