<?php
if (!(defined('TYPO3') || defined('TYPO3_MODE'))) {
    exit('Access denied.');
}

$_EXTKEY = 't3sponsors';


\Sys25\RnBase\Utility\Extensions::addService($_EXTKEY, 't3sponsors' /* sv type */, 'tx_t3sponsors_sv1_Sponsor' /* sv key */,
    [
        'title' => 'Sponsoren', 'description' => 'Handles sponsors', 'subtype' => 'sponsor',
        'available' => true, 'priority' => 50, 'quality' => 50,
        'os' => '', 'exec' => '',
        'className' => 'tx_t3sponsors_sv1_Sponsor',
    ]
);

\Sys25\RnBase\Utility\Extensions::addService($_EXTKEY, 't3sponsors' /* sv type */, 'tx_t3sponsors_sv1_Category' /* sv key */,
    [
        'title' => 'Sponsoren', 'description' => 'Handles sponsors categories', 'subtype' => 'category',
        'available' => true, 'priority' => 50, 'quality' => 50,
        'os' => '', 'exec' => '',
        'className' => 'tx_t3sponsors_sv1_Category',
    ]
);

\Sys25\RnBase\Utility\Extensions::addService($_EXTKEY, 't3sponsors' /* sv type */, 'tx_t3sponsors_sv1_Trade' /* sv key */,
    [
        'title' => 'Sponsoring-Trades', 'description' => 'Handles trades', 'subtype' => 'trade',
        'available' => true, 'priority' => 50, 'quality' => 50,
        'os' => '', 'exec' => '',
        'className' => 'tx_t3sponsors_sv1_Trade',
    ]
);
