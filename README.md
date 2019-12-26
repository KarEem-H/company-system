# Index 
### 1- The company system description
### 2- Project dependencies
### 3- Run project locally
### 4- Guidelines of endpoints
### 5- Note

# 1- The company system description
- a company with departments, each department have employee and manager, and their profiles (include only the word profile) can be accessed by API through JWT (JSON Web Tokens) .

# 2- Project dependencies
- Laravel 3.0.1
- Composer 1.9.1
- PHP 7.3.12
- MySql DB

# 3- Run project locally

**Windows users**:
- Download and and install XAMPP: https://www.apachefriends.org/download.html

- Download and install Git Bash: https://git-scm.com/
- Download and install Postman: https://www.getpostman.com/downloads/
- Download  and install Composer : https://getcomposer.org/download/



**Mac Os, Ubuntu and windows users continue here**:
- Create a database locally named `company-system` utf8_general_ci 
- Download composer https://getcomposer.org/download/
- Pull Laravel/php project from git provider.
- Rename `.env.example` file to `.env`inside your project root and fill the database information.
  (windows wont let you do it, so you have to open your console cd your project root directory and run 
  ```
  mv .env.example .env
  ```
   )
- Open the console and cd your project root directory
- Run
 ```bash
composer install
```
 or
 ```bash
php composer.phar install
```
- Run 
```bash
php artisan key:generate
``` 
- Run
```bash
php artisan migrate
```
- Run 
```bash
php artisan db:seed
```
to run seeders, if any.

- Run 
```bash
php artisan serve
```

***You can now access your project at localhost:8000 :)***

## If for some reason your project stop working do these:
- `composer install`
- `php artisan migrate`

# 4- Guidelines of endpoints

- The Api show without authentication each department with its employees and each manager with his/her employees.
```
- GET ~/api/department/{department_id}/employee

- GET ~/api/manager/{manager_id}/employee

```
- The 2 version of the API and the both be working. And a custom header (`Accept-version`) allows you to preserve your URIs between versions.

e.g.

```
Accept-version: v1

Accept-version: v2
```
which be used with routes
```
- GET ~/api/department/{department_id}/employee

- GET ~/api/manager/{manager_id}/employee

- GET ~/api/department/

- GET ~/api/manager/
``` 
# 5- Notes 
- user can be accessed by API through JWT by sending the `Authorization` attribute at HTTP message header 
- Authorization:  `Bearer`+`letter_spacing`+`insert_user_token_here`  
```
 Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ.....
```
- the second version of API can pagination for a specific list.

-  `itemsPerPage` is a URL query string parameter used at pagination process of a specific list to set number of item per the page. 


 
 e.g.
 ```
 Accept-version: v2

 - GET ~/api/department/?itemsPerPage=5&page=2

 ```

