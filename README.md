
## Abstract
Following points are considered in development:
- Only "year" as input doesn't allow me to write many unit tests for it
- So, I decided to question the validity of the employee data in storage
- Because if I trust it, one wrong employee data can break my application
- That is why, I made an Employee class so that Employee object can be my source of truth all over the application and all unit tests can revolve around it


****************************************
## Necessary Dependencies (With Windows Machine or VM)
****************************************

- PHP 8.x.x or 7.4.x
- Composer 2.x.x

### Execute following commands (Tested & confirmed with Windows 11)
```
cd employee_vacation_days
composer install
php artisan test
php artisan vacation:determine
```

****************************************
## Necessary Dependencies (With Docker)
****************************************

- Docker Desktop

### Execute following commands (Tested & confirmed with Docker Desktop 4.3.2)
```
cd employee_vacation_days
docker-compose up
docker-compose run --rm artisan test
docker-compose run --rm artisan vacation:determine
```

****************************************
## Necessary Dependencies (With Linux Machine or VM)
****************************************

- PHP 8.x.x or 7.4.x
- Composer 2.x.x

### Execute following commands  (Tested & confirmed with Cent OS 8)
```
sudo su
cd employee_vacation_days
composer install
php artisan test
php artisan vacation:determine
```
