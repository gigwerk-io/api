<?php


namespace App\Enum\Marketplace;


class PerformableAction
{
    const JOB_IS_EDITABLE = 1; // possible actions: [view, edit, cancel]
    const JOB_CAN_BE_ACCEPTED = 2; // possible actions: [view, accept]
    const WORKER_IS_WAITING_FOR_CUSTOMER = 3; // possible actions: [view, withdraw]
    const NO_PERFORMABLE_ACTION = 4; // possible actions: [view]
    const WORKER_HAS_BEEN_APPROVED =  5;// possible actions: [view, chat, arrive, withdraw]
    const WORKER_IS_IN_PROGRESS = 6; // possible actions: [view, chat, complete]
    const CUSTOMER_NEEDS_TO_RESPOND = 7; // possible actions: [view, approve, reject, cancel]
    const CUSTOMER_WAITING_FOR_WORKER_ARRIVAL = 8; // possible actions: [view, cancel]
    const CUSTOMER_WAITING_FOR_WORKER_TO_FINISH = 9; // possible actions [view]
    const CUSTOMER_NEEDS_TO_REVIEW = 10; // possible actions [view, review]
    const JOB_IS_COMPLETE = 11; // possible actions: [view]
    const WORKER_IS_REJECTED = 12;
}
