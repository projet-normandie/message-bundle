ProjetNormandieMessageBundle
===========================

Master
------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/?branch=master)

Develop
-------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/projet-normandie/MessageBundle/?branch=develop)

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

Step 3: Configuration
---------------------

### Database

In order to link your User entity to this module you should add the following configuration:
(Replace ProjetNormandie\UserBundle\Entity\User with your user class).

[Official documentation](http://symfony.com/doc/current/cookbook/doctrine/resolve_target_entity.html)

```yaml
# Doctrine Configuration - config.yml
doctrine:
    orm:
        ...
        resolve_target_entities:
            ProjetNormandie\MessageBundle\Entity\UserInterface: ProjetNormandie\UserBundle\Entity\User
```

After resolving the entity you can update your database schema.
