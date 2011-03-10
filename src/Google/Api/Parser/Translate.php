<?php

/*
 * This file is part of the Google APIs PHP Clients package.
 *
 * (c) Stephen Melrose <me@stephenmelrose.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Google\Api\Parser;

use Google\Api\Response;
use Google\Api\Response\Error;
use Google\Api\Response\ErrorException;

use Google\Api\Data\Translate as ResponseData;
use Google\Api\Data\Translate\Translation;

/**
 * Translate parses a raw Google Translate API response and
 * returns a formatted Response object.
 *
 * @author Stephen Melrose <me@stephenmelrose.co.uk>
 */
class Translate
{
    /**
     * Parses a raw Google Translate API response into a formatted Response object.
     * 
     * @param string $apiResponse
     * 
     * @return Response
     *
     * @throws \InvalidArgumentException When the API response is an invalid format.
     * @throws Exception When a parse error occurs.
     */
    public function parse($apiResponse)
    {
        if(!is_string($apiResponse))
        {
            throw new \InvalidArgumentException('Invalid API response format. Expected non-empty string.');
        }

        $response = @json_decode($apiResponse);
        if(!($response instanceof \stdClass))
        {
            throw new Exception('The API response could not be JSON decoded.');
        }

        if(isset($response->error))
        {
            $responseObject = $this->parseError($response->error);
        }
        else
        {
            $responseObject = $this->parseResponse($response);
        }

        return new Response($responseObject);
    }

    /**
     * Parses an errornous Google Translate API response.
     * 
     * @param \stdClass $error
     * 
     * @return Error
     */
    protected function parseError(\stdClass $error)
    {
        return new Error(
            isset($response->error->code) ? $response->error->code : null,
            isset($response->error->message) ? $response->error->message : null
        );
    }

    /**
     * Parses a successful Google Translate API response.
     *
     * @param \stdClass $response
     * 
     * @return ResponseData
     *
     * @throws Exception When a parse error occurs.
     */
    protected function parseResponse(\stdClass $response)
    {
        $responseData = array();

        if(!(isset($response->data) && $response->data instanceof \stdClass))
        {
            throw new Exception('Missing/invalid response data.');
        }

        if(!(isset($response->data->translations) && is_array($response->data->translations)))
        {
            throw new Exception('Missing/invalid translations data.');
        }

        $responseData['translations'] = $this->parseTranslations($response->data->translations);

        return new ResponseData($responseData);
    }

    /**
     * Parses the "translations" part of the API response.
     * 
     * @param array $translations
     * 
     * @return array
     *
     * @throws Exception When a parse error occurs.
     */
    protected function parseTranslations(array $translations)
    {
        $translationObjects = array();

        foreach($translations as $translation)
        {
            if(!($translation instanceof \stdClass))
            {
                throw new Exception('Invalid translation format.');
            }

            array_push($translationObjects, $this->parseTranslation($translation));
        }

        return $translationObjects;
    }

    /**
     * Parses a single translation part of the API response.
     *
     * @param \stdClass $translation
     *
     * @return Translation
     *
     * @throws Exception When a parse error occurs.
     */
    protected function parseTranslation(\stdClass $translation)
    {
        $translationData = array();

        if(!(isset($translation->translatedText) && is_string($translation->translatedText)))
        {
            throw new Exception('Missing/invalid translation translated text.');
        }

        $translationData['translatedText'] = $translation->translatedText;

        if(isset($translation->detectedSourceLanguage))
        {
            if(!(is_string($translation->detectedSourceLanguage) && strlen($translation->detectedSourceLanguage) > 0))
            {
                throw new Exception('Invalid translation detected source language.');
            }

            $translationData['detectedSourceLanguage'] = $translation->detectedSourceLanguage;
        }

        return new Translation($translationData);
    }
}