Fimerica App Developer Setup
============================

This is a guide to explain how to set up fimerica-app locally.

Installation
------------

##### Update Composer
~~~
composer update
~~~
##### Create a database for fimerica app if you don't have one, for example:
`CREATE DATABASE hnn CHARACTER SET utf8 COLLATE utf8_general_ci`

##### Initialize your environment
~~~
php init
~~~
Choose your preferred environment option.

*If you don't have a preferred configuration option just choose "DEV"  for the environment choice. Then, enter your database 
configurations for the fimerica app db and the lender db in `config/db-local.php` and `config/lenderDb-local.php`, respectively.
If you are using a local lender db and need data run the following: `mysql -h <host> -u <user> -p <local_fimerica_lender_db_name> < fimerica_lender_testdb.sql`*

##### Run migrations
~~~
php yii migrate
php yii migrate
~~~

