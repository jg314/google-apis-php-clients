<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Response;

use Google\Api\Data\Parser as ResponseDataParser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parser
     */
    protected $parserStub;

    protected function setUp()
    {
        $this->parserStub = new Parser(new StubResponseDataParser());
    }

    public function dataProviderParseFormat()
    {
        return array(
            array(null),
            array(true),
            array(false),
            array(array()),
            array(123),
            array(''),
            array('foo')
        );
    }

    /**
     * @dataProvider dataProviderParseFormat
     */
    public function testParseFormat($apiResponse)
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this->parserStub->parse($apiResponse);
    }

    public function dataProviderParseError()
    {
        return array(
            array(true, '{"error":true}'),
            array(true, '{"error":false}'),
            array(true, '{"error":123}'),
            array(true, '{"error":""}'),
            array(true, '{"error":"foo"}'),
            array(true, '{"error":[]}'),
            array(false, '{"error":{}}'),
            array(false, '{"error":{"code":123}}', 123),
            array(false, '{"error":{"message":"foo"}}', null, "foo"),
            array(false, '{"error":{"code":123,"message":"foo"}}', 123, "foo"),
        );
    }

    /**
     * @dataProvider dataProviderParseError
     */
    public function testParseError($expectError, $apiResponse, $code = null, $message = null)
    {
        $this->setExpectedException($expectError ? '\RuntimeException' : null);
        $result = $this->parserStub->parse($apiResponse);
        $this->assertType('Google\Api\Response', $result);

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getData());
        $this->assertType('Google\Api\Response\Error', $result->getError());

        $this->assertEquals($code, $result->getError()->getCode());
        $this->assertEquals($message, $result->getError()->getMessage());
    }
}

class StubResponseDataParser implements ResponseDataParser
{
    public function parse(\stdClass $data) {}
}