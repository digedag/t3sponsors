<?php

namespace System25\T3sponsors\Search;

use Sys25\RnBase\Database\Query\Join;
use Sys25\RnBase\Search\SearchBase;
use Sys25\RnBase\Utility\Misc;
use System25\T3sponsors\Model\Sponsor;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2006-2024 Rene Nitzsche
 *  Contact: rene@system25.de
 *  All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 ***************************************************************/

/**
 * Class to search teams from database
 *
 * @author Rene Nitzsche
 */
class SponsorSearch extends SearchBase
{
    protected function getTableMappings()
    {
        $tableMapping = array();
        $tableMapping['SPONSOR'] = $this->getBaseTable();
        $tableMapping['CATMM'] = 'tx_t3sponsors_categories_mm';
        $tableMapping['CAT'] = 'tx_t3sponsors_categories';
        $tableMapping['TRADEMM'] = 'tx_t3sponsors_trades_mm';
        $tableMapping['TRADE'] = 'tx_t3sponsors_trades';
        // Hook to append other tables
        Misc::callHook('t3sponsors', 'search_Sponsor_getTableMapping_hook', array(
            'tableMapping' => &$tableMapping
        ), $this);
        return $tableMapping;
    }

    protected function getBaseTable()
    {
        return 'tx_t3sponsors_companies';
    }

    protected function getBaseTableAlias()
    {
        return 'SPONSOR';
    }

    public function getWrapperClass()
    {
        return Sponsor::class;
    }

    protected function getJoins($tableAliases)
    {
        $join = [];
        if (isset($tableAliases['CATMM']) || isset($tableAliases['CAT'])) {
            $join[] = new Join('SPONSOR', 'tx_t3sponsors_categories_mm', 'SPONSOR.uid = CATMM.uid_foreign AND CATMM.tablenames = \'tx_t3sponsors_companies\'', 'CATMM', Join::TYPE_LEFT);
        }
        if (isset($tableAliases['CAT'])) {
            $join[] = new Join('CATMM', 'tx_t3sponsors_categories', 'CAT.uid = CATMM.uid_local', 'CAT', Join::TYPE_LEFT);
        }
        if (isset($tableAliases['TRADEMM']) || isset($tableAliases['TRADE'])) {
            $join[] = new Join('SPONSOR', 'tx_t3sponsors_trades_mm', 'SPONSOR.uid = TRADEMM.uid_foreign AND TRADEMM.tablenames = \'tx_t3sponsors_companies\'', 'TRADEMM', Join::TYPE_LEFT);
        }
        if (isset($tableAliases['TRADE'])) {
            $join[] = new Join('TRADEMM', 'tx_t3sponsors_trades', 'TRADE.uid = TRADEMM.uid_local', 'TRADE', Join::TYPE_LEFT);
        }
        // Hook to append other tables
        Misc::callHook('t3sponsors', 'search_Sponsor_getJoins_hook', [
            'join' => &$join,
            'tableAliases' => $tableAliases
        ], $this);

        return $join;
    }
}
