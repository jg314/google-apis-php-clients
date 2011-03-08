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

/**
 * Translate is the main client class for the Google Translate API
 *
 * @author Stephen Melrose <me@stephenmelrose.co.uk>
 */
class Translate
{
    const PARAMETER_API_KEY = 'key';
    const PARAMETER_FORMAT = 'format';
    const PARAMETER_PRETTYPRINT = 'prettyprint';
    const PARAMETER_QUERY = 'q';
    const PARAMETER_SOURCE_LANGUAGE = 'source';
    const PARAMETER_TARGET_LANGUAGE = 'target';

    const FORMAT_HTML = 'html';
    const FORMAT_TEXT = 'text';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var array
     */
    protected $queries = array();

    /**
     * @var string
     */
    protected $sourceLanguage;

    /**
     * @var string
     */
    protected $targetLanguage;

    /**
     * Constructs a new Google Translate API client.
     * 
     * @param array|string $query A single string or an array of strings to translate.
     */
    public function __construct($query = null)
    {
        if($query !== null)
        {
            $this->setQueries(is_array($query) ? $query : array($query));
        }
    }

    /**
     * Gets the API key to used for the request.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Sets the API key to used for the request.
     *
     * @param string $apiKey
     *
     * @return Translate
     *
     * @throws \InvalidArgumentException
     *
     * @link https://code.google.com/apis/console
     */
    public function setApiKey($apiKey)
    {
        if (!(is_string($apiKey) && strlen(trim($apiKey)) > 0))
        {
            throw new \InvalidArgumentException('Invalid API key. Please provide a non-empty string.');
        }

        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Gets the format of the string(s) to be translated.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets the format of the string(s) to be translated.
     * 
     * @param string $format
     * 
     * @return Translate
     *
     * @throws \InvalidArgumentException
     *
     * @see FORMAT_HTML, FORMAT_TEXT
     */
    public function setFormat($format = null)
    {
        if ($format !== null)
        {
            if (is_bool($format))
            {
                throw new \InvalidArgumentException('Invalid format. Please provide either "text" or "html".');
            }

            switch($format)
            {
                case self::FORMAT_HTML:
                case self::FORMAT_TEXT:
                    break;
                default:
                    throw new \InvalidArgumentException('Invalid format. Please provide either "text" or "html".');#
                    break;
            }
        }

        $this->format = $format;
        return $this;
    }

    /**
     * Gets the strings to be translated.
     *
     * @return array
     */
    public function getQueries()
    {
        return $this->queries;
    }

    /**
     * Adds a string to be translated.
     *
     * @param string $query
     *
     * @return Translate
     *
     * @throws \InvalidArgumentException
     */
    public function addQuery($query)
    {
        if (!$this->validateQuery($query))
        {
            throw new \InvalidArgumentException('Invalid query. Please provide a non-empty string.');
        }

        array_push($this->queries, $query);
        return $this;
    }

    /**
     * Sets the strings to be translated.
     * 
     * @param array $queries
     *
     * @return Translate
     *
     * @throws \InvalidArgumentException
     */
    public function setQueries(array $queries)
    {
        if (count($queries) == 0)
        {
            throw new \InvalidArgumentException('Invalid queries. Please provide a non-empty array of strings.');
        }

        foreach($queries as $key => $query)
        {
            if (!$this->validateQuery($query))
            {
                throw new \InvalidArgumentException(sprintf('Invalid query at index "%s". Please provide a non-empty string.', $key));
            }
        }

        $this->queries = $queries;
        return $this;
    }

    /**
     * Validates a string to be translated.
     *
     * @param string $query
     *
     * @return boolean
     */
    protected function validateQuery($query)
    {
        return is_string($query) && strlen(trim($query)) > 0;
    }

    /**
     * Gets the source language code of the string(s) to translate.
     *
     * @return string
     */
    public function getSourceLanguage()
    {
        return $this->sourceLanguage;
    }

    /**
     * Sets the source language code of the string(s) to translate.
     *
     * Note: If not specified, the system will attempt to identify the source language code automatically.
     *
     * @param string $sourceLanguage
     *
     * @return Translate
     *
     * @throws \InvalidArgumentException
     *
     * @see static::getAvailableLanguages()
     */
    public function setSourceLanguage($sourceLanguage = null)
    {
        if ($sourceLanguage !== null && !(is_string($sourceLanguage) && preg_match(static::getAvailableLanguageCodesRegex(), $sourceLanguage)))
        {
            throw new \InvalidArgumentException('Invalid source language. Please provide a valid language code');
        }

        $this->sourceLanguage = $sourceLanguage;
        return $this;
    }

    /**
     * Gets the target language code the string(s) will be translated into.
     *
     * @return string
     */
    public function getTargetLanguage()
    {
        return $this->targetLanguage;
    }

    /**
     * Sets the target language code the string(s) will be translated into.
     *
     * @param string $targetLanguage
     *
     * @return Translate
     *
     * @throws \InvalidArgumentException
     *
     * @see static::getAvailableLanguages()
     */
    public function setTargetLanguage($targetLanguage)
    {
        if (!(is_string($targetLanguage) && preg_match(static::getAvailableLanguageCodesRegex(), $targetLanguage)))
        {
            throw new \InvalidArgumentException('Invalid source language. Please provide a valid language code');
        }

        $this->targetLanguage = $targetLanguage;
        return $this;
    }

    /**
     * Gets a list of languages the Google Translate API supports.
     *
     * @return array
     *
     * @link http://code.google.com/apis/language/translate/v2/using_rest.html#language-params
     */
    public static function getAvailableLanguages()
    {
        return array(
            'af' => 'Afrikaans',
            'sq' => 'Albanian',
            'ar' => 'Arabic',
            'be' => 'Belarusian',
            'bg' => 'Bulgarian',
            'ca' => 'Catalan',
            'zh-CN' => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'hr' => 'Croatian',
            'cs' => 'Czech',
            'da' => 'Danish',
            'nl' => 'Dutch',
            'en' => 'English',
            'et' => 'Estonian',
            'tl' => 'Filipino',
            'fi' => 'Finnish',
            'fr' => 'French',
            'gl' => 'Galician',
            'de' => 'German',
            'el' => 'Greek',
            'ht' => 'Haitian Creole',
            'iw' => 'Hebrew',
            'hi' => 'Hindi',
            'hu' => 'Hungarian',
            'is' => 'Icelandic',
            'id' => 'Indonesian',
            'ga' => 'Irish',
            'it' => 'Italian',
            'ja' => 'Japanese',
            'lv' => 'Latvian',
            'lt' => 'Lithuanian',
            'mk' => 'Macedonian',
            'ms' => 'Malay',
            'mt' => 'Maltese',
            'no' => 'Norwegian',
            'fa' => 'Persian',
            'pl' => 'Polish',
            'pt' => 'Portuguese',
            'ro' => 'Romanian',
            'ru' => 'Russian',
            'sr' => 'Serbian',
            'sk' => 'Slovak',
            'sl' => 'Slovenian',
            'es' => 'Spanish',
            'sw' => 'Swahili',
            'sv' => 'Swedish',
            'th' => 'Thai',
            'tr' => 'Turkish',
            'uk' => 'Ukrainian',
            'vi' => 'Vietnamese',
            'cy' => 'Welsh',
            'yi' => 'Yiddish'
        );
    }

    /**
     * Gets the regex pattern to validate source and target languages against.
     *
     * @return string
     *
     * @see static::getAvailableLanguages()
     */
    protected function getAvailableLanguageCodesRegex()
    {
        return sprintf('/^(%s)$/', implode('|', array_keys(static::getAvailableLanguages())));
    }
}