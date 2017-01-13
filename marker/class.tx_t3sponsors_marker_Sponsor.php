<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009-2017 Rene Nitzsche (rene@system25.de)
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


tx_rnbase::load('tx_rnbase_util_SimpleMarker');
tx_rnbase::load('tx_rnbase_util_Templates');


/**
 * Diese Klasse ist für die Erstellung von Markerarrays der Sponsoren verantwortlich
 */
class tx_t3sponsors_marker_Sponsor extends tx_rnbase_util_SimpleMarker {

	public function __construct($options = array()) {
		$this->setClassname('tx_t3sponsors_models_Sponsor');
		parent::__construct($options);
	}

	protected function prepareTemplate($template, $item, $formatter, $confId, $marker) {
		if(self::containsMarker($template, $marker.'_CATEGORYS'))
			$template = $this->addCategories($template, $item, $formatter, $confId.'category.', $marker.'_CATEGORY');
		return $template;
	}


	/**
	 *
	 * @param string $template
	 * @param tx_t3sponsors_models_Sponsor $item
	 * @param tx_rnbase_util_FormatUtil $formatter
	 * @param string $confId
	 * @param string $markerPrefix
	 * @return string
	 */
	protected function addCategories($template, $item, $formatter, $confId, $markerPrefix) {
		$srv = tx_t3sponsors_util_ServiceRegistry::getCategoryService();
		$options = $fields = array();
		$fields['CATMM.UID_FOREIGN'][OP_EQ_INT] = $item->getUid();
		tx_rnbase_util_SearchBase::setConfigFields($fields, $formatter->getConfigurations(), $confId.'fields.');
		tx_rnbase_util_SearchBase::setConfigOptions($options, $formatter->getConfigurations(), $confId.'options.');
		$children = $srv->search($fields, $options);
		$listBuilder = tx_rnbase::makeInstance('tx_rnbase_util_ListBuilder');
		$out = $listBuilder->render($children,false, $template, 'tx_t3sponsors_marker_Category',
						$confId, $markerPrefix, $formatter);
		return $out;
	}

}

