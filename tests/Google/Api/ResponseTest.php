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

use Google\Api\Response\Error as ErrorStub;
use Google\Api\Response\Data\Translate as DataStub;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function dataProviderConstruct()
    {
        return array(
            array(true, array('foo')),
            array(true, true),
            array(true, false),
            array(true, null),
            array(true, ''),
            array(true, '    '),
            array(true, 'apikey'),
            array(true, new \stdClass()),
            array(false, new ErrorStub(123, 'foo')),
            array(false, new DataStub(array()))
        );
    }

    /**
     * @dataProvider dataProviderConstruct
     */
    public function testConstruct($expectError, $data)
    {
        $this->setExpectedException($expectError ? 'LogicException' : null);

        $response = new Response($data);
    }

    public function testGetData()
    {
        $stub = new DataStub(array());
        
        $response = new Response($stub);
        
        $this->assertTrue($stub === $response->getData());
        $this->assertNull($response->getError());
    }

    public function testGetError()
    {
        $stub = new ErrorStub(123, 'foo');

        $response = new Response($stub);

        $this->assertTrue($stub === $response->getError());
        $this->assertNull($response->getData());
    }
}