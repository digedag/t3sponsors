<?php

if (!(defined('TYPO3') || defined('TYPO3_MODE'))) {
    exit('Access denied.');
}

$t3s_companies = [
        'ctrl' => [
            'title'     => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies',
            'label' => 'name1',
            'searchFields' => 'uid,name1,name2,address,city,zip,email,tags,contactlastname',
            'tstamp'    => 'tstamp',
            'crdate'    => 'crdate',
            'cruser_id' => 'cruser_id',
            'languageField'            => 'sys_language_uid',
            'transOrigPointerField'    => 'l18n_parent',
            'transOrigDiffSourceField' => 'l18n_diffsource',
            'dividers2tabs' => true,
            'default_sortby' => 'ORDER BY name1 asc',
            'delete' => 'deleted',
            'enablecolumns' => [
                'disabled' => 'hidden',
             ],
            'iconfile' => 'EXT:t3sponsors/Resources/Public/Icons/ext_icon.gif',
        ],
        'interface' => [
                'showRecordFieldList' => 'hidden,name1,name2'
        ],
        'feInterface' => [
            'fe_admin_fieldList' => 'name1,name2,description,comment',
        ],
        'columns' => [
                'hidden' => array(
                        'exclude' => 1,
                        'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
                        'config'  => array(
                                'type'    => 'check',
                                'default' => '0'
                        )
                ),
                'sys_language_uid' => array(
                        'exclude' => 1,
                        'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
                        'config' => array(
                                'type'                => 'select',
                                'foreign_table'       => 'sys_language',
                                'foreign_table_where' => 'ORDER BY sys_language.title',
                                'items' => array(
                                        array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
                                        array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
                                )
                        )
                ),
                'l18n_parent' => array(
                        'displayCond' => 'FIELD:sys_language_uid:>:0',
                        'exclude'     => 1,
                        'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
                        'config'      => array(
                                'type'  => 'select',
                                'items' => array(
                                        array('', 0),
                                ),
                                'foreign_table'       => 'tx_t3sponsors_companies',
                                'foreign_table_where' => 'AND tx_t3sponsors_companies.pid=###CURRENT_PID### AND tx_t3sponsors_companies.sys_language_uid IN (-1,0)',
                        )
                ),
                'l18n_diffsource' => array(
                        'config' => array(
                                'type' => 'passthrough'
                        )
                ),
                'name1' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.name1',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'name2' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.name2',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'address' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.address',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'zip' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.zip',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'city' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.city',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'countrycode' => array(
                    'exclude' => 1,
                    'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies_countrycode',
                    'config' => array(
                        'type' => 'input',
                        'size' => '10',
                        'max' => '20',
                        'eval' => 'trim',
                    )
                ),
                'lng' => array(
                    'exclude' => 1,
                    'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies_lng',
                    'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '50',
                        'eval' => 'trim',
                    )
                ),
                'lat' => array(
                    'exclude' => 1,
                    'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies_lat',
                    'config' => array(
                        'type' => 'input',
                        'size' => '20',
                        'max' => '50',
                        'eval' => 'trim',
                    )
                ),
                'www' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.www',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'email' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.email',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'phone' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.phone',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'fax' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.fax',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'mobile' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.mobile',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'contactfirstname' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies_contactfirstname',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'contactlastname' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies_contactlastname',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'hasreport' => array(
                        'exclude' => 1,
                        'label'   => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.hasreport',
                        'config'  => array(
                                'type'    => 'check',
                                'default' => '0'
                        )
                ),
                'openingtime' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.openingtime',
                        'config' => array(
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
                'description' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.description',
                        'config' => array(
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
                'tags' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies_tags',
                        'config' => array(
                                'type' => 'input',
                                'max' => '4096',
                                'size' => '50',
                                'eval' => 'trim',
                        )
                ),
                'categories' => [
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_categories',
                        'config' => [
                                'type' => 'select',
                                'renderType' => 'selectMultipleSideBySide',
                                'size' => 20,
                                'autoSizeMax' => 50,
                                'minitems' => 0,
                                'maxitems' => 500,
                                'foreign_table' => 'tx_t3sponsors_categories',
                                'foreign_table_where' => 'ORDER BY tx_t3sponsors_categories.sorting',
                                'MM' => 'tx_t3sponsors_categories_mm',
                                'MM_foreign_select' => 1,  // wird wohl nicht verwendet...
                                'MM_opposite_field' => 'sponsors',
                                'MM_match_fields' => [
                                        'tablenames' => 'tx_t3sponsors_companies',
                                ],
                        ]
                ],
                'trades' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_trades',
                        'config' => array(
                                'type' => 'select',
                                'renderType' => 'selectMultipleSideBySide',
                                'size' => 20,
                                'autoSizeMax' => 50,
                                'minitems' => 0,
                                'maxitems' => 500,
                                'foreign_table' => 'tx_t3sponsors_trades',
                                'foreign_table_where' => 'ORDER BY tx_t3sponsors_trades.sorting',
                                'MM' => 'tx_t3sponsors_trades_mm',
                                'MM_foreign_select' => 1,  // wird wohl nicht verwendet...
                                'MM_opposite_field' => 'sponsors',
                                'MM_match_fields' => array(
                                        'tablenames' => 'tx_t3sponsors_companies',
                                ),
                        )
                ),
        ],
        'types' => [
                '0' => ['showitem' => 'sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource,hidden;;1;;1-1-1,name1,name2,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/rte/],categories,trades,damlogo,logo,dampictures,pictures,comment,tags,hasreport,
                --div--;LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies_tabcontact,contactfirstname,contactlastname,address,zip,city,countrycode,lng,lat,openingtime;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/rte/],www,email,phone,fax,mobile']
        ],
        'palettes' => [
                '1' => ['showitem' => '']
        ]
];

$t3s_companies['columns']['logo'] = \Sys25\RnBase\Utility\TSFAL::getMediaTCA('logo', array(
        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.logo',
        'config' => array('size' => 1, 'maxitems' => 1),
));
$t3s_companies['columns']['pictures'] = \Sys25\RnBase\Utility\TSFAL::getMediaTCA('pictures');

return $t3s_companies;
