Google APIs PHP Clients
=======================

The aim of this project is to create a well structured PHP library for accessing Google APIs available through the [Google APIs console][1].

Currently the library enables you to interact programmatically with the following Google APIs,

* [Google Custom Search API v1][2]
* [Google Translate API v2][3] _(Paid service only as of Dec 1st, 2011)_
* (More coming soon)

Requirements
------------

* The library is only supported on PHP 5.3.0 and up.
* It has been assumed an autoloader will be present. If you require one, you can find one [here][4].
* Each API requires an API key, which you can get from the [Google APIs console][1].

Installation
------------

Simply download the library and add the `src` folder to your project.

Usage
-----

**Note:** More extensive documentation will be made available at a later date.

### Custom Search API

**Note:** As well as an API key, the [Google Custom Search API v1][2] also requires either a [Google Custom Search][5] ID or specification URL.

The following makes a simple [Google Custom Search API v1][2] request,

    $apiClient = new \Google\Api\CustomSearch();
    $apiClient->setApiKey('INSERT_YOUR_API_KEY_HERE');
    $apiClient->setCustomSearchEngineId('INSERT_YOUR_CUSTOM_SEARCH_ENGINE_ID_HERE');
    $apiClient->setQuery('flowers');

    $response = $apiClient->executeRequest();

To get the results from the `$response`,

    if ($response->isSuccess())
    {
        foreach($response->getData()->getItems() as $item)
        {
            echo $item->getHtmlTitle(), ' - <a href="', $item->getLink(), '">', $item->getDisplayLink(), '</a><br />';
        }
    }

### Translate API

The following makes a simple [Google Translate API v2][3] request,

    $apiClient = new \Google\Api\Translate();
    $apiClient->setApiKey('INSERT_YOUR_API_KEY_HERE');
    $apiClient->addSourceText('The quick brown fox jumps over the lazy dog.');
    $apiClient->setTargetLanguage('fr');

    $response = $apiClient->executeRequest();

To get the translations from the `$response`,

    if ($response->isSuccess())
    {
        foreach($response->getData()->getTranslations() as $translation)
        {
            echo $translation->getTranslatedText(), '<br />';
        }
    }

Testing
-------

To run the tests, make sure you have PHPUnit 3.6.0 and up installed, and just run the following in the project root,

    phpunit

[1]: https://code.google.com/apis/console/
[2]: https://code.google.com/apis/customsearch/v1/overview.html
[3]: http://code.google.com/apis/language/translate/overview.html
[4]: http://groups.google.com/group/php-standards/web/psr-0-final-proposal
[5]: http://www.google.com/cse/