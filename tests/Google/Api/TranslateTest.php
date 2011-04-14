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

        $this->clientStub->expects($this->any())
                         ->method('executeApiRequest')
                         ->will($this->returnValue(file_get_contents(__DIR__.'/Fixtures/translate.json')));
    }

    public function testConstruct()
    {
        $client = new Translate();
        $this->assertEquals(array(), $client->getSourceText());

        $client = new Translate('foo');
        $this->assertEquals(array('foo'), $client->getSourceText());

        $client = new Translate(array('foo', 'bar'));
        $this->assertEquals(array('foo', 'bar'), $client->getSourceText());
    }

    public function testSettingAdapter()
    {
        $this->assertInstanceOf('\Google\Api\Adapter\Curl', $this->clientStub->getAdapter());

        $adapter = new \Google\Api\Adapter\FileGetContents();
        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->setAdapter($adapter));
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
        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->setApiKey($data));
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
        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->setFormat($data));
        $this->assertEquals($data, $this->clientStub->getFormat());
    }

    public function dataProviderSettingSourceText()
    {
        return array(
            array(true, true),
            array(true, false),
            array(true, null),
            array(true, ''),
            array(true, '   '),
            array(true, array()),
            array(true, array('')),
            array(true, array('    ')),
            array(true, array('foo', '')),
            array(true, array('foo', '', 'bar')),
            array(false, 'foo', array('foo')),
            array(false, array('foo')),
            array(false, array('foo', 'bar')),
        );
    }

    /**
     * @dataProvider dataProviderSettingSourceText
     */
    public function testSettingSourceText($expectError, $data, $expectedData = null)
    {
        $this->setExpectedException($expectError ? 'InvalidArgumentException' : null);
        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->setSourceText($data));
        $this->assertEquals($expectedData !== null ? $expectedData : $data, $this->clientStub->getSourceText());
    }

    public function testAddingSourceText()
    {
        $this->assertEquals(array(), $this->clientStub->getSourceText());

        try
        {
            $this->clientStub->addSourceText(null);
            $this->fail('Expected \InvalidArgumentException to be thrown.');
        }
        catch (\InvalidArgumentException $e) {}

        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->addSourceText('foo'));
        $this->assertEquals(array('foo'), $this->clientStub->getSourceText());

        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->addSourceText('bar'));
        $this->assertEquals(array('foo', 'bar'), $this->clientStub->getSourceText());
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
        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->setSourceLanguage($data));
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
        $this->assertInstanceOf('\Google\Api\Translate', $this->clientStub->setTargetLanguage($data));
        $this->assertEquals($data, $this->clientStub->getTargetLanguage());
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

    /**
     * @dataProvider dataProviderGetApiRequestUrl
     */
    public function testGetApiRequestUrl($expectedResult, $apiKey, $sourceText, $targetLanguage, $format = null, $sourceLanguage = null)
    {
        $this->clientStub->setApiKey($apiKey);
        $this->clientStub->setFormat($format);
        $this->clientStub->setSourceLanguage($sourceLanguage);
        $this->clientStub->setSourceText($sourceText);
        $this->clientStub->setTargetLanguage($targetLanguage);

        $this->assertEquals(
            Translate::API_URL . $expectedResult,
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

        $this->clientStub->addSourceText('The quick brown fox jumps over the lazy dog.');

        try
        {
            $response = $this->clientStub->executeRequest();
            $this->fail('Excepted \RuntimeException to be thrown.');
        }
        catch(\RuntimeException $e) {}

        $this->clientStub->setTargetLanguage('fr');

        $response = $this->clientStub->executeRequest();
        $this->assertInstanceOf('\Google\Api\Response', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertInstanceOf('\Google\Api\Data\Translate', $response->getData());
    }
}