<?php
if (!(defined('TYPO3') || defined('TYPO3_MODE'))) {
    exit('Access denied.');
}

$t3s_trades = array(
        'ctrl' => array(
            'title'     => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_trades',
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
            'iconfile'          => 'EXT:t3sponsors/ext_icon.gif',
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
                                'foreign_table'       => 'tx_t3sponsors_trades',
                                'foreign_table_where' => 'AND tx_t3sponsors_trades.pid=###CURRENT_PID### AND tx_t3sponsors_trades.sys_language_uid IN (-1,0)',
                        )
                ),
                'l18n_diffsource' => array(
                        'config' => array(
                                'type' => 'passthrough'
                        )
                ),
                'name' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_trades.name',
                        'config' => array(
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'trim',
                        )
                ),
                'description' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_trades.description',
                        'config' => array(
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
                'sponsors' => array(
                        'exclude' => 1,
                        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies',
                        'config' => array(
                                'type' => 'select',
                                'foreign_table' => 'tx_t3sponsors_companies',
                                'size' => 10,
                                'autoSizeMax' => 30,
                                'minitems' => 0,
                                'maxitems' => 100,
                                'MM' => 'tx_t3sponsors_trades_mm',
                                'MM_match_fields' => array(
                                        'tablenames' => 'tx_t3sponsors_companies',
                                ),
                        )
                ),
        ),
        'types' => array(
                '0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l18n_parent, l18n_diffsource,hidden;;1;;1-1-1,name,description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/rte/],sponsors,logo,t3logo')
        ),
        'palettes' => array(
                '1' => array('showitem' => '')
        )
);

tx_rnbase::load('tx_rnbase_util_TSFAL');
$t3s_trades['columns']['logo'] = tx_rnbase_util_TSFAL::getMediaTCA('logo', array(
        'label' => 'LLL:EXT:t3sponsors/Resources/Private/Language/locallang_db.xlf:tx_t3sponsors_companies.logo',
        'config' => array('size' => 1, 'maxitems' => 1),
));

return $t3s_trades;
