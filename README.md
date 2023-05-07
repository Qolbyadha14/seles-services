# Requirements
- Php ^7.3|^8.0
- ext php_mongodb [https://github.com/mongodb/mongo-php-driver/releases]
- Php Storm or Visual Studio Code (optional)
- Mongodb 4.2

# How to Run the Project
- Clone this repository to your local machine.
- Open the project in Php Storm or Visual Studio Code.
- make sure the php_mongodb ext is installed on your local server
- run ```composer install.```
- run ```cp .env.example .env```
- run ```php artisan key:generate```
- run ```php artisan jwt:secret```
- Setup env db
- php artisan serve
- for testing api, download [Documentation](https://api.postman.com/collections/24412650-14c28050-add0-44fc-aa71-a332ca6063b1?access_key=PMAT-01GZVKK4NBC318T56WXSJPY5WM) collection . 
