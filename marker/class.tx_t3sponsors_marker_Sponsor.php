<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009-2012 Rene Nitzsche (rene@system25.de)
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

require_once(t3lib_extMgm::extPath('rn_base') . 'class.tx_rnbase.php');

tx_rnbase::load('tx_rnbase_util_BaseMarker');

/**
 * Diese Klasse ist für die Erstellung von Markerarrays der Sponsoren verantwortlich
 */
class tx_t3sponsors_marker_Sponsor extends tx_rnbase_util_BaseMarker {

	/**
	 * @param string $template das HTML-Template
	 * @param tx_t3sponsors_models_sponsor $item the sponsor
	 * @param tx_rnbase_util_FormatUtil $formatter der zu verwendente Formatter
	 * @param string $confId Pfad der TS-Config, z.B. 'listView.club.'
	 * @param string $marker name of marker
	 *        Von diesem String hängen die entsprechenden weiteren Marker ab: ###CLUB_NAME###, ###COACH_ADDRESS_WEBSITE###
	 * @return String das geparste Template
	 */
	public function parseTemplate($template, &$item, &$formatter, $confId, $marker = 'SPONSOR') {
		if(!is_object($item)) {
			// Ist kein Objekt vorhanden wird ein leeres Objekt verwendet.
			$item = self::getEmptyInstance('tx_t3sponsors_models_sponsor');
		}

		// Es wird das MarkerArray mit den Daten des Teams gefüllt.
		$markerArray = $formatter->getItemMarkerArrayWrapped($item->record, $confId , 0, $marker.'_',$item->getColumnNames());
		$this->prepareLinks($item, $marker, $markerArray, $subpartArray, $wrappedSubpartArray, $confId, $formatter);
		if($this->containsMarker($template, $marker.'_CATEGORYS'))
			$template = $this->_addCategories($template, $item, $formatter, $confId.'category.', $marker.'_CATEGORY');

		$template = $formatter->cObj->substituteMarkerArrayCached($template, $markerArray, $subpartArray, $wrappedSubpartArray);
		// Now lookout for external marker services.
		$markerArray = array();
		$subpartArray = array();
		$wrappedSubpartArray = array();
    
		$params['confid'] = $confId;
		$params['marker'] = $marker;
		$params['sponsor'] = $item;
		self::callModules($template, $markerArray, $subpartArray, $wrappedSubpartArray, $params, $formatter);
		return $formatter->cObj->substituteMarkerArrayCached($template, $markerArray, $subpartArray, $wrappedSubpartArray);
	}

	/**
	 *
	 * @param string $template
	 * @param tx_t3sponsors_models_sponsor $item
	 * @param tx_rnbase_util_FormatUtil $formatter
	 * @param string $confId
	 * @param string $markerPrefix
	 * @return string
	 */
	protected function _addCategories($template, &$item, &$formatter, $confId, $markerPrefix) {
		$srv = tx_t3sponsors_util_ServiceRegistry::getCategoryService();
		$fields['CATMM.UID_FOREIGN'][OP_EQ_INT] = $item->uid;
		$options = array();
		tx_rnbase_util_SearchBase::setConfigFields($fields, $formatter->configurations, $confId.'fields.');
		tx_rnbase_util_SearchBase::setConfigOptions($options, $formatter->configurations, $confId.'options.');
		$children = $srv->search($fields, $options);
		$listBuilder = tx_rnbase::makeInstance('tx_rnbase_util_ListBuilder');
		$out = $listBuilder->render($children,false, $template, 'tx_t3sponsors_marker_Category',
						$confId, $markerPrefix, $formatter);
		return $out;
	}

	/**
	 * Prepare links
	 *
	 * @param tx_t3sponsors_models_sponsor $item
	 * @param string $marker
	 * @param array $markerArray
	 * @param array $wrappedSubpartArray
	 * @param string $confId
	 * @param tx_rnbase_util_FormatUtil $formatter
	 */
	public function prepareLinks(&$item, $marker, &$markerArray, &$subpartArray, &$wrappedSubpartArray, $confId, &$formatter) {
		$linkId = 'show';
		if($item->hasReport()) {
			$this->initLink($markerArray, $subpartArray, $wrappedSubpartArray, $formatter, $confId, $linkId, $marker, array('sponsor' => $item->uid));
		}
		else {
			$linkMarker = $marker . '_' . strtoupper($linkId).'LINK';
			$remove = intval($formatter->configurations->get($confId.'links.'.$linkId.'.removeIfDisabled')); 
			$this->disableLink($markerArray, $subpartArray, $wrappedSubpartArray, $linkMarker, $remove > 0);
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/marker/class.tx_t3sponsors_marker_Sponsor.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3sponsors/marker/class.tx_t3sponsors_marker_Sponsor.php']);
}
?>