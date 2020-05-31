<?php


namespace App\Enum\Notification;


class MarketplaceMessage
{
    const JOB_REQUESTED = 'New Job Request 💰';
    const FREELANCER_ACCEPT = "Someone has accepted your job! 👀";
    const CUSTOMER_ACCEPT = "You've been selected for a job 😎🎉";
    const FREELANCER_ARRIVED = "Your freelancer has arrived! 📍";
    const FREELANCER_COMPLETE = "Your freelancer has marked your task as complete! Leave a review. ⭐";
    const CUSTOMER_COMPLETE =  "Your job has marked as completed ✅";
    const CUSTOMER_CANCEL = "We are sorry to inform you the customer has cancelled the job. 😟";
    const WAITING_FOR_REVIEW = "Your worker is waiting for your review ⏳";
}
