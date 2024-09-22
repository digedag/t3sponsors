<?php

namespace System25\T3sponsors\Search;

use Sys25\RnBase\Database\Query\Join;
use Sys25\RnBase\Search\SearchBase;
use System25\T3sponsors\Model\Trade;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015-2024 Rene Nitzsche
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
 * Class to search trades from database
 *
 * @author Rene Nitzsche
 */
class TradeSearch extends SearchBase
{
    protected function getTableMappings()
    {
        $tableMapping = [];
        $tableMapping['SPONSOR'] = 'tx_t3sponsors_companies';
        $tableMapping['TRADEMM'] = 'tx_t3sponsors_trades_mm';
        $tableMapping[$this->getBaseTableAlias()] = $this->getBaseTable();

        return $tableMapping;
    }

    protected function getBaseTableAlias()
    {
        return 'TRADE';
    }

    protected function getBaseTable()
    {
        return 'tx_t3sponsors_trades';
    }

    public function getWrapperClass()
    {
        return Trade::class;
    }

    protected function getJoins($tableAliases)
    {
        $join = [];
        if (isset($tableAliases['TRADEMM']) || isset($tableAliases['SPONSOR'])) {
            $join[] = new Join('TRADE', 'tx_t3sponsors_trades_mm', 'TRADE.uid = TRADEMM.uid_local', 'TRADEMM');
        }
        if (isset($tableAliases['SPONSOR'])) {
            $join[] = new Join('TRADEMM', 'tx_t3sponsors_companies', 'SPONSOR.uid = TRADEMM.uid_foreign', 'SPONSOR');
        }
        return $join;
    }
}
