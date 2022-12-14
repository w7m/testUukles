Uekles Test
========================

Requirements
------------

- *Docker*;
- *Make*;
- *Internet access*;

Installation
------------


### Install the project localy

If the project was cloned in path/to/directory, open a terminal and just do:

```bash
1. cd path/to/directory
2. make
```

And run this commands : 

```bash
$ make install-application

Path project : http://127.0.0.1:8085/
Path database PhpMyAdmin : http://127.0.0.1:8080/
path Question 1 : http://127.0.0.1:8085/client-by-price
path Question 2 : http://127.0.0.1:8085/add-material-client
path Question 3 : http://127.0.0.1:8085/total-sold

```

Usage
-----

There's no need to configure anything to run the application. run this command:

```bash
$ make start
```


Management
-----


You can use *make* to manage the website, with the following commands:

- `make start` start all services needed by the website (*apache*, *php-fpm*, *mysql*…) ;
- `make stop` stop all services needed by the website;
- `make help` display a tiny help about each of available commands.


Languages and tools
-----
The website was made with:

- [*PHP8.1*](http://www.php.net);
- [*Symfony 6*](https://symfony.com/doc/current/index.html);
- [*composer*](https://getcomposer.org/doc/);

Moreover, in the developmment environment, these tools are used:

- [*docker*](https://docs.docker.com);
- [*docker-compose*](https://docs.docker.com/compose/);
- [*make*](https://www.gnu.org/software/make/manual/make.html).

Database
--------
This project uses doctrine as ORM and the DoctrineMigrationsBundle bundle to manage the database
You must follow [Doctrine migrations bundle][2] and [Databases and the Doctrine ORM][3]

Symfony
-------

You must follow [Symfony's best practices][1].  
Moreover, all code must go in `src` directory. 

[1]: http://symfony.com/doc/current/best_practices/index.html
[2]: https://symfony.com/bundles/DoctrineMigrationsBundle/current/index.html#usage
[3]: https://symfony.com/doc/current/doctrine.html