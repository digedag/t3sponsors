<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Rene Nitzsche (rene@system25.de)
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

/**
 * Filterklasse mit zusätzlichem Such-Formular
 */
class tx_t3sponsors_filter_Form extends tx_rnbase_filter_BaseFilter {

	/**
	 * Abgeleitete Filter können diese Methode überschreiben und zusätzliche Filter setzen
	 *
	 * @param array $fields
	 * @param array $options
	 * @param tx_rnbase_IParameters $parameters
	 * @param tx_rnbase_configurations $configurations
	 * @param string $confId
	 */
	protected function initFilter(&$fields, &$options, &$parameters, &$configurations, $confId) {
		//if($_SERVER["REMOTE_ADDR"] == '89.246.162.16')
//		tx_rnbase_util_Debug::debug($parameters,__FILE__.':'.__LINE__); // TODO: remove me

		return TRUE;
	}

	function parseTemplate($template, &$formatter, $confId, $marker = 'FILTER') {
		if(!tx_rnbase_util_BaseMarker::containsMarker($template, 'SEARCHFORM'))
			return $template;
//if($_SERVER["REMOTE_ADDR"] == '89.246.162.16')
//tx_rnbase_util_Debug::debug([$confId, $formatter->getConfigurations()->get('sponsorlist.')],__FILE__.':'.__LINE__); // TODO: remove me
		$fileName = $formatter->getConfigurations()->get($confId.'template');
		$subpart = $formatter->getConfigurations()->get($confId.'subpart');
		$searchTemplate = '';
		try {
			$searchTemplate = tx_rnbase_util_Templates::getSubpartFromFile($fileName, $subpart);
			$searchTemplate = $this->addTrades($searchTemplate, $formatter, $confId.'form.trade.', 'TRADE');
			$markerArray = array();
			$link = $this->createPageUri($formatter->getConfigurations(), $confId.'form.');
			$markerArray['###ACTION_URI###'] = $link->makeUrl(false);
			$markerArray['###ACTION_PID###'] = $link->destination;
			$searchTemplate = tx_rnbase_util_Templates::substituteMarkerArrayCached($searchTemplate, $markerArray);
		}
		catch(Exception $e) {
			$searchTemplate = $e->getMessage();
		}

		$markerArray = array(
				'###SEARCHFORM###' => $searchTemplate,
		);
		$template = tx_rnbase_util_Templates::substituteMarkerArrayCached($template, $markerArray);
//		tx_rnbase_util_Debug::debug([$confId, $template],__FILE__.':'.__LINE__); // TODO: remove me
		return $template;
	}

	protected function addTrades($template, $formatter, $confId, $markerPrefix) {
		$srv = tx_t3sponsors_util_ServiceRegistry::getTradeService();
		$fields = $options = array();
		tx_rnbase_util_SearchBase::setConfigFields($fields, $formatter->configurations, $confId.'fields.');
		tx_rnbase_util_SearchBase::setConfigOptions($options, $formatter->configurations, $confId.'options.');
		$children = $srv->search($fields, $options);
		$listBuilder = tx_rnbase::makeInstance('tx_rnbase_util_ListBuilder');
		$out = $listBuilder->render($children,false, $template, 'tx_rnbase_util_SimpleMarker',
				$confId, $markerPrefix, $formatter);
		return $out;
	}

	/**
	 *
	 * @param tx_rnbase_configurations $configurations
	 */
	protected function createPageUri($configurations, $confId, $params = array()) {
		$link = $configurations->createLink();
		$link->initByTS($configurations, $confId.'formUrl.', $params);
		if($configurations->get($confId.'formUrl.noCache'))
			$link->noCache();
		return $link;
	}

}

