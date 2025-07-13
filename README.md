# Subscription API (Laravel)

A RESTful subscription platform built with Laravel 12, mail queues, and scalable architecture.

## 📦 Features

- Subscribe users to multiple websites via API
- Post creation triggers email notifications to subscribers
- Uses Laravel Events, Listeners, and queued Jobs
- Efficient: handling via chunking / `lazyById` for large subscriber bases
- Unique sending check to avoid duplicates
- Mail delivery jthrough Mailtrap (or SMTP)

## 🚀 Setup & Run (Local)

1. Clone repo:
```bash
   git clone https://github.com/your-username/subscription-api.git
   cd subscription-api
```

2. Install dependencies:
```bash
   composer install
   cp .env.example .env
   php artisan key:generate
```

🧪 API Endpoints

| Endpoint                            | Method | Body                                       | Description                        |
| ----------------------------------- | ------ | ------------------------------------------ | ---------------------------------- |
| `/api/websites/{website}/subscribe` | POST   | `{ "email": "user@example.com" }`          | Subscribe user                     |
| `/api/websites/{website}/posts`     | POST   | `{ "title": "...", "description": "..." }` | Create post and notify subscribers |