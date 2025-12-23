# Quick Start Guide

## Prerequisites
- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Node.js (optional, for asset compilation)

## Installation Steps

### 1. Database Setup
```bash
# Start MySQL server (if not running)
# Then create the database
mysql -u root -p
```

```sql
CREATE DATABASE alibus;
EXIT;
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Run Migrations
```bash
php artisan migrate
```

### 4. Start the Server
```bash
php artisan serve
```

### 5. Access the Application
Open your browser and navigate to:
- **Driver Portal**: http://localhost:8000/driver/login
- **Admin Portal**: http://localhost:8000/admin/login

## First Time Setup

### Create an Admin Account
1. Go to http://localhost:8000/admin/register
2. Enter username and password
3. Click Register

### Create a Route
1. Login as admin
2. Click "Create Route" in navigation
3. Fill in:
   - Route ID (e.g., "R001")
   - Route From (e.g., "Downtown")
   - Route To (e.g., "University")
   - Time (e.g., "08:00 AM")
4. Click Submit

### Assign a Bus
1. From admin dashboard, click "Assign Bus"
2. Fill in:
   - Bus ID (must be >= 101)
   - Route ID (e.g., "R001")
   - Passenger Capacity (e.g., 50)
3. Click Submit

### Create a Driver Account
1. Go to http://localhost:8000/driver/register
2. Fill in all required fields
3. Click Register

### Assign Driver to Bus
You'll need to manually update the database for now:
```sql
UPDATE users SET busID = 101 WHERE id = 1;
```

Or use tinker:
```bash
php artisan tinker
```
```php
$user = App\Models\User::find(1);
$user->busID = 101;
$user->save();
```

## Common Tasks

### View All Routes
```bash
php artisan tinker
```
```php
App\Models\Route::all();
```

### View All Buses
```bash
php artisan tinker
```
```php
App\Models\Bus::all();
```

### Reset Database
```bash
php artisan migrate:fresh
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Troubleshooting

### "Target class does not exist"
```bash
php artisan clear-compiled
composer dump-autoload
```

### "No application encryption key"
```bash
php artisan key:generate
```

### Database Connection Error
Check your `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alibus
DB_USERNAME=root
DB_PASSWORD=
```

### Port Already in Use
```bash
php artisan serve --port=8001
```

## Default Credentials (After Setup)

You'll need to create these yourself:

**Admin:**
- Username: (your choice)
- Password: (your choice)

**Driver:**
- Username: (your choice)
- Password: (your choice)

## File Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/
│   │   │   ├── AdminAuthController.php
│   │   │   └── DriverAuthController.php
│   │   ├── AdminController.php
│   │   ├── BusController.php
│   │   ├── DriverController.php
│   │   └── RouteController.php
│   └── Models/
│       ├── Admin.php
│       ├── Bus.php
│       ├── Route.php
│       └── User.php
├── database/
│   └── migrations/
├── public/
│   └── images/
├── resources/
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── driver/
│       └── layouts/
├── routes/
│   └── web.php
└── .env
```

## Next Steps

1. ✅ Create admin account
2. ✅ Create routes
3. ✅ Assign buses to routes
4. ✅ Create driver accounts
5. ✅ Assign drivers to buses
6. ✅ Test passenger reporting
7. ✅ Test driver search
8. ✅ Test admin dashboard

## Need Help?

- Check `LARAVEL_MIGRATION_GUIDE.md` for detailed documentation
- Check `CONVERSION_SUMMARY.md` for conversion details
- Visit Laravel documentation: https://laravel.com/docs
