<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Response\Data;

class AbstractDataTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        try
        {
            $dataObject = new AbstractDataStub(array('invalid' => 'foo'));
            $this->fail('Expected \UnexpectedValueException exception not thrown.');
        }
        catch(\UnexpectedValueException $e) {}

        $dataObject = new AbstractDataStub(array('property' => 'foo'));
        $this->assertEquals($dataObject->property, 'foo');
    }
}

class AbstractDataStub extends AbstractData
{
    public $property;
}