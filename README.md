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

3. Configure .env:
   -> DB settings
      ```bash
         DB_CONNECTION=mysql
         DB_HOST=127.0.0.1
         DB_PORT=3306
         DB_DATABASE=subscription_api
         DB_USERNAME=root
         DB_PASSWORD=
      ```
   -> QUEUE_CONNECTION=database
      ```bash
         QUEUE_CONNECTION=database

         MAIL_MAILER=smtp
         MAIL_HOST=sandbox.smtp.mailtrap.io
         MAIL_PORT=2525
         MAIL_USERNAME=your_mailtrap_username
         MAIL_PASSWORD=your_mailtrap_password
         MAIL_ENCRYPTION=null
         MAIL_FROM_ADDRESS="noreply@example.com"
      ```
   -> Mailtrap SMTP credentials

4. Run migrations:
```bash
   php artisan migrate
```

5. Seed a website record:
```bash
   php artisan tinker
   >>> App\Models\Website::create(['name'=>'Test', 'url'=>'https://example.com']);
```

6. Serve the app:
```bash
   php artisan serve
```

7. Run queue worker:
```bash
   php artisan queue:work
```

🧪 API Endpoints

| Endpoint                            | Method | Body                                       | Description                        |
| ----------------------------------- | ------ | ------------------------------------------ | ---------------------------------- |
| `/api/websites/{website}/subscribe` | POST   | `{ "email": "user@example.com" }`          | Subscribe user                     |
| `/api/websites/{website}/posts`     | POST   | `{ "title": "...", "description": "..." }` | Create post and notify subscribers |

✅ Testing
   -> Use Postman or curl as shown in examples.
   Subscribe a user:
   ```bash
      curl -X POST http://127.0.0.1:8000/api/websites/1/subscribe \
      -H "Content-Type: application/json" \
      -d '{"email": "user@example.com"}'
   ```
   Create a post and dispatch emails:
   ```bash
      curl -X POST http://127.0.0.1:8000/api/websites/1/posts \
      -H "Content-Type: application/json" \
      -d '{"title": "My First Post", "description": "Post content here"}'
   ```
   -> Emails are sent using queue job and delivered (e.g. to Mailtrap).

🛠 Architecture
   -> Form Requests for validation
   -> Service + Interface (PostServiceInterface + PostService) via DI
   -> Event: PostCreated, Listener: SendPostToSubscribers, Job: SendPostJob
   -> Mailables: PostPublished with Blade view
   -> Efficient queue by lazyById(100) chunking

💡 Feel free to extend with API docs (OpenAPI / Postman collection) or caching layers.