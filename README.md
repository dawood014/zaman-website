# Zaman Build Tech & Real Estate — Laravel CMS

Converted from the finalized static HTML website into a Laravel 11 application with Blade templates, database-backed content management, admin authentication, file uploads, inquiries/bookings, public project/property/news detail pages, filters, and reusable layouts.

## Local setup

1. Install PHP 8.2+, Composer, MySQL/MariaDB.
2. Copy `.env.example` to `.env`.
3. Create a database named `zaman_build_tech` (or update `.env`).
4. Run:

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Website: http://127.0.0.1:8000
Admin: http://127.0.0.1:8000/admin/login

Default admin login:
- Email: `admin@zamanbuildtech.com`
- Password: `Admin@123`

**Change the default password immediately after first local setup / before deployment.**

## CMS modules
Hero/video slider, home sections, services, why choose us, construction process, projects, properties, gallery, before/after, testimonials, team, achievements, partners/certifications, news, FAQs, consultation CTA, social links, inquiries/bookings, and contact/settings.

## Uploads
Images uploaded from admin are stored in `storage/app/public/cms/...`; run `php artisan storage:link` once.

## Mail / WhatsApp
The current contact/property forms save enquiries in the database. Configure Laravel mail or a WhatsApp API later if you want automatic server-side notifications. The `.env.example` defaults to Laravel's `log` mailer for safe local development.
