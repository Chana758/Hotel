# KETO Hotel 🏨

A full-stack hotel booking website built with **Laravel 10**, Jetstream and Livewire. Guests can browse rooms and the gallery, book online and contact the hotel. Admins manage rooms, bookings, gallery, messages and site settings from a dashboard.

🔗 **Live Demo:** https://hotel-2xmb.onrender.com

> ⏳ Hosted on a free plan. If the site has been idle, the first load can take about 50 seconds while the server wakes up.

![Home page](docs/home.png)

## Demo accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | `demo-admin@example.com` | `DemoAdmin@2026` |
| User | `demo-user@example.com` | `DemoUser@2026` |

## Features

**Guest / User**
- Browse rooms with photos, price and room type
- Photo gallery
- Book a room by arrival and departure date
- Register, log in and manage a profile
- Contact form

**Admin**
- Create, edit and delete rooms
- Approve or reject bookings
- Manage gallery images
- Read and reply to contact messages by email
- Edit site settings (logo, contact info, social links)

## Tech stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 10, PHP 8.3 |
| Auth | Laravel Jetstream, Livewire |
| Frontend | Blade, Vite, Tailwind CSS |
| Database | TiDB Cloud (MySQL compatible) |
| Deployment | Docker on Render |

## Deployment notes

Challenges solved while deploying:
- Migrated the MySQL dump from XAMPP to TiDB (TiDB does not support `ALTER TABLE ... MODIFY ... AUTO_INCREMENT`, so the schema was rewritten with inline `AUTO_INCREMENT` and primary keys)
- Connected to TiDB over TLS from a Docker container
- Fixed mixed content (HTTP/HTTPS) behind Render's proxy with `TrustProxies` and `URL::forceScheme('https')`
- Built Vite assets for production

## Run locally

```bash
git clone https://github.com/Chana758/Hotel.git
cd Hotel
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
# set DB_* values in .env, then:
php artisan migrate
php artisan serve
```

## Author

**Sam Channa**, Web Developer
GitHub: [@Chana758](https://github.com/Chana758)
