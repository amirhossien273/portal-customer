# Sepand customer portal

The customer portal authenticates CRM customers by mobile number and OTP, then exposes their inquiries, customer-visible shipment tracking, invoices, receipts, and profile data.

## Portal and CRM database configuration

The application uses two independent database connections:

- `DB_*` is the database owned by `portal-customer`. Laravel migrations, consultation requests and any future portal-owned data are written here.
- `CRM_DB_*` is the named `crm` connection used by every model under `App\Models\Crm`. Customer identity, inquiries, shipments, customer-visible tracking events, invoices and receipts are read from `sepand-crm` through this connection.

The two databases may be hosted on the same MySQL server, but `DB_DATABASE` and `CRM_DB_DATABASE` must be different. Use a read-only CRM user with access only to the tables required by the portal.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sepand_portal
DB_USERNAME=sepand_portal
DB_PASSWORD=...

CUSTOMER_PORTAL_DB_CONNECTION=crm
CRM_DB_CONNECTION=mysql
CRM_DB_HOST=127.0.0.1
CRM_DB_PORT=3306
CRM_DB_DATABASE=sepand_crm
CRM_DB_USERNAME=sepand_portal_readonly
CRM_DB_PASSWORD=...
CUSTOMER_PORTAL_TENANT_ID=00000000-0000-0000-0000-000000000001
```

Run migrations only against the portal's default database, then verify both connections:

```bash
php artisan migrate
php artisan portal:check-databases
```

`portal:check-databases` rejects a configuration where both connections resolve to the same database and checks the required tables on both sides. The portal never runs migrations against the CRM connection.

OTP codes are temporarily displayed on the verification screen as requested for the first release. After connecting an SMS provider, deliver the generated code in `CustomerPortalAuthController::issueOtp()` and disable the preview:

```dotenv
CUSTOMER_PORTAL_PREVIEW_OTP=false
CUSTOMER_PORTAL_OTP_EXPIRES=120
CUSTOMER_PORTAL_OTP_RESEND_AFTER=45
```

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
