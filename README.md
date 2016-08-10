[![Latest Stable Version](https://poser.pugx.org/3f/pygmentize/v/stable.png)](https://packagist.org/packages/3f/pygmentize)
[![Latest Unstable Version](https://poser.pugx.org/3f/pygmentize/v/unstable.png)](https://packagist.org/packages/3f/pygmentize)
[![Build Status](https://scrutinizer-ci.com/g/dedalozzo/pygmentize/badges/build.png?b=master)](https://scrutinizer-ci.com/g/dedalozzo/pygmentize/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dedalozzo/pygmentize/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dedalozzo/pygmentize/?branch=master)
[![License](https://poser.pugx.org/3f/pygmentize/license.svg)](https://packagist.org/packages/3f/pygmentize)
[![Total Downloads](https://poser.pugx.org/3f/pygmentize/downloads.png)](https://packagist.org/packages/3f/pygmentize)


Pygmentize
==========
Pygmentize is a wrapper to `pygmentize`, the command line interface provided by [Pygments](http://pygments.org), a
Python syntax highlighter. Pygmentize is smart enough to raise an exception in case Pygments returns an error.


Composer Installation
---------------------

To install Pygmentize, you first need to install [Composer](http://getcomposer.org/), a Package Manager for
PHP, following those few [steps](http://getcomposer.org/doc/00-intro.md#installation-nix):

```sh
curl -s https://getcomposer.org/installer | php
```

You can run this command to easily access composer from anywhere on your system:

```sh
sudo mv composer.phar /usr/local/bin/composer
```


Pygmentize Installation
-----------------------
Once you have installed Composer, it's easy install Pygmentize.

1. Edit your `composer.json` file, adding Pygmentize to the require section:
```sh
{
    "require": {
        "3f/pygmentize": "dev-master"
    },
}
```
2. Run the following command in your project root dir:
```sh
composer update
```


Usage
-----
Pygmentize is really easy to use, having only one static method. You just call `highlight()` like follows:

```php
Pygmentize::highlight($code, $language);
```

Methods
-------

### Pygmentize::highlight()

```php
public static function highlight(
    $source,
    $language,
    $encoding = "utf-8",
    $formatter = "html",
    $style = "borland"
)
```

Formats the provided source code using the specified formatter and style.

**Parameters**

* source

  The source code.

* language

  The programming language name of the source code.

* encoding

  The file input and output encodings.

* formatter

  The output will be created using the provided formatter.

* style

  The style used by the formatter.

**Returns**

Returns the highlighted source code.

**Exceptions**

* RuntimeException

  Cannot execute the `pygmentize` command.

* RuntimeException

  Cannot create the temporary file with the source code.


Documentation
-------------
The documentation can be generated using [Doxygen](http://doxygen.org). A `Doxyfile` is provided for your convenience.


Requirements
------------
- PHP 5.4.0 or above.
- [Pygments](http://pygments.org) 1.6 or above.


Authors
-------
Filippo F. Fadda - <filippo.fadda@programmazione.it> - <http://www.linkedin.com/in/filippofadda>


License
-------
Pygmentize is licensed under the Apache License, Version 2.0 - see the LICENSE file for details.
