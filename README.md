# Devicechi

DeviceChi is a modern and user-friendly marketplace app where people can buy and sell devices from each other. Whether
it's smartphones, laptops, or other electronic gadgets, DeviceChi provides a seamless platform for users to connect,
transact, and exchange devices securely.

[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/mdhesari/devicechi.svg)](https://github.com/mdhesari/devicechi/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/mdhesari/devicechi.svg)](https://github.com/mdhesari/devicechi/network)
[![GitHub issues](https://img.shields.io/github/issues/mdhesari/devicechi.svg)](https://github.com/mdhesari/devicechi/issues)

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Introduction

Devicechi is a web application built with Laravel, Vue.js, and PostgreSQL. It provides a platform for users to buy and
sell mobile phones easily. The application allows users to browse through listings, add items to their cart, and
complete transactions securely.

## Features

- User registration and authentication
- Mobile phone listings with detailed information and images
- Secure payment processing
- User reviews and ratings
- Search and filtering options
- User profiles and order history

## Requirements

To run Devicechi, ensure that your system meets the following requirements:

- PHP version 8.0
- Composer
- Node.js and NPM
- PostgreSQL 13

## Installation

To install Devicechi locally, follow these steps:

1.Clone the repository:

```shell
git clone https://github.com/mdhesari/devicechi.git
cd devicechi
```

2.Install PHP dependencies:

```shell
composer install
```

3.Install JavaScript dependencies:

```shell
npm install
npm run production
```

4.Configure the environment variables:

```shell
cp .env.example .env
```

5.Generate an application key:

```shell
php artisan key:generate
```

6.Create a PostgreSQL/Mysql database for DeviceChi.

7.Update the database configuration in the .env file:

```markdown
DB_CONNECTION=pgsql DB_HOST=your-database-host DB_PORT=your-database-port DB_DATABASE=your-database-name
DB_USERNAME=your-database-username DB_PASSWORD=your-database-password
```

8.Run database migrations and seed the database:

```shell
php artisan migrate --seed
```

## Configuration

Additional configuration steps, if any, can be listed here. For example, configuring payment gateways, setting up
external services, or modifying environment variables.

## Contributing

We welcome contributions to Devicechi. To contribute, please follow these guidelines:

* Fork the repository and create a new branch for your feature or bug fix.
* Ensure that your code follows the project's coding standards.
* Write tests for your code, if applicable.
* Submit a pull request describing your changes and referencing any related issues.

For bug reports or feature requests, please open an issue on the GitHub repository.

## License

Devicechi is open source and released under the MIT License. You are free to use, modify, and distribute this software.

