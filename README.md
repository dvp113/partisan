Build MVC php artisan (step by step)
======================================
## Project make by Phuc Nguyen (fresher Laravel)
Project help you to create Controller, Model, View automation from existing Table in Database by ONE command line (simple :)) )

## require composer
1. Laravel-datatable
- <code>$ composer require yajra/laravel-datatables-oracle:"~9.0" </code>
2. Doctrine/dbal (read property in column table)
- <code>$ composer require doctrine/dbal </code>
## 1. Create (migrate) your database (manual or migrate in laravel).
## 2. Config your database in .evn
## 3. Download folder 'templates' and move to app/resources
## 4. Move all files in templates/Commands to app/Console/Commands
## 5. Move all files in templates/Helpers to app/Helpers
## 6. Run command line 
- <code>php artisan make:crud </code> : make all table
- <code>php artisan create-mvc:controller YourControllerName yourtablename</code> :make one table

