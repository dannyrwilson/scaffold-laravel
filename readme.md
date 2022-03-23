<p align="center" style="background-color: #FFF; padding: 20px;"><img src="https://scaffold.digital/wp-content/themes/scaffold/assets/img/samples/logo.svg" alt="Scaffold"></p>

## The Challenge

This repository contains a fairly standard installation of Laravel 5.7 with some minor customisation to suit the test. We have included database migrations and seed data for some product categories, sub-categories and products. This data will automatically be imported at the end of the 'Getting Started' process.

Using the sample data provided we would like you to produce an interface that shows users all of the available top-level categories with an ability to descend through each of the sub-categories. Products could be displayed at any level (including the top level) along with other potential sub-categories.

The following tasks **MUST** be completed:

* Views created to display each category
* User's should be able to navigate to sub-categories of each category
* Products for each category/sub-category must be visible with the ability to view more detail
* An individual product view should show all available information about the current product

The following optional tasks **COULD** be completed:

* A free text search for products
* Pagination of any product pages with over 5 results
* An option to sort products by name, price etc either ascending / descending

**NOTE:** While the primary focus here is to approach the problem pragmatically it would be beneficial to use as many aspects of the framework as possible.

## Getting Started

While it's possible to run this installation in many different environments, a `docker-compose` configuration has been provided that should provide a fairly painless setup process for both Mac OS X & Linux.

### Docker Setup

* Install Docker (see https://docs.docker.com/install/)
  * [for Mac](https://docs.docker.com/docker-for-mac/install/)
  * [for Linux](https://docs.docker.com/install/)
* Open Terminal
* Navigate to project root directory
* The following commands will set up your environment, start the Docker containers and access the CLI of the web container
  ```bash
  cp .env.example .env
  docker-compose up
  docker/tools/shell.sh
  ```
* Once you're at the command prompt of the container, the following commands will install any required composer modules, set up database tables and seed the database with sample data
  ```bash
  composer install
  artisan install
  ```

* The application should now be available at http://127.0.0.1/

### Manual Setup

If you'd prefer to set this repository up manually you may do so however you'll need a separate installation of MySQL 5.7 and a suitable web server to host the application.

Next you'll need to create a copy of the `.env.example` file (named `.env`).

```bash
cp .env.example .env
```

You can configure the database connection details in the `.env` file.

Finally, install any required Composer modules (you'll need to [Install Composer](https://getcomposer.org/doc/00-intro.md) if you haven't already) and use Laravel's CLI tool (Artisan) to install anything else the application requires.

```bash
composer install
php artisan install
```
