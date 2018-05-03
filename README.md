# slimframework-sqlite-example
Slim Framework 3 + Twig + Illuminate + sqlite + jQuery + Bootstrap

# Some important steps to execute in console
* php -S localhost:8080
* composer require slim/slim "^3.0"
* composer require slim/twig-view
* composer dump-autoload -o
* composer require illuminate/database

# Table sqlite
* CREATE TABLE "users" ( `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, `name` VARCHAR ( 255 ) NOT NULL, `password` VARCHAR ( 255 ) NOT NULL, `email` VARCHAR(255) NOT NULL, `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP )