<?php

namespace System25\T3sponsors\Frontend\Filter;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015-2024 Rene Nitzsche (rene@system25.de)
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

use Exception;
use Sys25\RnBase\Domain\Repository\RepositoryRegistry;
use Sys25\RnBase\Frontend\Filter\BaseFilter;
use Sys25\RnBase\Frontend\Marker\BaseMarker;
use Sys25\RnBase\Frontend\Marker\ListBuilder;
use Sys25\RnBase\Frontend\Marker\SimpleMarker;
use Sys25\RnBase\Frontend\Marker\Templates;
use Sys25\RnBase\Frontend\Request\RequestInterface;
use Sys25\RnBase\Search\SearchBase;
use System25\T3sponsors\Repository\CategoryRepository;
use System25\T3sponsors\Repository\TradeRepository;
use tx_rnbase;

/**
 * Filterklasse mit zusätzlichem Such-Formular
 */
class FormFilter extends BaseFilter
{
    private $selectedTrades;

    private $selectedCategories;

    private $searchTerm;
    private $categoryRepo;
    private $tradeRepo;

    public function __construct($request, $confId)
    {
        parent::__construct($request, $confId);
        $repoRegistry = tx_rnbase::makeInstance(RepositoryRegistry::class);
        $this->categoryRepo = $repoRegistry->getRepositoryForClass(CategoryRepository::class) ?: tx_rnbase::makeInstance(CategoryRepository::class);
        $this->tradeRepo = $repoRegistry->getRepositoryForClass(TradeRepository::class) ?: tx_rnbase::makeInstance(TradeRepository::class);
    }
    /**
     * Abgeleitete Filter können diese Methode überschreiben und zusätzliche Filter setzen
     *
     * @param array $fields
     * @param array $options
     * @param RequestInterface $request
     */
    protected function initFilter(&$fields, &$options, RequestInterface $request)
    {
        $request->getConfigurations()->convertToUserInt();
        $parameters = $request->getParameters();
        // if($_SERVER["REMOTE_ADDR"] == '89.246.162.16')
        $this->searchTerm = $parameters->getCleaned('search');
        $this->selectedTrades = $parameters->get('search_trade') ?: [];
        $this->selectedCategories = $parameters->get('search_cat') ?: [];
        if (! empty($this->selectedTrades)) {
            $trades = implode(',', $this->selectedTrades);
            if ($trades) {
                $fields['TRADEMM.UID_LOCAL'][OP_IN_INT] = $trades;
            }
        }
        if (! empty($this->selectedCategories)) {
            $cats = implode(',', $this->selectedCategories);
            if ($cats) {
                $fields['CATMM.UID_LOCAL'][OP_IN_INT] = $cats;
            }
        }
        if (! empty($this->searchTerm)) {
            $fields[SEARCH_FIELD_JOINED][] = array(
                'value' => $this->searchTerm,
                'operator' => OP_LIKE,
                'cols' => array(
                    'SPONSOR.NAME1',
                    'SPONSOR.NAME2',
                    'SPONSOR.DESCRIPTION',
                    'SPONSOR.TAGS'
                )
            );
        }
        // $options['debug'] =1;

        return true;
    }

    /*
     * (non-PHPdoc)
     * @see tx_rnbase_filter_BaseFilter::hideResult()
     */
    public function hideResult()
    {
        if (! $this->getConfigurations()->getBool($this->getConfId() . 'hideResultInitial')) {
            return false;
        }
        $params = $this->getParameters()->getAll();
        return $params ? false : true;
    }

    public function parseTemplate($template, &$formatter, $confId, $marker = 'FILTER')
    {
        if (! BaseMarker::containsMarker($template, 'SEARCHFORM')) {
            return $template;
        }
        $fileName = $formatter->getConfigurations()->get($confId . 'template');
        $subpart = $formatter->getConfigurations()->get($confId . 'subpart');
        $searchTemplate = '';
        try {
            $searchTemplate = Templates::getSubpartFromFile($fileName, $subpart);
            $searchTemplate = $this->addTrades($searchTemplate, $formatter, $confId . 'form.trade.', 'TRADE', $this->selectedTrades);
            $searchTemplate = $this->addCategories($searchTemplate, $formatter, $confId . 'form.category.', 'CATEGORY', $this->selectedCategories);
            $markerArray = array();
            $link = $this->createPageUri($formatter->getConfigurations(), $confId . 'form.');
            $markerArray['###ACTION_URI###'] = $link->makeUrl(false);
            $markerArray['###ACTION_PID###'] = $link->destination;
            $markerArray['###SEARCH_TERM###'] = htmlspecialchars($this->searchTerm);
            $searchTemplate = Templates::substituteMarkerArrayCached($searchTemplate, $markerArray);
        } catch (Exception $e) {
            $searchTemplate = $e->getMessage();
        }

        $markerArray = array(
            '###SEARCHFORM###' => $searchTemplate
        );
        $template = Templates::substituteMarkerArrayCached($template, $markerArray);
        return $template;
    }

    /**
     * Add Trade selection to form
     *
     * @param string $template
     * @param tx_rnbase_util_FormatUtil $formatter
     * @param string $confId
     * @param string $markerPrefix
     * @param array[int] $selectedTrades
     * @return string
     */
    protected function addTrades($template, $formatter, $confId, $markerPrefix, array $selectedTrades)
    {
        $fields = $options = [];
        SearchBase::setConfigFields($fields, $formatter->configurations, $confId . 'fields.');
        SearchBase::setConfigOptions($options, $formatter->configurations, $confId . 'options.');
        $children = $this->tradeRepo->search($fields, $options);
        foreach ($children as $item) {
            $item->setProperty('selected', in_array($item->getUid(), $selectedTrades) ? 1 : 0);
        }
        $listBuilder = tx_rnbase::makeInstance(ListBuilder::class);
        $out = $listBuilder->render($children, false, $template, SimpleMarker::class, $confId, $markerPrefix, $formatter);
        return $out;
    }

    /**
     * Add Trade selection to form
     *
     * @param string $template
     * @param FormatUtil $formatter
     * @param string $confId
     * @param string $markerPrefix
     * @param array[int] $selectedTrades
     * @return string
     */
    protected function addCategories($template, $formatter, $confId, $markerPrefix, array $selectedCategories)
    {
        $fields = $options = [];
        SearchBase::setConfigFields($fields, $formatter->getConfigurations(), $confId . 'fields.');
        SearchBase::setConfigOptions($options, $formatter->getConfigurations(), $confId . 'options.');
        $children = $this->categoryRepo->search($fields, $options);
        foreach ($children as $item) {
            $item->setProperty('selected', in_array($item->getUid(), $selectedCategories) ? 1 : 0);
        }
        $listBuilder = tx_rnbase::makeInstance(ListBuilder::class);
        $out = $listBuilder->render($children, false, $template, SimpleMarker::class, $confId, $markerPrefix, $formatter);
        return $out;
    }

    /**
     *
     * @param tx_rnbase_configurations $configurations
     */
    protected function createPageUri($configurations, $confId, $params = array())
    {
        $link = $configurations->createLink();
        $link->initByTS($configurations, $confId . 'formUrl.', $params);
        if ($configurations->get($confId . 'formUrl.noCache')) {
            $link->noCache();
        }
        return $link;
    }
}
