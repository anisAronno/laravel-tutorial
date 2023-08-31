# Laravel (10) Tutorial for my students

## Follow Class List with [Commit Hostory](https://github.com/anisAronno/laravel-tutorial/commits/master)

## Getting started

Clone project

```
git clone https://github.com/anisAronno/laravel-tutorial.git
```

Switch to the folder (Blog or any others)

```
cd blog
```

OR

```
cd introduction
```

Create env file and setup Database Connection.

```
cp .env.example .env

```

Install Dependent Composer Packages

```
composer install
```

Install Dependent Node Packages

```
npm install
```

Generate Application Key

```
php artisan key:generate
```

Build frontend for development with watch mode

```
npm run dev
```

Build frontend for Production

```
npm run build
```

Serve Application

```
php artisan serve
```

You can now access the server at http://localhost:8000

Follow [Laravel Documentation](https://laravel.com/docs/10.x/installation) For More information
