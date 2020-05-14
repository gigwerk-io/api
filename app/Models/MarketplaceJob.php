<?php

namespace App\Models;

use App\Enum\Marketplace\PerformableAction;
use App\Enum\Marketplace\Status;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MarketplaceJob.
 *
 * @package namespace App\Models;
 */
class MarketplaceJob extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'category_id',
        'price',
        'description',
        'status_id',
        'intensity_id',
        'complete_before',
        'views',
        'image_one',
        'image_two',
        'image_three'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'intensity'];

    /**
     * A job has a single customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    /**
     * A job has at least one location.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne(MarketplaceLocation::class, 'marketplace_id');
    }

    /**
     * A job can have a corresponding payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'marketplace_id');
    }

    /**
     * A job can have a payout.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payout()
    {
        return $this->hasOne(Payout::class, 'marketplace_id');
    }

    /**
     * A job can have many proposals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposals()
    {
        return $this->hasMany(MarketplaceProposal::class, 'marketplace_id');
    }

    /**
     * A job has one current status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jobStatus()
    {
        return $this->hasOne(JobStatus::class, 'id', 'status_id');
    }

    /**
     * A job has an intensity level.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jobIntensity()
    {
        return $this->hasOne(JobIntensity::class, 'id', 'intensity_id');
    }

    /**
     * Get the name of the status
     *
     * @return mixed
     */
    public function getStatusAttribute()
    {
        return $this->jobStatus->name;
    }

    /**
     * Get the name of the
     *
     * @return mixed
     */
    public function getIntensityAttribute()
    {
        return $this->jobIntensity->name;
    }

    /**
     * @return bool
     */
    public function isComplete()
    {
        return $this->status_id === Status::COMPLETE;
    }

    /**
     * @return bool
     */
    public function isRequested()
    {
        return $this->status_id === Status::REQUESTED;
    }

    /**
     * @return bool
     */
    public function isInProgress()
    {
        return $this->status_id === Status::IN_PROGRESS;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isOwner($id)
    {
        return $this->customer_id === $id;
    }

    /**
     * @return bool
     */
    public function isAcceptable()
    {
        return !$this->proposals()->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::APPROVED)->exists();
    }

    /**
     * @return bool
     */
    public function isWithdrawable()
    {
        return in_array($this->status_id, [Status::PENDING_APPROVAL, Status::APPROVED]);
    }

    /**
     * @return bool
     */
    public function isArrivable()
    {
        return $this->status_id === Status::APPROVED;
    }

    /**
     * @return bool
     */
    public function isCompletable()
    {
        return $this->status_id === Status::IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function customerNeedsToRespond()
    {
        return $this->proposals()
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::PENDING)
            ->exists();
    }

    /**
     * @return bool
     */
    public function customerIsWaitingForWorker()
    {
        return $this->proposals()
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::APPROVED)
            ->whereNull('arrived_at')
            ->exists();
    }

    /**
     * @return bool
     */
    public function workerIsInProgress()
    {
        return $this->proposals()
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::APPROVED)
            ->whereNotNull('arrived_at')
            ->whereNull('completed_at')
            ->exists();
    }

    /**
     * @return bool
     */
    public function customerNeedsToReview()
    {
        return $this->proposals()
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::APPROVED)
            ->whereNotNull('arrived_at')
            ->whereNotNull('completed_at')
            ->whereNull('rating')
            ->exists();
    }

    /**
     * @param $workerId
     * @return bool
     */
    public function workerIsWaitingForCustomer($workerId)
    {
        return $this->proposals()
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::PENDING)
            ->where('user_id', '=', $workerId)
            ->exists();
    }

    /**
     * @param $workerId
     * @return bool
     */
    public function workerIsRejected($workerId)
    {
        return $this->proposals()
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::REJECTED)
            ->where('user_id', '=', $workerId)
            ->exists();
    }

    /**
     * @param $workerId
     * @return bool
     */
    public function workerIsApproved($workerId)
    {
        return $this->proposals()
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::APPROVED)
            ->where('user_id', '=', $workerId)
            ->whereNull('arrived_at')
            ->exists();
    }

    /**
     * @param $workerId
     * @return bool
     */
    public function workerHasArrived($workerId)
    {
        return $this->proposals()
            ->where('user_id', '=', $workerId)
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::APPROVED)
            ->whereNotNull('arrived_at')
            ->whereNull('completed_at')
            ->exists();
    }

    /**
     * @param $workerId
     * @return bool
     */
    public function workerIsWaitingForReview($workerId)
    {
        return $this->proposals()
            ->where('user_id', '=', $workerId)
            ->where('status_id', '=', \App\Enum\Marketplace\ProposalStatus::APPROVED)
            ->whereNotNull('arrived_at')
            ->whereNotNull('completed_at')
            ->whereNull('rating')
            ->exists();
    }

    /**
     * Get the performable customer action on the job.
     *
     * @return int
     */
    public function getPerformableCustomerAction()
    {
        if ($this->customerNeedsToRespond()) {
            return PerformableAction::CUSTOMER_NEEDS_TO_RESPOND;
        } elseif ($this->customerIsWaitingForWorker()) {
            return PerformableAction::CUSTOMER_WAITING_FOR_WORKER_ARRIVAL;
        } elseif ($this->customerNeedsToReview()) {
            return PerformableAction::CUSTOMER_NEEDS_TO_REVIEW;
        } elseif ($this->isComplete()) {
            return PerformableAction::JOB_IS_COMPLETE;
        } elseif ($this->workerIsInProgress()) {
            return PerformableAction::NO_PERFORMABLE_ACTION;
        } else {
            return PerformableAction::JOB_IS_EDITABLE;
        }
    }

    /**
     * Get the performable worker action on the job.
     *
     * @param $workerId
     * @return int
     */
    public function getPerformableWorkerAction($workerId)
    {
        if ($this->isRequested()) {
            return PerformableAction::JOB_CAN_BE_ACCEPTED;
        } elseif ($this->workerIsWaitingForCustomer($workerId)) {
            return PerformableAction::WORKER_IS_WAITING_FOR_CUSTOMER;
        } elseif ($this->workerIsApproved($workerId)) {
            return PerformableAction::WORKER_HAS_BEEN_APPROVED;
        } elseif ($this->workerHasArrived($workerId)) {
            return PerformableAction::WORKER_IS_IN_PROGRESS;
        } elseif ($this->workerIsWaitingForReview($workerId)) {
            return PerformableAction::NO_PERFORMABLE_ACTION;
        } elseif ($this->isComplete()) {
            return PerformableAction::JOB_IS_COMPLETE;
        } elseif ($this->workerIsRejected($workerId)) {
            return PerformableAction::WORKER_IS_REJECTED;
        } else {
            return PerformableAction::NO_PERFORMABLE_ACTION;
        }
    }
}
