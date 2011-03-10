<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Data\Parser\Translate;

class TranslationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Translation
     */
    protected $parserStub;

    protected function setUp()
    {
        $this->parserStub = new Translation();
    }

    public function dataProviderParse()
    {
        $testCases = array();

        $data = new \stdClass();
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->translatedText = null;
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->translatedText = true;
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->translatedText = false;
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->translatedText = array();
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->translatedText = '';
        array_push($testCases, array(false, $data));

        $data = clone $data;
        $data->translatedText = 'foo';
        array_push($testCases, array(false, $data));

        $data = clone $data;
        $data->detectedSourceLanguage = null;
        array_push($testCases, array(false, $data));

        $data = clone $data;
        $data->detectedSourceLanguage = true;
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->detectedSourceLanguage = false;
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->detectedSourceLanguage = array();
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->detectedSourceLanguage = '';
        array_push($testCases, array(true, $data));

        $data = clone $data;
        $data->detectedSourceLanguage = 'foo';
        array_push($testCases, array(false, $data));

        return $testCases;
    }

    /**
     * @dataProvider dataProviderParse
     */
    public function testParse($expectError, $data)
    {
        $this->setExpectedException($expectError ? '\Google\Api\Data\Parser\Exception' : null);
        $result = $this->parserStub->parse($data);
        $this->assertType('Google\Api\Data\Translate\Translation', $result);
    }
}