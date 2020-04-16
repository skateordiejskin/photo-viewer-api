# Photo Viewer API

Requirements:
- PHP >=7.2.5
- Redis 5
- MariaDB/MySQL >= 8

## INSTALLATION STEPS

1) If not installed, install homebrew, mariadb/MySQL, PHP, and Redis

    ```
     /bin/bash -c "(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"

     brew install php redis composer mariadb
     brew services start php
     brew services start redis
     brew services start mariadb
    ```
    Note: If Xcode is not installed, you will be prompted to install clang and command line tools. When the notification appears, click install
2) Clone repo and cd into folder

3) Install packages

     ` composer install`
3) Create .env file from sample and update values for database and redis(if not installed using default settings)

    ` cp .env.example .env`


4) Create database named 'photo_viewer'

5) Run the databse migration

    `php artisan migrate`

6) linking for image display

    `php artisan storage:link`

7) import photos and save records to database

    `php artisan photos:import`

8) convert photos to base64, create grayscale

    `php artisan photos:process`

9) start the server

    `php artisan serve`


Notes:

-  `./app/Console/Commands/PhotoImport.php` and `./app/Console/Commands/PhotoProcess.php` are the two artisan commands. They contain all of the download and storage logic
- `./app/Http/Controllers/PhotosController.php` is the controller that does most of the heavy lifting
