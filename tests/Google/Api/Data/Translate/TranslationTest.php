<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Data\Translate;

class TranslationTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        try
        {
            $dataObject = new Translation(array('invalid' => 'foo'));
            $this->fail('Expected \UnexpectedValueException exception not thrown.');
        }
        catch(\UnexpectedValueException $e) {}

        $dataObject = new Translation(array('translatedText' => 'foo'));
        $this->assertEquals($dataObject->getTranslatedText(), 'foo');
        $this->assertNull($dataObject->getDetectedSourceLanguage());

        $dataObject = new Translation(array('translatedText' => 'foo', 'detectedSourceLanguage' => 'bar'));
        $this->assertEquals($dataObject->getTranslatedText(), 'foo');
        $this->assertEquals($dataObject->getDetectedSourceLanguage(), 'bar');
    }
}