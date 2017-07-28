# morrislatop/phpdotenv-safe

Drop in replacement for [`vlucas/phpdotenv`](https://github.com/vlucas/phpdotenv), but ensures that all necessary environment
variables are defined after reading from .env. These needed variables are read from `.env.example`, which should be
committed along with your project.

This is heavily inspired by [dotenv-safe](https://github.com/rolodato/dotenv-safe).

[![Build Status](https://travis-ci.org/morrislaptop/phpdotenv-safe.svg)](https://travis-ci.org/morrislaptop/phpdotenv-safe)

# Installation

```
composer require morrislaptop/phpdotenv-safe
```

# Example

```dosini
# .env.example, committed to repo
SECRET=
TOKEN=
KEY=
```

```dosini
# .env, private
SECRET=topsecret
TOKEN=
```

```php
$dotenv = new DotenvSafe\DotenvSafe(__DIR__);
$dotenv->load();
```

Since the provided `.env` file does not contain all the variables defined in `.env.example`, an exception is thrown:

```
PHP Fatal error:  Uncaught Dotenv\Exception\ValidationException: One or more environment variables failed assertions: WORLD is missing.
```

Not all the variables have to be defined in `.env`, they can be supplied externally. For example, the following would work:

```
KEY=xyz php index.php
```

# Usage

R