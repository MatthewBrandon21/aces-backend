# ACES Backend

Build with laravel 9 + MySQL Database
Custom CMS

## Demo

https://aces.umn.ac.id/backend

## API Documentation

#### Get All Posts

```
  GET /api/posts
```

#### Get All post by search

```
  GET /api/posts?search={post.title or post.body}
```

#### Get All post by category

```
  GET /api/posts?category={category.slug}
```

#### Get All post categories

```
  GET /api/categories
```

#### Get Post (detailed)

```
  GET /api/posts/{slug}
```

#### Get All ACES Open Projects

```
  GET /api/openprojects
```

#### Get All ACES Open Projects by search

```
  GET /api/openprojects?search={openproject.title or openproject.body}
```

#### Get ACES Open Project (detailed)

```
  GET /api/openprojects/{slug}
```

#### Get All ACES Labs Repository

```
  GET /api/labs
```

#### Get All ACES Labs Repository by search

```
  GET /api/labs?search={repository.title or repository.body}
```

#### Get All ACES Labs Repository by labs categories

```
  GET /api/labs?labscategory={labscategory.slug}
```

#### Get ACES Labs Repository (detailed)

```
  GET /api/labs/{slug}
```

#### Get All ACES Labs categories

```
  GET /api/labs-categories
```

#### Get All ACES Generations

```
  GET /api/generations
```

#### Get All ACES Frontliners member

```
  GET /api/frontliners
```

#### Get All ACES Frontliners member by search

```
  GET /api/frontliners?search={frontliner.name}
```

#### Get All ACES Frontliners member by generations

```
  GET /api/frontliners?generation={generation.slug}
```

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_ENV`

`APP_URL`

`ASSET_URL`

## Run Locally

Make sure have PHP >= 8.1 (Minimum for laravel 9)

Clone the project

```bash
  git clone https://github.com/MatthewBrandon21/aces-backend
```

Go to the project directory

```bash
  cd aces-backend
```

Install dependencies

```bash
  composer update
  composer install
```

Configure database setting in .env

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=acesdatabase
  DB_USERNAME=root
  DB_PASSWORD=
```

Seed database

```bash
  php artisan migrate:fresh --seed
```

Start the server (or you can use valet)

```bash
  php artisan serve
```

## Support

For support, email matthew.brandon@student.umn.ac.id
