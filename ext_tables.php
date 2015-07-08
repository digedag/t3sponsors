<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

require_once(t3lib_extMgm::extPath('rn_base') . 'class.tx_rnbase.php');
tx_rnbase::load('tx_rnbase_util_TYPO3');
tx_rnbase::load('tx_rnbase_util_Extensions');

if(!tx_rnbase_util_TYPO3::isTYPO62OrHigher()) {
	// TCA registration for 4.5
	$TCA['tx_t3sponsors_companies'] = require t3lib_extMgm::extPath($_EXTKEY).'Configuration/TCA/tx_t3sponsors_companies.php';
	$TCA['tx_t3sponsors_categories'] = require t3lib_extMgm::extPath($_EXTKEY).'Configuration/TCA/tx_t3sponsors_categories.php';
}



////////////////////////////////
// Register plugin
////////////////////////////////
// Hide some fields
$TCA['tt_content']['types']['list']['subtypes_excludelist']['tx_t3sponsors']='layout,select_key,pages';

// Show tt_content-field pi_flexform
$TCA['tt_content']['types']['list']['subtypes_addlist']['tx_t3sponsors']='pi_flexform';

// Add flexform and plugin
t3lib_extMgm::addPiFlexFormValue('tx_t3sponsors','FILE:EXT:'.$_EXTKEY.'/flexform_main.xml');
t3lib_extMgm::addPlugin(Array('LLL:EXT:'.$_EXTKEY.'/locallang_db.php:plugin.t3sponsors.label','tx_t3sponsors'));
# Add plugin wizard
if (TYPO3_MODE=='BE') {
	tx_rnbase::load('tx_rnbase_util_Wizicon');
	tx_rnbase_util_Wizicon::addWizicon('tx_t3sponsors_util_Wizicon', t3lib_extMgm::extPath($_EXTKEY).'util/class.tx_t3sponsors_util_Wizicon.php');
//	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_t3sponsors_util_Wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'util/class.tx_t3sponsors_util_Wizicon.php';
}


// Add static TS-config
tx_rnbase_util_Extensions::addStaticFile($_EXTKEY,'Configuration/Typoscript/Base/', 'T3 Sponsors');
if(tx_rnbase_util_TYPO3::isTYPO60OrHigher())
	tx_rnbase_util_Extensions::addStaticFile($_EXTKEY,'Configuration/Typoscript/FAL/', 'T3 Sponsors (FAL support)');

