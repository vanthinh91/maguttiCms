![maguttiCms](http://www.magutti.com/public/website/images/logo_colore.png)


## About maguttiCms
Open source multilingual Laravel 8.x CMS with simple shopping cart.

## Version
Laravel 8.x

maguttiCms is released using Laravel 8x.

### How to Install
 
 - copy files in your local directory
 - rename env.example to .env file and set your db connection data
 - run composer install
 - run php artisan key:generate
 - create db tables importing framework_base.sql file located under the db folder
 - to login in the admin panel (http://yourpath/admin)
 - email: cmsadmin@magutti.com
 - password: password
 - for shared hosting you can set ASSET_PUBLIC_PATH in .env  file (eg ASSET_PUBLIC_PATH='public/')
   
   
### Server Requirements
 
 - PHP >= 7.3
 - BCMath PHP Extension
 - Ctype PHP Extension
 - Fileinfo PHP extension
 - JSON PHP Extension
 - Mbstring PHP Extension
 - OpenSSL PHP Extension
 - PDO PHP Extension
 - Tokenizer PHP Extension
 - XML PHP Extension


# Commands
## magutticms:create-model
helper to create a model and the related admin form configuration fields from given db table 

License
=======
Code released under the MIT license

Security Vulnerabilities
=======
If you discover a security vulnerability within maguttiCms, please send an e-mail to  at hello@magutti.com. All security vulnerabilities will be promptly addressed.

