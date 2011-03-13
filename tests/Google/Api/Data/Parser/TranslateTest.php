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

class TranslateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Translation
     */
    protected $parserStub;

    protected function setUp()
    {
        $this->parserStub = new Translate();
    }

    public function dataProviderParse()
    {
        $testCases = array();

        $data = new \stdClass();
        array_push($testCases, array(true, $data));

        $testCasesData = array(
            array(true, null),
            array(true, true),
            array(true, false),
            array(true, array()),
            array(true, ''),
            array(true, 'foo'),
            array(true, new \stdClass())
        );

        foreach($testCasesData as $testCaseData)
        {
            $data = clone $data;
            $data->data = $testCaseData[1];
            array_push($testCases, array($testCaseData[0], $data));
        }

        $testCasesData = array(
            array(true, null),
            array(true, true),
            array(true, false),
            array(true, ''),
            array(true, 'foo'),
            array(true, new \stdClass()),
            array(false, array())
        );

        foreach($testCasesData as $testCaseData)
        {
            $data = clone $data;
            $data->data = clone $data->data;
            $data->data->translations = $testCaseData[1];
            array_push($testCases, array($testCaseData[0], $data));
        }

        return $testCases;
    }

    /**
     * @dataProvider dataProviderParse
     */
    public function testParse($expectError, $data)
    {
        $this->setExpectedException($expectError ? '\Google\Api\Data\Parser\Exception' : null);
        $result = $this->parserStub->parse($data);
        $this->assertType('Google\Api\Data\Translate', $result);
    }
}