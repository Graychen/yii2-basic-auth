# yii2-basic-auth
[![Latest Stable Version](https://poser.pugx.org/graychen/yii2-basic-auth/version)](https://packagist.org/packages/graychen/yii2-basic-auth)
[![Total Downloads](https://poser.pugx.org/graychen/yii2-basic-auth/downloads)](https://packagist.org/packages/graychen/yii2-basic-auth)
[![Build Status](https://travis-ci.org/Graychen/yii2-basic-auth.svg?branch=master)](https://travis-ci.org/Graychen/yii2-basic-auth)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Graychen/yii2-basic-auth/build-status/master)
[![StyleCI](https://styleci.io/repos/109097207/shield?branch=master)](https://styleci.io/repos/109097207)

This is a background for yii-queue, there are queue statistics, temporary support redis driver
# Migrate database

## To add a lookup table to your database, following is the sql for lookup:

``` mysql
CREATE TABLE IF NOT EXISTS `tb_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` string(32) DEFAULT NULL,
  `app_description` string(125) DEFAULT NULL,
  `app_key` char(36),
  `app_secret` char(32),
  `status` boolean NOT NULL DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB  DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1 ;
```
## Or else you can use yii migration
```
yii migrate/up --migrationPath=@graychen/yii2/basic/auth
```
## Usage
### Config -> main.php
```
'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                '@graychen/yii2/basic/auth/migrations'
            ],
        ],
    ],
```
### Config Module in components part
``` php
'queue' => [
            'class' => 'graychen\yii2\basic\auth\Module',
]
```
## View
### after that,you can website `https://localhost/admin/app`

## ChangeLog
[changelog](https://github.com/Graychen/yii2-basic-auth/blob/master/CHANGELOG.md)


