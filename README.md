# Product Search API
![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?logo=mysql)
![REST](https://img.shields.io/badge/API-REST-lightgrey)
![Docker](https://img.shields.io/badge/Docker-Container-blue?logo=docker)
![OpenAPI](https://img.shields.io/badge/OpenAPI-3.0-green?logo=swagger)

## Description
REST API for product search with filtering, sorting and pagination.  
Test task implementation built with Laravel, MySQL and Docker.

---

## Features
- Search products by name
- Filtering by:
    - price range
    - category
    - stock availability
    - minimum rating
- Sorting:
    - price ascending / descending
    - rating descending
    - newest
- Pagination
- OpenAPI (Swagger) documentation
- Feature tests
- Dockerized environment

---

## Tech Stack
- PHP 8.2
- Laravel 12.x
- MySQL
- Docker / docker-compose
- OpenAPI 3 (Swagger UI)

---

## API Endpoint

### `GET /api/products`

#### Query parameters
| Parameter     | Type     | Description                                        |
|---------------|----------|----------------------------------------------------|
| `q`           | string   | Search by product name                             |
| `price_from`  | number   | Minimum product price                              |
| `price_to`    | number   | Maximum product price                              |
| `category_id` | integer  | Filter by category                                 |
| `in_stock`    | boolean  | Only products in stock                             |
| `rating_from` | number   | Minimum product rating                             |
| `sort`        | string   | `price_asc`, `price_desc`, `rating_desc`, `newest` |
| `page`        | integer  | Page number                                        |
| `per_page`    | integer  | Items per page (default: 10, max: 100)             |

---

## API Documentation

- Swagger UI: `http://localhost:8080/api/documentation`
- Raw OpenAPI JSON: `http://localhost:8080/docs?api-docs.json`

---

## Run Locally

```bash
  docker-compose up -d
```

## Application will be available at:
	• API: http://localhost:8080/api/products
	• Swagger: http://localhost:8080/api/documentation
