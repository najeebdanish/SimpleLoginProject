# Simple Login Project

## Pre-requisite

Please setup the following before running/testing this project.

1. [Apache 2.4](http://httpd.apache.org/download.cgi)
2. [MariaDB 10.0.20](https://downloads.mariadb.org/mariadb/10.0.20/)
3. [PHP 5.6](http://php.net/downloads.php)
4. [Laravel 5.1](http://laravel.com/docs/5.1#installation)
5. [Behat](http://docs.behat.org/en/v2.5/quick_intro.html#installation)
6. [SeleniumHQ](http://www.seleniumhq.org/download/)

## Project Download
Download the project from the following location 
	https://github.com/najeebdanish/SimpleLoginProject
and place it under "${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject"
	

## Instructions

### Configurations
1. Add the following line in ${WINDOWS_HOME}\System32\drivers\etc\hosts
	127.0.0.1       simplelogin.dev

2. Go your ${APACHE_INSTALL_DIR}\conf\extra

3. Open httpd-vhosts.conf and put the following lines at the end
	<VirtualHost *:80>
    DocumentRoot "${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject\public"
    ServerName simplelogin.dev
	</VirtualHost>

4. Run the selenium jar file you download from the link above "selenium-server-standalone-2.47.1.jar"

5. Open command prompt and type the following command to start MySql
	mysqld -console

6. Open another command prompt and run the following command to change the root password
	mysql -u root
	use mysql;
	update user set password=PASSWORD("strong") where User='root';

7. Once MySql is up then connect through HeidiSQL or SQLYog and run the followin DDL (.sql) file. This will create the users table and two users
	${APACHE_INSTALL_DIR}/htdocs/SimpleLoginProject/test_data_dump.sql

8. Open another command prompt and go to your ${APACHE_INSTALL_DIR}/bin then run the following commands
	httpd.exe -k install
	httpd.exe -k start

9. Here are the credentials of the two users already in the database
	User	:	admin@testsite.com		Password	:	testadmin		(This is an administrator user)
	User	:	testuser@fake.com		PASSWORD	:	testuser		(This is a regular/nonAdmin user)

	
### How to run and test

1. Open any browser and go to "http://simplelogin.dev:81". It will take you to the login page

2. Login using one of the users as mentioned above

3. After login you will be redirected to the main dashboard "http://simplelogin.dev:81/home"

4. To log out just hit the "Logout" button

5. If you try to hit the same home URL again "http://simplelogin.dev:81" in the same session then it will always take you to main dashboard since you are already logged in

6. Similarly if you are not logged in and you try to access "http://simplelogin.dev:81/home" then it will redirect to the login page to login first

7. Only admin user can register new users so if you paste the following link in the browser then you will see another button "Register New User"

8. If you click "Register New User", it will redirect you to the registration page. Enter a new user information and hit "Register"
	
9. Open command prompt and go to "${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject" then run the following command to test. It runs the features defined under ${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject\features\authentication.feature
	bin\behat
