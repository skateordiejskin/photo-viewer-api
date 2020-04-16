# Photo Viewer API

Requirements:
- PHP >=7.2.5
- Redis 5
- MySQL >= 8


1) Create database named 'photo_viewer'

create the database tables

`php artisan migrate`

linking for image display

`php artisan storage:link`

import photos and save records to database

`php artisan photos:import`

convert photos to base64, create grayscale

`php artisan photos:process`

start the server

`php artisan serve`

