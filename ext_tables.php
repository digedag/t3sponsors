<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_t3sponsors_companies'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:t3sponsors/locallang_db.xml:tx_t3sponsors_companies',
		'label' => 'name1',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'dividers2tabs' => TRUE,
		'default_sortby' => 'ORDER BY name1 asc',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'name1,name2,description,comment',
	)
);

$TCA['tx_t3sponsors_categories'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:t3sponsors/locallang_db.xml:tx_t3sponsors_categories',
		'label' => 'name',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => array (
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif',
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'name,description',
	)
);



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
t3lib_extMgm::addStaticFile($_EXTKEY,'static/ts/', 'T3 Sponsors');

?>