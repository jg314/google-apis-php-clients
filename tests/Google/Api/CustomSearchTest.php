<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api;

class CustomSearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CustomSearch
     */
    protected $clientStub;

    protected function setUp()
    {
        $this->clientStub = $this->getMock('\Google\Api\CustomSearch', array('executeApiRequest'));

        $this->clientStub->expects($this->any())
                         ->method('executeApiRequest')
                         ->will($this->returnValue(file_get_contents(__DIR__.'/Fixtures/customsearch.json')));
    }

    public function testConstruct()
    {
        $client = new CustomSearch();
        $this->assertNull($client->getQuery());

        $client = new CustomSearch('foo');
        $this->assertEquals('foo', $client->getQuery());
    }

    public function testSettingAdapter()
    {
        $this->assertInstanceOf('\Google\Api\Adapter\Curl', $this->clientStub->getAdapter());

        $adapter = new \Google\Api\Adapter\FileGetContents();
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setAdapter($adapter));
        $this->assertTrue($adapter === $this->clientStub->getAdapter());
    }

    public function dataProviderSettingApiKey()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, null),
            array(true, ''),
            array(true, '    '),
            array(false, 'apikey')
        );
    }

    /**
     * @dataProvider dataProviderSettingApiKey
     */
    public function testSettingApiKey($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setApiKey($data));
        $this->assertEquals($data, $this->clientStub->getApiKey());
    }
    
    public function dataProviderSettingCustomSearchEngineId()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, 1),
            array(true, -1),
            array(true, ''),
            array(true, '    '),
            array(false, null),
            array(false, 'myId'),
        );
    }

    /**
     * @dataProvider dataProviderSettingCustomSearchEngineId
     */
    public function testSettingCustomSearchEngineId($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setCustomSearchEngineId($data));
        $this->assertEquals($data, $this->clientStub->getCustomSearchEngineId());
    }
    
    public function dataProviderSettingCustomSearchEngineSpecUrl()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, 1),
            array(true, -1),
            array(true, ''),
            array(true, '    '),
            array(true, 'myId'),
            array(false, null),
            array(false, 'http://www.google.co.uk/'),
        );
    }

    /**
     * @dataProvider dataProviderSettingCustomSearchEngineSpecUrl
     */
    public function testSettingCustomSearchEngineSpecUrl($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setCustomSearchEngineSpecUrl($data));
        $this->assertEquals($data, $this->clientStub->getCustomSearchEngineSpecUrl());
    }
    
    public function dataProviderSettingFilterDuplicates()
    {
        return array(
            array(true, array('foo')),
            array(true, 1),
            array(true, -1),
            array(true, ''),
            array(true, '    '),
            array(true, 'invalid'),
            array(false, null),
            array(false, true),
            array(false, false),
        );
    }

    /**
     * @dataProvider dataProviderSettingFilterDuplicates
     */
    public function testSettingFilterDuplicates($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setFilterDuplicates($data));
        $this->assertEquals($data, $this->clientStub->getFilterDuplicates());
    }
    
    public function dataProviderSettingLanguageRestriction()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, 1),
            array(true, -1),
            array(true, ''),
            array(true, '    '),
            array(true, 'invalid'),
            array(false, null),
            array(false, 'lang_en'),
        );
    }

    /**
     * @dataProvider dataProviderSettingLanguageRestriction
     */
    public function testSettingLanguageRestriction($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setLanguageRestriction($data));
        $this->assertEquals($data, $this->clientStub->getLanguageRestriction());
    }
    
    public function dataProviderSettingNumberOfResults()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, ''),
            array(true, '    '),
            array(true, 'invalid'),
            array(true, -1),
            array(true, 0),
            array(true, 11),
            array(true, 5.5),
            array(false, null),
            array(false, 1),
            array(false, 10),
        );
    }

    /**
     * @dataProvider dataProviderSettingNumberOfResults
     */
    public function testSettingNumberOfResults($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setNumberOfResults($data));
        $this->assertEquals($data, $this->clientStub->getNumberOfResults());
    }
    
    public function dataProviderSettingQuery()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, 1),
            array(true, -1),
            array(true, null),
            array(true, ''),
            array(true, '    '),
            array(false, 'query'),
        );
    }

    /**
     * @dataProvider dataProviderSettingQuery
     */
    public function testSettingQuery($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setQuery($data));
        $this->assertEquals($data, $this->clientStub->getQuery());
    }
    
    public function dataProviderSettingSafetyLevel()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, 1),
            array(true, -1),
            array(true, ''),
            array(true, '    '),
            array(true, 'invalid'),
            array(false, null),
            array(false, CustomSearch::SAFETY_LEVEL_HIGH),
            array(false, CustomSearch::SAFETY_LEVEL_MEDIUM),
            array(false, CustomSearch::SAFETY_LEVEL_OFF),
        );
    }

    /**
     * @dataProvider dataProviderSettingSafetyLevel
     */
    public function testSettingSafetyLevel($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setSafetyLevel($data));
        $this->assertEquals($data, $this->clientStub->getSafetyLevel());
    }
    
    public function dataProviderSettingStartIndex()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, ''),
            array(true, '    '),
            array(true, 'invalid'),
            array(true, -1),
            array(true, 0),
            array(true, 92),
            array(true, 5.5),
            array(false, null),
            array(false, 1),
            array(false, 50),
            array(false, 91),
        );
    }

    /**
     * @dataProvider dataProviderSettingStartIndex
     */
    public function testSettingStartIndex($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\CustomSearch', $this->clientStub->setStartIndex($data));
        $this->assertEquals($data, $this->clientStub->getStartIndex());
    }

    public function dataProviderGetApiRequestUrl()
    {
        return array(
            array(
                '?alt=json&prettyprint=false&key=key&q=flowers',
                'key', 'flowers'
            ),
            array(
                '?alt=json&prettyprint=false&cx=cseid&key=key&q=flowers&filter=true',
                'key', 'flowers', 'cseid', 'http://www.google.co.uk/', true
            ),
            array(
                '?alt=json&prettyprint=false&cref=http%3A%2F%2Fwww.google.co.uk%2F&key=key&q=flowers&filter=true',
                'key', 'flowers', null, 'http://www.google.co.uk/', true
            ),
            array(
                '?alt=json&prettyprint=false&cx=cseid&key=key&lr=lang_en&num=10&q=flowers&safe=high&start=5&filter=true',
                'key', 'flowers', 'cseid', null, true, 'lang_en', 10, CustomSearch::SAFETY_LEVEL_HIGH, 5
            ),
        );
    }

    /**
     * @dataProvider dataProviderGetApiRequestUrl
     */
    public function testGetApiRequestUrl($expectedResult, $apiKey, $query, $customSearchEngineId = null, $customSearchEngineSpecUrl = null, $filterDuplicates = null, $languageRestriction = null, $numberOfResults = null, $safetyLevel = null, $startIndex = null)
    {
        $this->clientStub->setApiKey($apiKey);
        $this->clientStub->setQuery($query);
        $this->clientStub->setCustomSearchEngineId($customSearchEngineId);
        $this->clientStub->setCustomSearchEngineSpecUrl($customSearchEngineSpecUrl);
        $this->clientStub->setFilterDuplicates($filterDuplicates);
        $this->clientStub->setLanguageRestriction($languageRestriction);
        $this->clientStub->setNumberOfResults($numberOfResults);
        $this->clientStub->setSafetyLevel($safetyLevel);
        $this->clientStub->setStartIndex($startIndex);

        $this->assertEquals(
            CustomSearch::API_URL . $expectedResult,
            $this->clientStub->getApiRequestUrl()
        );
    }

    public function testExecuteRequest()
    {
        try
        {
            $response = $this->clientStub->executeRequest();
            $this->fail('Excepted \RuntimeException to be thrown.');
        }
        catch(\RuntimeException $e) {}

        $this->clientStub->setApiKey('key');

        try
        {
            $response = $this->clientStub->executeRequest();
            $this->fail('Excepted \RuntimeException to be thrown.');
        }
        catch(\RuntimeException $e) {}

        $this->clientStub->setCustomSearchEngineId('cseid');

        try
        {
            $response = $this->clientStub->executeRequest();
            $this->fail('Excepted \RuntimeException to be thrown.');
        }
        catch(\RuntimeException $e) {}

        $this->clientStub->setQuery('flowers');

        $response = $this->clientStub->executeRequest();
        $this->assertInstanceOf('\Google\Api\Response', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertInstanceOf('\Google\Api\Response\Data\CustomSearch', $response->getData());
    }
}