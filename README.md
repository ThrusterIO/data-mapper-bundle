# DataMapper Bundle

[![Latest Version](https://img.shields.io/github/release/ThrusterIO/data-mapper-bundle.svg?style=flat-square)]
(https://github.com/ThrusterIO/data-mapper-bundle/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)]
(LICENSE)
[![Build Status](https://img.shields.io/travis/ThrusterIO/data-mapper-bundle/php5.svg?style=flat-square)]
(https://travis-ci.org/ThrusterIO/data-mapper-bundle)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ThrusterIO/data-mapper-bundle/php5.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/data-mapper-bundle)
[![Quality Score](https://img.shields.io/scrutinizer/g/ThrusterIO/data-mapper-bundle/php5.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/data-mapper-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/thruster/data-mapper-bundle.svg?style=flat-square)]
(https://packagist.org/packages/thruster/data-mapper-bundle)

[![Email](https://img.shields.io/badge/email-team@thruster.io-blue.svg?style=flat-square)]
(mailto:team@thruster.io)

The Thruster DataMapper Bundle.


## Install

Via Composer

``` bash
$ composer require thruster/data-mapper-bundle ">=1.0,<2.0"
```


## Usage

This bundle wraps DataMapper component to provide integration with Symfony by using tagged services.

```xml
<service id="some_data_mapper" class="SomeDataMapper">
    <tag name="thruster_data_mapper"/>
</service>
```

```php
$output = $this->container->get('thruster_data_mappers')->getMapper('some_mapper')->map($input);
```

Using provided trait

```php
use DataMapperAwareTrait;
//...
$output = $this->getDataMapper('some_mapper')->map($input);
```


## Testing

``` bash
$ composer test
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## License

Please see [License File](LICENSE) for more information.
