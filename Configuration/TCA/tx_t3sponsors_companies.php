<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

tx_rnbase::load('tx_rnbase_util_Extensions');

$t3s_companies = array (
		'ctrl' => array (
			'title'     => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies',
			'label' => 'name1',
			'searchFields' => 'uid,name1,name2,address,city,zip,email,tags,contactlastname',
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
//			'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'Configuration/TCA/Company.php',
			'iconfile'          => tx_rnbase_util_Extensions::extRelPath('t3sponsors').'ext_icon.gif',
		),
		'interface' => array (
				'showRecordFieldList' => 'hidden,name1,name2'
		),
		'feInterface' => array (
			'fe_admin_fieldList' => 'name1,name2,description,comment',
		),
		'columns' => array (
				'hidden' => array (
						'exclude' => 1,
						'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
						'config'  => array (
								'type'    => 'check',
								'default' => '0'
						)
				),
				'sys_language_uid' => array (
						'exclude' => 1,
						'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
						'config' => array (
								'type'                => 'select',
								'foreign_table'       => 'sys_language',
								'foreign_table_where' => 'ORDER BY sys_language.title',
								'items' => array(
										array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
										array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
								)
						)
				),
				'l18n_parent' => array (
						'displayCond' => 'FIELD:sys_language_uid:>:0',
						'exclude'     => 1,
						'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
						'config'      => array (
								'type'  => 'select',
								'items' => array (
										array('', 0),
								),
								'foreign_table'       => 'tx_t3sponsors_companies',
								'foreign_table_where' => 'AND tx_t3sponsors_companies.pid=###CURRENT_PID### AND tx_t3sponsors_companies.sys_language_uid IN (-1,0)',
						)
				),
				'l18n_diffsource' => array (
						'config' => array (
								'type' => 'passthrough'
						)
				),
				'name1' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.name1',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'name2' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.name2',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'address' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.address',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'zip' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.zip',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'city' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.city',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'countrycode' => Array (
					'exclude' => 1,
					'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies_countrycode',
					'config' => Array (
						'type' => 'input',
						'size' => '10',
						'max' => '20',
						'eval' => 'trim',
					)
				),
				'lng' => Array (
					'exclude' => 1,
					'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies_lng',
					'config' => Array (
						'type' => 'input',
						'size' => '20',
						'max' => '50',
						'eval' => 'trim',
					)
				),
				'lat' => Array (
					'exclude' => 1,
					'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies_lat',
					'config' => Array (
						'type' => 'input',
						'size' => '20',
						'max' => '50',
						'eval' => 'trim',
					)
				),
				'www' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.www',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'email' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.email',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'phone' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.phone',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'fax' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.fax',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'mobile' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.mobile',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'contactfirstname' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies_contactfirstname',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'contactlastname' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies_contactlastname',
						'config' => Array (
								'type' => 'input',
								'size' => '30',
								'eval' => 'trim',
						)
				),
				'hasreport' => array (
						'exclude' => 1,
						'label'   => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.hasreport',
						'config'  => array (
								'type'    => 'check',
								'default' => '0'
						)
				),
				'description' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.description',
						'config' => Array (
								'type' => 'text',
								'cols' => '30',
								'rows' => '5',
						)
				),
				'tags' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies_tags',
						'config' => Array (
								'type' => 'input',
								'size' => '50',
								'eval' => 'trim',
						)
				),
				'categories' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_categories',
						'config' => Array (
								'type' => 'select',
								'size' => 20,
								'autoSizeMax' => 50,
								'minitems' => 0,
								'maxitems' => 500,
								'foreign_table' => 'tx_t3sponsors_categories',
								'foreign_table_where' => 'ORDER BY tx_t3sponsors_categories.sorting',
								'MM' => 'tx_t3sponsors_categories_mm',
								'MM_foreign_select' => 1,  // wird wohl nicht verwendet...
								'MM_opposite_field' => 'sponsors',
								'MM_match_fields' => Array (
										'tablenames' => 'tx_t3sponsors_companies',
								),
						)
				),
				'trades' => Array (
						'exclude' => 1,
						'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_trades',
						'config' => Array (
								'type' => 'select',
								'size' => 20,
								'autoSizeMax' => 50,
								'minitems' => 0,
								'maxitems' => 500,
								'foreign_table' => 'tx_t3sponsors_trades',
								'foreign_table_where' => 'ORDER BY tx_t3sponsors_trades.sorting',
								'MM' => 'tx_t3sponsors_trades_mm',
								'MM_foreign_select' => 1,  // wird wohl nicht verwendet...
								'MM_opposite_field' => 'sponsors',
								'MM_match_fields' => Array (
										'tablenames' => 'tx_t3sponsors_companies',
								),
						)
				),
		),
		'types' => array (
				'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource,hidden;;1;;1-1-1,name1,name2,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/rte/],categories,trades,damlogo,logo,dampictures,pictures,comment,tags,hasreport,
		--div--;LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies_tabcontact,contactfirstname,contactlastname,address,zip,city,countrycode,lng,lat,www,email,phone,fax,mobile')
		),
		'palettes' => array (
				'1' => array('showitem' => '')
		)
);

if(tx_rnbase_util_TYPO3::isTYPO60OrHigher()) {
	tx_rnbase::load('tx_rnbase_util_TSFAL');
	$t3s_companies['columns']['logo'] = tx_rnbase_util_TSFAL::getMediaTCA('logo', array(
			'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.logo',
			'config' => array('size' => 1, 'maxitems' => 1),
	));
	$t3s_companies['columns']['pictures'] = tx_rnbase_util_TSFAL::getMediaTCA('pictures');
}
elseif(tx_rnbase_util_Extensions::isLoaded('dam')) {
	tx_rnbase::load('tx_rnbase_util_TSDAM');

	$t3s_companies['columns']['damlogo'] = tx_rnbase_util_TSDAM::getMediaTCA('logo');
	$t3s_companies['columns']['dampictures']	= tx_rnbase_util_TSDAM::getMediaTCA('pictures');
	$t3s_companies['columns']['damlogo']['label'] = 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.logo';
	$t3s_companies['columns']['damlogo']['config']['size'] = 1;
	$t3s_companies['columns']['damlogo']['config']['maxitems'] = 1;
}
else {
	$t3s_companies['columns']['logo'] = Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.logo',
			'config' => Array (
					'type' => 'group',
					'internal_type' => 'file',
					'allowed' => 'gif,png,jpeg,jpg',
					'max_size' => 700,
					'uploadfolder' => 'uploads/tx_t3sponsors',
					'show_thumbs' => 1,
					'size' => 1,
					'minitems' => 0,
					'maxitems' => 1,
			)
	);
	$t3s_companies['columns']['pictures'] = Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.pictures',
			'config' => Array (
					'type' => 'group',
					'internal_type' => 'file',
					'allowed' => 'gif,png,jpeg,jpg',
					'max_size' => 700,
					'uploadfolder' => 'uploads/tx_t3sponsors',
					'show_thumbs' => 1,
					'size' => 4,
					'minitems' => 0,
					'maxitems' => 10,
			)
	);
}

return $t3s_companies;