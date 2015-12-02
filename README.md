# WikiRoulette

Wiki Randomness!

This is an experiment in accessing the Wikipedia [WikiMedia API](https://www.mediawiki.org/wiki/API:Main_page) via PHP.
It loads a small amount of data about a few random Wikipedia pages, and displays it to the user.

## Setup

### For Development
**Requirements**
* [Vagrant](https://www.vagrantup.com/)
* [Oracle VM Virtualbox](https://www.virtualbox.org/)
* [PHP](http://www.php.net/) (make sure php_openssl is also installed or composer cannot be installed)
* [SSH](http://www.openssh.com/)


**Setup Guide**

1. Clone this repository into a new directory
2. Install [Composer](https://getcomposer.org/) into the new directory
3. Run `composer install` to download the Laravel Homestead dependency
4. If you don't have a personal SSH key set up, generate one with SSH
5. Run `vagrant up` (the first time may take a while as it downloads the virtual machine image)
6. After it finishes, SSH into the server `ssh vagrant@127.0.0.1:2222` (password: `vagrant`) and continue from step 2 of the For Production setup guide
7. The web page should now be accessable from http://localhost:8000

### For Production
**Requirements**
* A webserver: [Apache](https://httpd.apache.org/) or [nginx](http://nginx.org/)
* [PHP](http://www.php.net/) >= 5.5.9 w/PDO extension installed
* A SQL database: [MySQL](https://www.mysql.com/), SQLite, Postgres, etc.

**Setup Guide**

1. Clone this repository into a new directory
2. cd into the new directory and run the following steps:
  * `cd wikiroulette/site`
  * `cp .env.example .env`
  * `php artisan key:generate`
  * Set up your local database configuration in the file `.env`.  You should also set `APP_DEBUG=false` if this were a real production environment
  * `php artisan migrate` to set up the database table
3. (Production setup only) Set up your web server to server files from the `wikiroulette/site/public` directory
4. The web page should now be accessable from the browser

