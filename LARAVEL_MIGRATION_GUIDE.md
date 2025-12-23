# Bus Management System - Laravel Migration Guide

## Overview
This Laravel application is a complete conversion of the original PHP bus management system. It includes:
- Driver authentication and management
- Admin authentication and management
- Bus assignment and tracking
- Route management
- Passenger reporting

## Database Setup

### 1. Start MySQL Server
Make sure your MySQL server is running on `localhost:3306`

### 2. Create Database
```sql
CREATE DATABASE alibus;
```

### 3. Run Migrations
```bash
php artisan migrate
```

This will create the following tables:
- `users` - Driver accounts with bus assignments
- `admins` - Admin accounts
- `buses` - Bus information with routes and capacity
- `routes` - Route details (from/to locations and time)

## Application Structure

### Models
- **User** (`app/Models/User.php`) - Driver model with bus relationship
- **Admin** (`app/Models/Admin.php`) - Admin authentication model
- **Bus** (`app/Models/Bus.php`) - Bus model with route and user relationships
- **Route** (`app/Models/Route.php`) - Route model with bus relationships

### Controllers
- **DriverAuthController** - Driver login/register/logout
- **AdminAuthController** - Admin login/register/logout
- **DriverController** - Driver dashboard, search, and reporting
- **AdminController** - Admin dashboard and driver management
- **BusController** - Bus creation and assignment
- **RouteController** - Route creation and management

### Routes
All routes are defined in `routes/web.php`:

#### Driver Routes (prefix: `/driver`)
- `GET /driver/login` - Login form
- `POST /driver/login` - Login action
- `GET /driver/register` - Registration form
- `POST /driver/register` - Registration action
- `GET /driver/dashboard` - Driver dashboard (protected)
- `GET /driver/search` - Search drivers (protected)
- `GET /driver/report` - Report form (protected)
- `POST /driver/report` - Submit report (protected)
- `POST /driver/logout` - Logout

#### Admin Routes (prefix: `/admin`)
- `GET /admin/login` - Login form
- `POST /admin/login` - Login action
- `GET /admin/register` - Registration form
- `POST /admin/register` - Registration action
- `GET /admin/dashboard` - Admin dashboard (protected)
- `POST /admin/driver/delete` - Delete driver (protected)
- `GET /admin/bus/create` - Bus creation form (protected)
- `POST /admin/bus/store` - Store bus (protected)
- `GET /admin/route/create` - Route creation form (protected)
- `POST /admin/route/store` - Store route (protected)
- `POST /admin/logout` - Logout

## Running the Application

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Generate Application Key (if needed)
```bash
php artisan key:generate
```

### 3. Run Migrations
```bash
php artisan migrate
```

### 4. Start Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### 5. Access the Application
- Driver Login: `http://localhost:8000/driver/login`
- Admin Login: `http://localhost:8000/admin/login`

## Key Features Converted

### From Original PHP to Laravel

1. **Authentication**
   - Original: Manual session handling with `session_start()`
   - Laravel: Built-in authentication with guards for drivers and admins

2. **Database**
   - Original: MySQLi with prepared statements
   - Laravel: Eloquent ORM with relationships

3. **Routing**
   - Original: Individual PHP files for each page
   - Laravel: Centralized routing in `routes/web.php`

4. **Views**
   - Original: Inline HTML with PHP
   - Laravel: Blade templates with layouts and components

5. **Security**
   - Original: Manual password hashing with `password_hash()`
   - Laravel: Built-in password hashing and CSRF protection

6. **Validation**
   - Original: Manual validation with if statements
   - Laravel: Form request validation

## Database Schema

### users table
- id (primary key)
- name
- firstname
- lastname
- age
- contactNumber
- address
- email (unique)
- username (unique)
- password (hashed)
- busID (foreign key to buses)
- timestamps

### admins table
- id (primary key)
- username (unique)
- password (hashed)
- timestamps

### buses table
- busID (primary key)
- route (foreign key to routes)
- passengerCapacity
- passengerTotal (default: 0)
- routeTimeDate
- timestamps

### routes table
- routeID (primary key, string)
- routeFrom
- routeTo
- oras (time)
- timestamps

## Configuration

### Authentication Guards
The application uses two authentication guards:
- `web` - For drivers (default)
- `admin` - For administrators

These are configured in `config/auth.php`

### Environment Variables
Key variables in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alibus
DB_USERNAME=root
DB_PASSWORD=
```

## Testing

### Create Test Admin
```bash
php artisan tinker
```
```php
App\Models\Admin::create([
    'username' => 'admin',
    'password' => bcrypt('password')
]);
```

### Create Test Driver
```bash
php artisan tinker
```
```php
App\Models\User::create([
    'name' => 'John Doe',
    'firstname' => 'John',
    'lastname' => 'Doe',
    'age' => 30,
    'contactNumber' => '1234567890',
    'address' => '123 Main St',
    'email' => 'john@example.com',
    'username' => 'johndoe',
    'password' => bcrypt('password')
]);
```

## Differences from Original

1. **Username field**: Added to users table (was only in original database)
2. **Name field**: Required by Laravel's default User model
3. **Middleware**: Laravel's built-in authentication middleware replaces manual session checks
4. **CSRF Protection**: All forms now include `@csrf` token
5. **Password Hashing**: Automatic with Laravel's `Hash` facade
6. **Relationships**: Eloquent relationships replace manual JOIN queries

## Next Steps

1. Start MySQL server
2. Run migrations: `php artisan migrate`
3. Create admin account
4. Create test driver account
5. Create routes
6. Assign buses to routes
7. Assign drivers to buses
8. Test the application

## Troubleshooting

### Database Connection Error
- Ensure MySQL is running
- Check database credentials in `.env`
- Verify database exists: `CREATE DATABASE alibus;`

### Migration Errors
- Drop all tables and re-run: `php artisan migrate:fresh`
- Check foreign key constraints order

### Authentication Issues
- Clear cache: `php artisan cache:clear`
- Clear config: `php artisan config:clear`
- Regenerate key: `php artisan key:generate`

## Additional Notes

- All images from the original project are copied to `public/images/`
- The styling is preserved from the original inline CSS
- Session handling is managed by Laravel
- Form validation provides better error messages
- The application follows Laravel best practices and conventions
