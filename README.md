
# ACES Backend

Build with laravel 9 + MySQL Database

## Demo

https://aces-backend.matthewbd.my.id/


## API Documentation

#### Get All Posts

```http
  GET /api/posts
```

#### Get All post by search

```http
  GET /api/posts?search={post.title or post.body}
```

#### Get All post by category

```http
  GET /api/posts?category={category.slug}
```

#### Get All post categories

```http
  GET /api/categories
```

#### Get All ACES Open Projects

```http
  GET /api/openprojects
```

#### Get All ACES Open Projects by search

```http
  GET /api/openprojects?search={openproject.title or openproject.body}
```

#### Get All ACES Labs Repository

```http
  GET /api/repositorylabs
```

#### Get All ACES Labs Repository by search

```http
  GET /api/repositorylabs?search={repository.title or repository.body}
```

#### Get All ACES Labs Repository by labs categories

```http
  GET /api/repositorylabs?labscategory={labscategory.slug}
```

#### Get All ACES Labs categories

```http
  GET /api/labscategories
```

#### Get All ACES Generations

```http
  GET /api/generations
```

#### Get All ACES Frontliners member

```http
  GET /api/frontliners
```

#### Get All ACES Frontliners member by search

```http
  GET /api/frontliners?search={frontliner.name}
```

#### Get All ACES Frontliners member by generations

```http
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
  git clone https://link-to-project
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