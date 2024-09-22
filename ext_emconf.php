<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "t3sponsors".
 *
 * Auto generated 04-07-2015 14:24
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'T3sponsors',
    'description' => 'Simple extension with sponsors and categories. Mainly a demonstration on how to write plugins based on rn_base.',
    'category' => 'plugin',
    'shy' => 0,
    'version' => '1.3.0',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'loadOrder' => '',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => 1,
    'createDirs' => 'uploads/tx_t3sponsors',
    'modify_tables' => '',
    'clearcacheonload' => 1,
    'lockType' => '',
    'author' => 'Rene Nitzsche',
    'author_email' => 'rene@system25.de',
    'author_company' => 'System 25',
    'CGLcompliance' => '',
    'CGLcompliance_note' => '',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-12.4.99',
            'rn_base' => '1.8.0-0.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    '_md5_values_when_last_written' => 'a:32:{s:9:"ChangeLog";s:4:"3db3";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"696a";s:14:"ext_tables.php";s:4:"8f8f";s:14:"ext_tables.sql";s:4:"3b24";s:17:"flexform_main.xml";s:4:"c441";s:13:"locallang.xml";s:4:"57b6";s:16:"locallang_db.xml";s:4:"8dc1";s:10:"README.txt";s:4:"3bc0";s:7:"tca.php";s:4:"5d0b";s:51:"actions/class.tx_t3sponsors_actions_SponsorList.php";s:4:"cc3d";s:51:"actions/class.tx_t3sponsors_actions_SponsorShow.php";s:4:"8433";s:14:"doc/manual.sxw";s:4:"de70";s:19:"doc/wizard_form.dat";s:4:"9980";s:20:"doc/wizard_form.html";s:4:"b0f7";s:46:"marker/class.tx_t3sponsors_marker_Category.php";s:4:"5922";s:45:"marker/class.tx_t3sponsors_marker_Sponsor.php";s:4:"33b8";s:46:"models/class.tx_t3sponsors_models_category.php";s:4:"52b6";s:45:"models/class.tx_t3sponsors_models_sponsor.php";s:4:"c43f";s:46:"search/class.tx_t3sponsors_search_Category.php";s:4:"08e6";s:45:"search/class.tx_t3sponsors_search_Sponsor.php";s:4:"cef1";s:23:"static/ts/constants.txt";s:4:"db48";s:19:"static/ts/setup.txt";s:4:"e695";s:40:"sv1/class.tx_t3sponsors_sv1_Category.php";s:4:"885f";s:39:"sv1/class.tx_t3sponsors_sv1_Sponsor.php";s:4:"1fb7";s:21:"sv1/ext_localconf.php";s:4:"ecef";s:26:"templates/sponsorlist.html";s:4:"5ef5";s:26:"templates/sponsorshow.html";s:4:"5218";s:49:"util/class.tx_t3sponsors_util_ServiceRegistry.php";s:4:"9765";s:41:"util/class.tx_t3sponsors_util_Wizicon.php";s:4:"ca06";s:47:"views/class.tx_t3sponsors_views_SponsorList.php";s:4:"c164";s:47:"views/class.tx_t3sponsors_views_SponsorShow.php";s:4:"d7e7";}',
);
