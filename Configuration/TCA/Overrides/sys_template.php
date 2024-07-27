<?php

if (!(defined('TYPO3') || defined('TYPO3_MODE'))) {
    exit('Access denied.');
}

call_user_func(function () {
    $extKey = 't3sponsors';

    // Add static TS-config
    \Sys25\RnBase\Utility\Extensions::addStaticFile($extKey, 'Configuration/Typoscript/Base/', 'T3 Sponsors');
    \Sys25\RnBase\Utility\Extensions::addStaticFile($extKey, 'Configuration/Typoscript/FAL/', 'T3 Sponsors (FAL support)');
});
