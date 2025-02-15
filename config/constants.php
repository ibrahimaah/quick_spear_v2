<?php 
return [
    'STATUS_NUMBER' => [
        'UNDER_REVIEW' => 0,
        'UNDER_DELIVERY' => 1,
        'DELIVERED' => 2,
        'REJECTED_WITHOUT_PAY' => 3,
        'REJECTED_WITH_PAY' => 4,
        'POSTPONED' => 5,
        'NO_RESPONSE' => 6,
        // 'RETURNED' => 7,
    ],

    'RETURNED_STATUSES' => [
        'REJECTED_WITHOUT_PAY' => 4,
        'REJECTED_WITH_PAY'    => 5,
        'NO_RESPONSE'          => 7,
        'CANCELED'             => 8,
    ],
];