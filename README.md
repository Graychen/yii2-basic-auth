# yii2-basic-auth [![Latest Stable Version](https://poser.pugx.org/graychen/yii2-basic-auth/version)](https://packagist.org/packages/graychen/yii2-basic-auth)
[![Total Downloads](https://poser.pugx.org/graychen/yii2-basic-auth/downloads)](https://packagist.org/packages/graychen/yii2-basic-auth)
[![Build Status](https://travis-ci.org/Graychen/yii2-basic-auth.svg?branch=master)](https://travis-ci.org/Graychen/yii2-basic-auth)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/build-status/master)
[![StyleCI](https://styleci.io/repos/109097207/shield?branch=master)](https://styleci.io/repos/109097207)

This is a basic module for app registration. It registers applications through the background and verifies the API in the way of basic authentication
(这是一个app注册的基本模块，通过后台注册应用，以基本认证的方式对api进行验证)

## Usage

### Config Migration

```php
'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@graychen/yii2/basic/auth/migrations'
            ],
        ],
    ],
```

## Run Migration

```bash
yii migrate/up
```

## Config Module in components part

``` php
'auth' => [
    'class' => 'graychen\yii2\basic\auth\Module',
    ]
```

## Backend

### after that,you can website `https://localhost/admin/app`

## ChangeLog

[changelog](https://github.com/Graychen/yii2-basic-auth/blob/master/CHANGELOG.md)
