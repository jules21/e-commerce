<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About E-Commerce

E-commerce is a basic shopping system. where the user be able to buy product 
after topping his account and view his purchases.

Task done in Three category

1. Admin side to add Product
2. API to serve frontend
3. client side to buy product

## Setup Project

No much required, It's Just to 
 - Clone the project repository
 ```
 git clone https://github.com/jules21/e-commerce.git
 ```
  - Switch to the project
 ```
 cd e-commerce
 ```
 - Install all the dependencies
 ```
 composer install
 ```
- Copy the example env file to .env file
```
cp .env.example .env
```
- Make the required configuration changes in the .env file
    - Set the database connection
        ```
      //replace with your database connection
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=e_commerce
        DB_USERNAME=root
        DB_PASSWORD=
        ```
    - Set Email connection
        ```
      //replace with your email configuration
        MAIL_DRIVER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        ```
- Generate application key
```
php artisan key:generate
```
 - Run the database migrations
``` 
php artisan migrate
```
- Run the database seeds
```
php artisan db:seed
```
- Run the server
```
php artisan serve
```
Default user (Admin)

    email: admin@ecommerce.com  
    password: password

- Link storage to the public folder
``` 
php artisan storage:link
```


## Resftul API documentation by Postman

 [Click me for documentation](https://documenter.getpostman.com/view/6413036/UyrGCEMF).



## Challenge Approach & Solution

The challenge was so interesting and my approach was first to understand well
the scenario first, afterward make tables and relationship.

After designing database it was foundation and gave me insight on how i will work on remaining tasks

Interface is where I would like to improve by making appealing design as real e-commerce application

## React Frontend

Below is the link to repo for client side using react.

 https://github.com/jules21/e-commerce-client  



