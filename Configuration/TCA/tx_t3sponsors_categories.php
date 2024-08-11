<?php
if (!(defined('TYPO3') || defined('TYPO3_MODE'))) {
    exit('Access denied.');
}


$t3s_categories = array(
        'ctrl' => array(
            'title'     => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_categories',
            'label' => 'name',
            'searchFields' => 'uid,name,description',
            'tstamp'    => 'tstamp',
            'crdate'    => 'crdate',
            'cruser_id' => 'cruser_id',
            'languageField'            => 'sys_language_uid',
            'transOrigPointerField'    => 'l18n_parent',
            'transOrigDiffSourceField' => 'l18n_diffsource',
            'sortby' => 'sorting',
            'delete' => 'deleted',
            'enablecolumns' => array(
            ),
            'iconfile' => 'EXT:t3sponsors/ext_icon.gif',
        ),
        'interface' => array(
                'showRecordFieldList' => 'hidden,name1,name2'
        ),
        'feInterface' => array(
            'fe_admin_fieldList' => 'name,description',
        ),
        'columns' => array(
                'hidden' => array(
                        'exclude' => 1,
                        'label'   => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
                        'config'  => [
                            'type'    => 'check',
                            'default' => '0'
                        ]
                ),
                'sys_language_uid' => array(
                        'exclude' => 1,
                        'label'  => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.language',
                        'config' => [
                            'type' => 'select',
                            'renderType' => 'selectSingle',
                            'special' => 'languages',
                            'items' => [
                                [
                                    'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                                    -1,
                                    'flags-multiple'
                                ],
                            ],
                            'default' => 0,
                        ]
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
                                'foreign_table'       => 'tx_t3sponsors_categories',
                                'foreign_table_where' => 'AND tx_t3sponsors_categories.pid=###CURRENT_PID### AND tx_t3sponsors_categories.sys_language_uid IN (-1,0)',
                        )
                ),
                'l18n_diffsource' => array(
                        'config' => array(
                                'type' => 'passthrough'
                        )
                ),
                'name' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_categories.name',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'description' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_categories.description',
                        'config' => array(
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
                'sponsors' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies',
                        'config' => array(
                                'type' => 'select',
                                'foreign_table' => 'tx_t3sponsors_companies',
                                'size' => 10,
                                'autoSizeMax' => 30,
                                'minitems' => 0,
                                'maxitems' => 100,
                                'MM' => 'tx_t3sponsors_categories_mm',
                                'MM_match_fields' => array(
                                        'tablenames' => 'tx_t3sponsors_companies',
                                ),
                        )
                ),
        ),
        'types' => array(
                '0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource,hidden;;1;;1-1-1,name,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/rte/],sponsors,damlogo,logo')
        ),
        'palettes' => array(
                '1' => array('showitem' => '')
        )
);

if (tx_rnbase_util_TYPO3::isTYPO60OrHigher()) {
    tx_rnbase::load('tx_rnbase_util_TSFAL');
    $t3s_categories['columns']['logo'] = tx_rnbase_util_TSFAL::getMediaTCA('logo', array(
            'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.logo',
            'config' => array('size' => 1, 'maxitems' => 1),
    ));
} elseif (tx_rnbase_util_Extensions::isLoaded('dam')) {
    tx_rnbase::load('tx_rnbase_util_TSDAM');
    $t3s_categories['columns']['damlogo'] = tx_rnbase_util_TSDAM::getMediaTCA('logo');
    $t3s_categories['columns']['damlogo']['label'] = 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.logo';
    $t3s_categories['columns']['damlogo']['config']['size'] = 1;
    $t3s_categories['columns']['damlogo']['config']['maxitems'] = 1;
} else {
    $t3s_categories['columns']['logo'] = array(
            'exclude' => 0,
            'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xml:tx_t3sponsors_companies.logo',
            'config' => array(
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
}

return $t3s_categories;
