##  Blog System



This is a Blog System  that registered users can add posts,update posts and delete own posts.Also Recently addd Blog Posts Can be Viewd


## Requirements
    PHP version: 8.1
    MySQL
    Laravel version: 10.x

## Installation

#### 1. Download

      git clone  https://github.com/Madusankaperera95/LaraBlogSystem.git

#### 2. Environment Files
This package ships with a .env.example file in the root of the project.

You must rename this file to just .env

Note: Make sure you have hidden files shown on your system.

#### 3. Composer
Laravel project dependencies are managed through the PHP Composer tool. The first step is to install the depencencies by navigating into your project in terminal and typing this command:

        composer install

#### 4. Create Database
You must create your database on your server and on your .env file update the following lines:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=
        DB_USERNAME=
        DB_PASSWORD=

Change these lines to reflect your new database settings.

#### 5. Enable Mail Configurations

        MAIL_MAILER=smtp
        MAIL_HOST=
        MAIL_PORT=
        MAIL_USERNAME=
        MAIL_PASSWORD=
Fill these Env fields to enable email sending configuration.

#### 5. Artisan Commands

The first thing we are going to do is set the key that Laravel will use when doing encryption..

       php artisan key:generate

We are going to run the built in migrations to create the database tables:

        php artisan migrate

You should see a message for each table migrated.

After that run
      
        php artisan db:seed

This will generate a new user and add new posts

To Run the application

      php artisan serve

#### 6. User Credentials

email : test@gmail.com
pass: password
