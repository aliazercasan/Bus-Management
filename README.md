# UniRide - Bus Management System (Laravel)

A modern Laravel-based bus management system converted from a legacy PHP application. This system manages drivers, buses, routes, and passenger tracking for a university transportation service.

## 🚀 Features

### Driver Portal
- Driver registration and authentication
- Dashboard with bus assignments and schedules
- Passenger count reporting
- Driver search functionality
- Route details viewing

### Admin Portal
- Admin authentication
- Driver management (view, delete)
- Bus assignment to routes
- Route creation and management
- Comprehensive dashboard

## 📋 Requirements

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Laravel 12.x

## 🔧 Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd BusManagementLaravel
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alibus
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Create Database
```sql
CREATE DATABASE alibus;
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Start Development Server
```bash
php artisan serve
```

Visit:
- Driver Portal: http://localhost:8000/driver/login
- Admin Portal: http://localhost:8000/admin/login

## 📚 Documentation

- **[Quick Start Guide](QUICK_START.md)** - Get up and running in 5 minutes
- **[Migration Guide](LARAVEL_MIGRATION_GUIDE.md)** - Detailed conversion documentation
- **[Code Comparison](CODE_COMPARISON.md)** - Original PHP vs Laravel comparison
- **[Conversion Summary](CONVERSION_SUMMARY.md)** - What was converted and how
- **[Testing Checklist](TESTING_CHECKLIST.md)** - Complete testing guide

## 🗂️ Project Structure

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
│       ├── create_routes_table.php
│       ├── create_buses_table.php
│       ├── add_bus_fields_to_users_table.php
│       └── create_admins_table.php
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── bus-create.blade.php
│       │   └── route-create.blade.php
│       ├── auth/
│       │   ├── driver-login.blade.php
│       │   ├── driver-register.blade.php
│       │   ├── admin-login.blade.php
│       │   └── admin-register.blade.php
│       ├── driver/
│       │   ├── dashboard.blade.php
│       │   ├── report.blade.php
│       │   ├── search.blade.php
│       │   └── details.blade.php
│       └── layouts/
│           ├── app.blade.php
│           ├── driver-header.blade.php
│           └── admin-header.blade.php
└── routes/
    └── web.php
```

## 🔐 Security Features

- ✅ CSRF protection on all forms
- ✅ Password hashing with bcrypt
- ✅ SQL injection prevention via Eloquent ORM
- ✅ XSS protection via Blade templating
- ✅ Authentication middleware
- ✅ Separate admin and driver guards

## 🗄️ Database Schema

### Users (Drivers)
- Personal information (name, age, contact, address)
- Authentication credentials
- Bus assignment (foreign key)

### Admins
- Username and password
- Separate authentication system

### Buses
- Bus ID (primary key, starts at 101)
- Route assignment (foreign key)
- Passenger capacity and current count
- Route time/date

### Routes
- Route ID (primary key)
- Origin and destination
- Scheduled time

## 🎯 Usage

### For Administrators

1. **Register Admin Account**
   - Navigate to `/admin/register`
   - Create admin credentials

2. **Create Routes**
   - Login to admin portal
   - Click "Create Route"
   - Enter route details (ID, from, to, time)

3. **Assign Buses**
   - Click "Assign Bus"
   - Enter bus ID (≥ 101), route ID, capacity

4. **Manage Drivers**
   - View all drivers in dashboard
   - Delete unavailable drivers

### For Drivers

1. **Register Driver Account**
   - Navigate to `/driver/register`
   - Fill in personal information

2. **View Dashboard**
   - See assigned bus and route
   - View schedule information

3. **Report Passengers**
   - Click "Report Route"
   - Enter bus ID and passenger count
   - System validates against capacity

4. **Search Drivers**
   - Use search function to find other drivers
   - View their assignments

## 🧪 Testing

Run the complete test suite:
```bash
php artisan test
```

Manual testing checklist available in [TESTING_CHECKLIST.md](TESTING_CHECKLIST.md)

## 🔄 Migration from Original PHP

This Laravel application is a complete rewrite of the original PHP bus management system. Key improvements:

- **50% less code** - More maintainable and readable
- **Better security** - Built-in protections against common vulnerabilities
- **Modern architecture** - MVC pattern with clear separation of concerns
- **Database relationships** - Eloquent ORM with defined relationships
- **Validation** - Automatic form validation with error messages
- **Routing** - Centralized, named routes
- **Authentication** - Built-in authentication system with guards

See [CODE_COMPARISON.md](CODE_COMPARISON.md) for detailed comparison.

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Check MySQL is running
# Verify credentials in .env
# Ensure database exists
mysql -u root -p -e "CREATE DATABASE alibus;"
```

### Migration Errors
```bash
# Reset database
php artisan migrate:fresh

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Authentication Issues
```bash
# Clear compiled files
php artisan clear-compiled
composer dump-autoload
```

## 📝 License

This project is open-source and available under the MIT License.

## 👥 Contributors

Converted from original PHP application to Laravel framework.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## 📧 Support

For issues and questions:
- Check the documentation files
- Review Laravel documentation: https://laravel.com/docs
- Check error logs: `storage/logs/laravel.log`

## 🎓 Credits

Original PHP application: 2nd-year-Project-Bus-Management
Laravel conversion: 2024

---

**Built with Laravel** | **Powered by PHP** | **Database: MySQL**
