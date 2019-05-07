Build MVC php artisan (step by step)
======================================
## Project make by Phuc Nguyen (fresher Laravel)
Project helper you create Controller, Model, View automation from existing table in database by ONE command line (simple :)) )

## require composer
1. Laravel-datatable
- $ composer require yajra/laravel-datatables-oracle:"~9.0"
2. Doctrine/dbal (read property in column table)
- $ composer require doctrine/dbal
## 1. Create (migrate) your database (manual or migrate in laravel).
## 2. Download folder 'templates' and move to app/resources
## 3. Move file CreateMVC.php (templates/artisan_command) to app/Console/Commands
## 4. Move file RenderTable.php (templates/artisan_command) to app/Helpers
## 5. Run command line 
- php artisan create-mvc:controller YourControllerName yourtablename

