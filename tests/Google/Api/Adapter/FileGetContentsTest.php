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

class FileGetContentsTest extends AdapterAbstractTest
{
    public function getAdapter() {
        return new FileGetContents();
    }
}