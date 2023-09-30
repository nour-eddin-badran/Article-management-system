# Article management System

## Installation Guide

* Install PHP dependencies
```cmd
composer install
```

###NOTE:

<br/>

if it throws error try

<br/>

```cmd 
 composer install --ignore-platform-reqs
 ```
 <br/>
 or remove the composer.lock

* Install node packages 
```cmd
npm install
```

 * Compile node packages
 ```cmd
 npm run dev
 ```
  
 * Migrate and seed the date 
 ```cmd
 php artisan migrate --seed
 ```
 <br/>
 
 * Create symbolic link for storage 
 ```cmd
 php artisan storage:link
 ```
  <br/>
 
 Make sure you add the configuration of mail host to receive the notifications
 ```cmd
 MAIL_MAILER=smtp
 MAIL_HOST=sandbox.smtp.mailtrap.io
 MAIL_PORT=587
 MAIL_USERNAME=
 MAIL_PASSWORD=
 MAIL_ENCRYPTION=tls
 MAIL_FROM_ADDRESS="noreply@ams.com"
 MAIL_FROM_NAME="${APP_NAME}"
 ```
 
### Note: 
There is already seeded admin 
<br/>
 email: admin@example.com
 <br/>
 password: password
 <br/>
 
 ###NOTE:
 if you want to run the tests please make sure you modify the application environment to test 
 ```env
 APP_ENV=test
 ```

Then run
```cmd
php artisan test --testsuite=Unit
```

###API
The api link is:
localhost:8000/api/v1/articles 