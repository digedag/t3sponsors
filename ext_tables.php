<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

tx_rnbase::load('tx_rnbase_util_TYPO3');
tx_rnbase::load('tx_rnbase_util_Extensions');


////////////////////////////////
// Register plugin
////////////////////////////////
// Hide some fields
$TCA['tt_content']['types']['list']['subtypes_excludelist']['tx_t3sponsors']='layout,select_key,pages';

// Show tt_content-field pi_flexform
$TCA['tt_content']['types']['list']['subtypes_addlist']['tx_t3sponsors']='pi_flexform';

// Add flexform and plugin
tx_rnbase_util_Extensions::addPiFlexFormValue('tx_t3sponsors','FILE:EXT:'.$_EXTKEY.'/Configuration/Flexform/flexform_'.(tx_rnbase_util_TYPO3::isTYPO70OrHigher() ? '76' : 'main').'.xml');
tx_rnbase_util_Extensions::addPlugin(Array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/locallang_db.php:plugin.t3sponsors.label','tx_t3sponsors'));
# Add plugin wizard
if (TYPO3_MODE=='BE') {
	tx_rnbase::load('tx_rnbase_util_Wizicon');
	tx_rnbase_util_Wizicon::addWizicon('tx_t3sponsors_util_Wizicon', tx_rnbase_util_Extensions::extPath($_EXTKEY).'util/class.tx_t3sponsors_util_Wizicon.php');
}


// Add static TS-config
tx_rnbase_util_Extensions::addStaticFile($_EXTKEY,'Configuration/Typoscript/Base/', 'T3 Sponsors');
tx_rnbase_util_Extensions::addStaticFile($_EXTKEY,'Configuration/Typoscript/FAL/', 'T3 Sponsors (FAL support)');


