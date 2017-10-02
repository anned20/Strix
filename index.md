[![Packagist](https://img.shields.io/packagist/v/anned20/Strix.svg)](https://packagist.org/packages/anned20/strix)
[![Latest Stable Version](https://poser.pugx.org/anned20/strix/v/stable)](https://packagist.org/packages/anned20/strix)
[![Build Status](https://travis-ci.org/anned20/Strix.svg?branch=master)](https://travis-ci.org/anned20/Strix)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/anned20/Strix/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/anned20/Strix/?branch=master)

# Strix

Minimal container for modern PHP applications following the PSR-11 standard

## Installation

`composer require anned20/strix`

## Usage

```php
<?php

require __DIR__.'/vendor/autoload.php';

use anned20\Strix\Container;
use anned20\Strix\Exception\AlreadyInContainerException;
use anned20\Strix\Exception\NotFoundException;

// Create new container
$container = new Container();

// Use the container for variables
$container->add('config', ['hello' => 'world']);

// Use the container for closures
$container->add('function', function () {
	return rand();
});

// Let's use the config
$hello = $container->get('config')['hello'];

// And the function
$rand = $container->get('function')();

// Factories can be made too!
$container->add('factory', function () {
	return new SomeClass();
});

// Just like services
$myService = new SomeClass();

$container->add('service', $myService);

// Whoops!
$container->add('config', ['foo' => 'bar']); // AlreadyInContainerException thrown

// Let's check before adding
if (!$container->has('config')) {
	$container->add('config', ['foo' => 'bar']);
}

// But I want to overwrite the old one! No problem!
if ($container->has('config')) {
	$container->delete('config');
}

$container->add('config', ['foo' => 'bar']);

// Whoops!
$bye = $container->get('bye'); // NotFoundException thrown

```

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## License

Strix is a PSR-11 compliant container

Copyright © 2017 Anne Douwe Bouma

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the "Software"),
to deal in the Software without restriction, including without limitation
the rights to use, copy, modify, merge, publish, distribute, sublicense,
and/or sell copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
