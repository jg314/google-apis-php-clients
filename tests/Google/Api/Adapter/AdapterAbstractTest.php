<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Adapter;

abstract class AdapterAbstractTest extends \PHPUnit_Framework_TestCase
{
    abstract protected function getAdapter();

    public function testExecuteRequest()
    {
        $adapter = $this->getAdapter();

        try
        {
            $adapter->executeRequest('');
            $this->fail('Expected exception to be throw.');
        }
        catch (\RuntimeException $e) {}

        $response = $adapter->executeRequest('http://www.google.co.uk/');
        $this->assertType('string', $response);
        $this->assertTrue(strlen(trim($response)) > 0);
    }
}