# ownCloud Documentation Sitemap Builder

This is a simple project to build a valid sitemap.xml string from the files in the documentation repository.

[![Build Status](https://img.shields.io/travis/owncloud/owncloud-documentation-sitemap-builder/master.svg?style=flat-square)](https://travis-ci.org/owncloud/owncloud-documentation-sitemap-builder)
[![Coverage Status](https://img.shields.io/coveralls/owncloud/owncloud-documentation-sitemap-builder/master.svg?style=flat-square)](https://coveralls.io/r/owncloud/owncloud-documentation-sitemap-builder?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/owncloud/owncloud-documentation-sitemap-builder.svg?style=flat-square)](https://scrutinizer-ci.com/g/owncloud/owncloud-documentation-sitemap-builder/?branch=master)
[![Latest Version](https://img.shields.io/github/release/owncloud/owncloud-documentation-sitemap-builder.svg?style=flat-square)](https://packagist.org/packages/owncloud/owncloud-documentation-sitemap-builder)
[![Total Downloads](https://img.shields.io/packagist/dt/owncloud/owncloud-documentation-sitemap-builder.svg?style=flat-square)](https://packagist.org/packages/owncloud/owncloud-documentation-sitemap-builder)

## Why?

This project was created for a couple of reasons. 
Firstly, to generate a valid sitemap.xml file for the documentation, and then to keep it up to date.
Maintaining software documentation isn't that simple.
And getting the right information (meaning the most up to date information) to appear in search results requires a valid and well-constructed sitemap.xml file.
To create and maintain one by hand for a project of this size isn't practical.
So this library was created to automate the process, whether once or with each merge to master. 

## Installation

To install the package, run `composer require settermjd/owncloud-documentation-sitemap-builder`.

## Usage

Below is a sample of how to use the package.
It shows how to instantiate a new `SitemapBuilder` instance, which is constructed with the default ownCloud basePath and version settings.
On this instance:
 
1. A call to `getFileList` is made. This converts the `.rst` files found under `../documentation` into a set of equivalent URLs.
2. The generated URLs list is then passed to `generateSiteMapXml`, which builds a sitemap.xml string from the supplied information.    

```php
<?php

require_once ('vendor/autoload.php');

$builder = new OwnCloud\SiteMapBuilder\SitemapBuilder();

$builder->generateSiteMapXml(
    $builder->getFileList(
        realpath('../documentation/'), 
        'rst'
    )
);
````

## Contributing

See the [CONTRIBUTING](CONTRIBUTING.md) file.

