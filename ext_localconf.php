<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

require_once(t3lib_extMgm::extPath('rn_base') . 'class.tx_rnbase.php');
tx_rnbase::load('tx_t3sponsors_util_ServiceRegistry');
tx_rnbase::load('tx_rnbase_util_SearchBase');

t3lib_extMgm::addService($_EXTKEY,  't3sponsors' /* sv type */,  'tx_t3sponsors_sv1_Sponsor' /* sv key */,
array(
'title' => 'Sponsoren', 'description' => 'Handles sponsors', 'subtype' => 'sponsor',
'available' => TRUE, 'priority' => 50, 'quality' => 50,
'os' => '', 'exec' => '',
'classFile' => t3lib_extMgm::extPath($_EXTKEY).'sv1/class.tx_t3sponsors_sv1_Sponsor.php',
'className' => 'tx_t3sponsors_sv1_Sponsor',
)
);

t3lib_extMgm::addService($_EXTKEY,  't3sponsors' /* sv type */,  'tx_t3sponsors_sv1_Category' /* sv key */,
array(
'title' => 'Sponsoren', 'description' => 'Handles sponsors', 'subtype' => 'category',
'available' => TRUE, 'priority' => 50, 'quality' => 50,
'os' => '', 'exec' => '',
'classFile' => t3lib_extMgm::extPath($_EXTKEY).'sv1/class.tx_t3sponsors_sv1_Category.php',
'className' => 'tx_t3sponsors_sv1_Category',
)
);

