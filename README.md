# slimframework-sqlite-example
Slim Framework 3 + Twig + Illuminate + sqlite + jQuery + Bootstrap + Authentication User AND Task Model

# Some important steps to execute in console
* php -S localhost:8080
* composer require slim/slim "^3.0"
* composer require slim/twig-view
* composer dump-autoload -o
* composer require illuminate/database
* composer require respect/validation
* composer require slim/csrf
* composer require slim/flash

# Table sqlite
* CREATE TABLE "users" ( `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, `name` VARCHAR ( 255 ) NOT NULL, `password` VARCHAR ( 255 ) NOT NULL, `email` VARCHAR(255) NOT NULL, `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP )

*CREATE TABLE `tasks` ( `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, `name` VARCHAR ( 255 ) NOT NULL, `completed` NUMERIC NOT NULL, `user_id` INTEGER NOT NULL, `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE )