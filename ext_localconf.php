<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

tx_rnbase::load('tx_t3sponsors_util_ServiceRegistry');
tx_rnbase::load('tx_rnbase_util_SearchBase');

tx_rnbase_util_Extensions::addService($_EXTKEY, 't3sponsors' /* sv type */, 'tx_t3sponsors_sv1_Sponsor' /* sv key */,
    array(
        'title' => 'Sponsoren', 'description' => 'Handles sponsors', 'subtype' => 'sponsor',
        'available' => true, 'priority' => 50, 'quality' => 50,
        'os' => '', 'exec' => '',
        'classFile' => tx_rnbase_util_Extensions::extPath($_EXTKEY).'sv1/class.tx_t3sponsors_sv1_Sponsor.php',
        'className' => 'tx_t3sponsors_sv1_Sponsor',
    )
);

tx_rnbase_util_Extensions::addService($_EXTKEY, 't3sponsors' /* sv type */, 'tx_t3sponsors_sv1_Category' /* sv key */,
    array(
        'title' => 'Sponsoren', 'description' => 'Handles sponsors categories', 'subtype' => 'category',
        'available' => true, 'priority' => 50, 'quality' => 50,
        'os' => '', 'exec' => '',
        'classFile' => tx_rnbase_util_Extensions::extPath($_EXTKEY).'sv1/class.tx_t3sponsors_sv1_Category.php',
        'className' => 'tx_t3sponsors_sv1_Category',
    )
);

tx_rnbase_util_Extensions::addService($_EXTKEY, 't3sponsors' /* sv type */, 'tx_t3sponsors_sv1_Trade' /* sv key */,
    array(
        'title' => 'Sponsoring-Trades', 'description' => 'Handles trades', 'subtype' => 'trade',
        'available' => true, 'priority' => 50, 'quality' => 50,
        'os' => '', 'exec' => '',
        'classFile' => tx_rnbase_util_Extensions::extPath($_EXTKEY).'sv1/class.tx_t3sponsors_sv1_Trade.php',
        'className' => 'tx_t3sponsors_sv1_Trade',
    )
);
