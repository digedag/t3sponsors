<?php

if (!(defined('TYPO3') || defined('TYPO3_MODE'))) {
    exit('Access denied.');
}

call_user_func(function () {
    $extKey = 't3sponsors';

    ////////////////////////////////
    // Plugin Competition anmelden
    ////////////////////////////////

    // Einige Felder ausblenden
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['tx_t3sponsors']='layout,select_key,pages';

    // Das tt_content-Feld pi_flexform einblenden
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['tx_t3sponsors']='pi_flexform';

    \Sys25\RnBase\Utility\Extensions::addPiFlexFormValue(
        'tx_t3sponsors', 
        'FILE:EXT:'.$extKey.'/Configuration/Flexform/flexform_main.xml'
    );
    \Sys25\RnBase\Utility\Extensions::addPlugin(
        [
            'LLL:EXT:'.$extKey.'/Resources/Private/Language/locallang_db.xlf:plugin.t3sponsors.label',
            'tx_t3sponsors'
        ],
        'list_type',
        $extKey
    );

    // # Add plugin wizard
    // if (TYPO3_MODE=='BE') {
    // tx_rnbase_util_Wizicon::addWizicon('tx_t3sponsors_util_Wizicon', \Sys25\RnBase\Utility\Extensions::extPath($_EXTKEY).'util/class.tx_t3sponsors_util_Wizicon.php');
    // }

});
