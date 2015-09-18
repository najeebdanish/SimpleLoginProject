## Simple Login Project

## Pre-requisite
	[Apache_2.4](http://httpd.apache.org/download.cgi)
	[MariaDB_10.0.20](https://downloads.mariadb.org/mariadb/10.0.20/)
	[PHP_5.6](http://php.net/downloads.php)
	[Laravel_5.1](http://laravel.com/docs/5.1#installation)
	[Behat](http://docs.behat.org/en/v2.5/quick_intro.html#installation)
	[SeleniumHQ](http://www.seleniumhq.org/download/)

## Project Download
Download the project from the following location and place it under "${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject"
	https://github.com/najeebdanish/SimpleLoginProject

## Instructions
Add the following line in ${WINDOWS_HOME}\System32\drivers\etc\hosts
	127.0.0.1       simplelogin.dev
Go your ${APACHE_INSTALL_DIR}\conf\extra
Open httpd-vhosts.conf and put the following lines at the end
	<VirtualHost *:80>
    DocumentRoot "${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject\public"
    ServerName simplelogin.dev
	</VirtualHost>
Run the selenium jar file you download from the link above "selenium-server-standalone-2.47.1.jar"
Open command prompt and type the following command to start MySql
	mysqld -console
Open another command prompt and run the following command to change the root password
	mysql -u root
	use mysql;
	update user set password=PASSWORD("strong") where User='root';
Once MySql is up then connect through HeidiSQL or SQLYog and run the followin DDL (.sql) file. This will create the users table and two users
	${APACHE_INSTALL_DIR}/htdocs/SimpleLoginProject/test_data_dump.sql
Open another command prompt and go to your ${APACHE_INSTALL_DIR}/bin then run the following commands
	httpd.exe -k install
	httpd.exe -k start

Here are the credentials of the two users already in the database
	User	:	admin@testsite.com		Password	:	testadmin		(This is an administrator user)
	User	:	testuser@fake.com		PASSWORD	:	testuser		(This is a regular/nonAdmin user)

Open any browser and go to http://simplelogin.dev:81
It will take you to the login page

Admin login
	After login you will be redirected to the main dashboard "http://simplelogin.dev:81/home"
	To log out just hit the "Logout" button
	If you try to hit the same home URL again "http://simplelogin.dev:81" in the same session then it will always take you to main dashboard since you are already logged in
	Similarly if you are not logged in and you try to access "http://simplelogin.dev:81/home" then it will redirect to the login page to login first
	Only admin user can register new users so if you paste the following link in the browser then you will see another button "Register New User"
	If you click "Register New User", it will redirect you to the registration page. Enter a new user information and hit "Register"
	
Open command prompt and go to "${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject" then run the following command to test. It runs the features defined under ${APACHE_INSTALL_DIR}\htdocs\SimpleLoginProject\features\authentication.feature
	bin\behat
