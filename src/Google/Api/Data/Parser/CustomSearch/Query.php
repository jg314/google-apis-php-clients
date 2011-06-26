<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Data\Parser\CustomSearch;

use Google\Api\Data\Parser;
use Google\Api\Data\Parser\Exception;

use Google\Api\Data\CustomSearch\Query as QueryData;

/**
 * Query parses raw data into a formatted Query Data object.
 *
 * @author Stephen Melrose <me@stephenmelrose.co.uk>
 */
class Query implements Parser
{
    /**
     * Parses raw data into a formatted Query Data object.
     *
     * @param \stdClass $data The data to parse.
     *
     * @return QueryData
     *
     * @throws Exception When a parse error occurs.
     */
    public function parse(\stdClass $data)
    {
        $formattedData = array();
        
        foreach($data as $key => $value)
        {
            $formattedData[$key] = $value;
        }

        return new QueryData($formattedData);
    }
}