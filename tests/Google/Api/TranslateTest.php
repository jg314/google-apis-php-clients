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

class TranslateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Translate
     */
    protected $clientStub;

    protected function setUp()
    {
        $this->clientStub = $this->getMock('\Google\Api\Translate', array('executeApiRequest'));
    }

    public function testConstruct()
    {
        $client = new Translate();
        $this->assertEquals(array(), $client->getQueries());

        $client = new Translate('foo');
        $this->assertEquals(array('foo'), $client->getQueries());

        $client = new Translate(array('foo', 'bar'));
        $this->assertEquals(array('foo', 'bar'), $client->getQueries());
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
        $this->assertType('\Google\Api\Translate', $this->clientStub->setApiKey($data));
        $this->assertEquals($data, $this->clientStub->getApiKey());
    }

    public function dataProviderSettingFormat()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, ''),
            array(true, '    '),
            array(true, 'foo'),
            array(false, null),
            array(false, Translate::FORMAT_HTML),
            array(false, Translate::FORMAT_TEXT)
        );
    }

    /**
     * @dataProvider dataProviderSettingFormat
     */
    public function testSettingFormat($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertType('\Google\Api\Translate', $this->clientStub->setFormat($data));
        $this->assertEquals($data, $this->clientStub->getFormat());
    }

    public function dataProviderSettingQueries()
    {
        return array(
            array(true, array()),
            array(true, array('')),
            array(true, array('    ')),
            array(true, array('foo', '')),
            array(true, array('foo', '', 'bar')),
            array(false, array('foo')),
            array(false, array('foo', 'bar')),
        );
    }

    /**
     * @dataProvider dataProviderSettingQueries
     */
    public function testSettingQueries($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertType('\Google\Api\Translate', $this->clientStub->setQueries($data));
        $this->assertEquals($data, $this->clientStub->getQueries());
    }

    public function testAddingQueries()
    {
        $this->assertEquals(array(), $this->clientStub->getQueries());

        try
        {
            $this->clientStub->addQuery(null);
            $this->fail('Expected InvalidArgumentException to be thrown.');
        }
        catch (\InvalidArgumentException $e) {}

        $this->assertType('\Google\Api\Translate', $this->clientStub->addQuery('foo'));
        $this->assertEquals(array('foo'), $this->clientStub->getQueries());

        $this->assertType('\Google\Api\Translate', $this->clientStub->addQuery('bar'));
        $this->assertEquals(array('foo', 'bar'), $this->clientStub->getQueries());
    }

    public function dataProviderSettingSourceLanguage()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, ''),
            array(true, '    '),
            array(true, 'foo'),
            array(false, null),
            array(false, 'en'),
        );
    }

    /**
     * @dataProvider dataProviderSettingSourceLanguage
     */
    public function testSettingSourceLanguage($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertType('\Google\Api\Translate', $this->clientStub->setSourceLanguage($data));
        $this->assertEquals($data, $this->clientStub->getSourceLanguage());
    }

    public function dataProviderSettingTargetLanguage()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, null),
            array(true, ''),
            array(true, '    '),
            array(true, 'foo'),
            array(false, 'en'),
        );
    }

    /**
     * @dataProvider dataProviderSettingTargetLanguage
     */
    public function testSettingTargetLanguage($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertType('\Google\Api\Translate', $this->clientStub->setTargetLanguage($data));
        $this->assertEquals($data, $this->clientStub->getTargetLanguage());
    }
}