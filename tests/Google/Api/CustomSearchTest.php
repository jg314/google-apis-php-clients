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
                         ->will($this->returnValue(file_get_contents(__DIR__.'/Fixtures/translate.json')));
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
                '?prettyprint=false&key=key&q=string&target=en',
                'key', 'string', 'en'
            ),
            array(
                '?prettyprint=false&key=key&q=string&q=string&target=en',
                'key', array('string', 'string'), 'en'
            ),
            array(
                '?prettyprint=false&format=html&key=key&q=string&source=de&target=en',
                'key', 'string', 'en', 'html', 'de'
            ),
            array(
                '?prettyprint=false&format=html&key=key&q=string1&q=string2&source=de&target=en',
                'key', array('string1', 'string2'), 'en', 'html', 'de'
            ),
        );
    }
}