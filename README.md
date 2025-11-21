# 📦 LiteAPI — Lightweight PHP REST API Micro-Framework

LiteAPI is a clean and minimal **PHP REST API micro-framework** built from scratch using modern PHP 8 practices.  
It is designed to be simple, fast, and perfect for learning backend architecture or powering small API services.

This project demonstrates routing, middleware, JSON responses, API key authentication, and clean PSR-4 structure — ideal for portfolios.

---

## 🚀 Features

- ⚡ Ultra-light routing system  
- 🔐 API Key Authentication (middleware)  
- 📄 JSON-only responses  
- 📥 Smart Request handler (headers, query, JSON body)  
- 📤 Clean Response system  
- 🧩 Middleware pipeline  
- 🗂 Structured controllers  
- ↪️ Versioned API support (`/v1/...`)  
- 🧱 PSR-4 autoloading (Composer)  
- 🛠 Easy to extend (JWT, MySQL, caching, pagination)

---

## 📁 Folder Structure

```
liteapi/
├── app/
│   └── routes/
│       └── api.php
├── config/
│   └── app.php
├── public/
│   ├── .htaccess
│   └── index.php
├── src/
│   ├── Core/
│   ├── Http/
│   └── Middleware/
├── vendor/
└── composer.json
```

---

## 🛠 Requirements

- PHP **8.1+**  
- Composer  
- Apache / Nginx (document root → `public/`)

---

## 🔧 Installation

```bash
git clone https://github.com/harkiratbajwa/liteapi.git
cd liteapi
composer install
```

Start development server:

```bash
php -S localhost:8000 -t public
```

---

## 🔌 API Endpoints

### 📍 Public Route  
**GET /health**  
Returns API health status.

**Example Response**
```json
{
  "status": "ok",
  "time": "2025-01-01T12:00:00+00:00"
}
```

---

## 🔐 Protected Routes (API Key required)

Edit API key in:

```
config/app.php
```

```php
return [
    'api_keys' => ['demo-key-123']
];
```

### → Get all users  
`GET /v1/users?api_key=demo-key-123`

### → Get single user  
`GET /v1/users/show?id=1&api_key=demo-key-123`

### → Create user  
`POST /v1/users`  
Headers:
```
Content-Type: application/json
X-API-KEY: demo-key-123
```

Body:
```json
{
  "name": "John Doe",
  "email": "john@example.com"
}
```

---

## 🌱 Example Controller

```php
class UserController {
    public function index(Request $request): Response {
        return Response::json([
            'users' => [
                ['id' => 1,'name' => 'Alice'],
                ['id' => 2,'name' => 'Bob']
            ]
        ]);
    }
}
```

---

## 🧠 Why This Exists

LiteAPI was created to:

- Understand how frameworks like Laravel work internally  
- Demonstrate backend architecture skills  
- Build a reusable API foundation  
- Practice routing, middleware, HTTP requests, and JSON responses  
- Create a strong portfolio project

---

## 🤝 Contributing

Feel free to fork the project and submit improvements.  
Features like JWT auth, database ORM, rate limiting, or caching are welcome.

---

## 📜 License

MIT License — free to use, modify, and distribute.
