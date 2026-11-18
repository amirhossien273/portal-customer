<?php

return [
    'min_users' => 5,
    'max_users' => 100,
    'default_users' => 5,
    'default_billing' => 'annual',
    'tiers' => [
        ['min' => 5, 'max' => 10, 'monthly' => 2_500_000, 'annual' => 2_200_000],
        ['min' => 11, 'max' => 15, 'monthly' => 2_200_000, 'annual' => 1_900_000],
        ['min' => 16, 'max' => 25, 'monthly' => 1_900_000, 'annual' => 1_600_000],
        ['min' => 26, 'max' => 100, 'monthly' => 1_600_000, 'annual' => 1_300_000],
    ],
];
