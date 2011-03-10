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

class ErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $error = new Error(123, 'foo');

        $this->assertEquals(123, $error->getCode());
        $this->assertEquals('foo', $error->getMessage());
    }
}