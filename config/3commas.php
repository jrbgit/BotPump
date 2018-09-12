<?php

return [
    'root' => 'https://3commas.io',
    'user_deals' => [
        'end_point' => '/public/api/ver1/deals',
        'method' => 'GET',
        'security' => 'SIGNED'
    ],
    'update_max_safety_orders' => [
        'end_point' => '/public/api/ver1/deals/{deal_id}/update_max_safety_orders',
        'method' => 'POST',
        'security' => 'SIGNED'
    ],
];