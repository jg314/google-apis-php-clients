<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Data\Parser;

use Google\Api\Data\Parser;
use Google\Api\Data\Parser\Exception;
use Google\Api\Data\Parser\CustomSearch\Query as QueryParser;
use Google\Api\Data\Parser\CustomSearch\Context as ContextParser;

use Google\Api\Data\CustomSearch\Context as ContextData;

/**
 * CustomSearch parses raw data into a formatted CustomSearch Data object.
 *
 * @author Stephen Melrose <me@stephenmelrose.co.uk>
 */
class CustomSearch implements Parser
{
    const KIND = 'customsearch#search';
    
    /**
     * Parses raw data into a formatted CustomSearch Data object.
     *
     * @param \stdClass $data The data to parse.
     *
     * @return CustomSearchData
     *
     * @throws Exception When a parse error occurs.
     */
    public function parse(\stdClass $data)
    {
        $formattedData = array();
        
        if(!(isset($data->kind) && $data->kind === self::KIND))
        {
            throw new Exception(sprintf('Missing/invalid response kind. Expected "%s".', self::KIND));
        }
        
        if(!(isset($data->queries) && $data->queries instanceof \stdClass))
        {
            throw new Exception('Missing/invalid queries data.');
        }
        
        $formattedData['queries'] = $this->parseQueries($data->queries);
        
        if(isset($data->context))
        {
            if(!($data->context instanceof \stdClass))
            {
                throw new Exception('Invalid context data.');
            }
            
            $formattedData['context'] = $this->parseContext($data->context);
        }
        
        // @TODO: Return formatted Data object
    }
    
    /**
     * Parses the "queries" part of the data.
     *
     * @param \stdClass $queries
     *
     * @return array
     *
     * @throws Exception When a parse error occurs.
     */
    protected function parseQueries(\stdClass $queries)
    {
        $queryObjects = array();
        $queryParser = new QueryParser();

        foreach($queries as $type => $query)
        {
            if(!(is_array($query) && count($query) === 1 && array_key_exists(0, $query)))
            {
                throw new Exception('Invalid query format.');
            }
            
            $queryObjects[$type] = $queryParser->parse($query[0]);
        }

        return $queryObjects;
    }
    
    /**
     * Parses the "context" part of the data.
     *
     * @param \stdClass $context
     *
     * @return ContextData
     *
     * @throws Exception When a parse error occurs.
     */
    protected function parseContext(\stdClass $context)
    {
        $contextParser = new ContextParser();
        return $contextParser->parse($context);
    }
}