<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009-2024 Rene Nitzsche (rene[@]system25.de)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Sys25\RnBase\Utility\Extensions;
use Sys25\RnBase\Utility\WizIcon;

/**
 * Class that adds the wizard icon.
 *
 * @author René Nitzsche <rene[@]system25.de>
 */
class tx_t3sponsors_util_Wizicon extends WizIcon
{
    protected function getPluginData()
    {
        $plugins = [];
        $plugins['tx_t3sponsors'] = [
            'icon' => 'EXT:t3sponsors/ext_icon.gif',
            'title' => 'plugin.t3sponsors.label',
            'description' => 'plugin.t3sponsors.description'
        ];
        return $plugins;
    }

    protected function getLLFile()
    {
        return Extensions::extPath('t3sponsors') . 'Resources/Private/Language/locallang_db.xlf';
    }
}
