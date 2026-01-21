# Product Search API

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
- PHP 8
- Laravel
- MySQL
- Docker / docker-compose
- Swagger (OpenAPI 3)

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
| `per_page`    | integer  | Items per page (default: 10)                       |

---

## API Documentation

Swagger UI is available at:  
`http://localhost:8080/api/documentation`

---

## Run Locally

```bash
  docker-compose up -d
```

## Application will be available at:
	• API: http://localhost:8080/api/products
	• Swagger: http://localhost:8080/api/documentation
