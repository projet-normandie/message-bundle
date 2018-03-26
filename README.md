ProjetNormandieMessageBundle
===========================

Master
------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/?branch=master)
[![Build Status](https://travis-ci.org/projet-normandie/MessageBundle.svg?branch=master)](https://travis-ci.org/projet-normandie/MessageBundle)

Develop
-------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/?branch=develop)
[![Build Status](https://travis-ci.org/projet-normandie/MessageBundle.svg?branch=develop)](https://travis-ci.org/projet-normandie/MessageBundle)

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require projet-normandie/message-bundle "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new ProjetNormandie\MessageBundle\ProjetNormandieMessageBundle(),
        );

        // ...
    }

    // ...
}
```