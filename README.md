Google APIs PHP Clients
=======================

The aim of this project is to create a well structured library for accessing Google APIs available through the [Google APIs console][1].

Currently the library contains PHP clients that enable you to interact programmatically with the following APIs,

* [Google Translate API][2]
* (More coming soon)

Requirements
------------

* The library is only supported on PHP 5.3.0 and up.
* It has been assumed an autoloader will be present. If you require one, you can find one [here][3].
* Each API requires an API key, which you can get from the [Google APIs console][1].

Installation
------------

Simply download the library and add the `src` folder to your project.

Usage
-----

**Note:** More extensive documentation will be made available at a later date.

### Translate API

The following makes a simple Google Translate API request,

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
            echo $translation->getTranslatedText(), "<br />";
        }
    }

Testing
-------

To run the tests, make sure you have PHPUnit installed, and just run the following in the project root,

    phpunit

[1]: https://code.google.com/apis/console/
[2]: http://code.google.com/apis/language/translate/overview.html
[3]: http://groups.google.com/group/php-standards/web/psr-0-final-proposal