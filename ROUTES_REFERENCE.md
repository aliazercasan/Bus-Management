# Routes Reference

## Complete Route List

### Root Route
| Method | URI | Name | Controller | Action |
|--------|-----|------|------------|--------|
| GET | `/` | - | Closure | Redirect to driver login |

---

## Driver Routes (Prefix: `/driver`)

### Authentication Routes (Public)
| Method | URI | Name | Controller | Action |
|--------|-----|------|------------|--------|
| GET | `/driver/login` | driver.login | DriverAuthController | showLoginForm |
| POST | `/driver/login` | - | DriverAuthController | login |
| GET | `/driver/register` | driver.register | DriverAuthController | showRegisterForm |
| POST | `/driver/register` | - | DriverAuthController | register |
| POST | `/driver/logout` | driver.logout | DriverAuthController | logout |

### Protected Routes (Requires Authentication)
| Method | URI | Name | Controller | Action |
|--------|-----|------|------------|--------|
| GET | `/driver/dashboard` | driver.dashboard | DriverController | dashboard |
| GET | `/driver/search` | driver.search | DriverController | search |
| GET | `/driver/report` | driver.report | DriverController | showReportForm |
| POST | `/driver/report` | driver.report.submit | DriverController | submitReport |
| GET | `/driver/details` | driver.details | DriverController | details |

---

## Admin Routes (Prefix: `/admin`)

### Authentication Routes (Public)
| Method | URI | Name | Controller | Action |
|--------|-----|------|------------|--------|
| GET | `/admin/login` | admin.login | AdminAuthController | showLoginForm |
| POST | `/admin/login` | - | AdminAuthController | login |
| GET | `/admin/register` | admin.register | AdminAuthController | showRegisterForm |
| POST | `/admin/register` | - | AdminAuthController | register |
| POST | `/admin/logout` | admin.logout | AdminAuthController | logout |

### Protected Routes (Requires Admin Authentication)
| Method | URI | Name | Controller | Action |
|--------|-----|------|------------|--------|
| GET | `/admin/dashboard` | admin.dashboard | AdminController | dashboard |
| POST | `/admin/driver/delete` | admin.driver.delete | AdminController | deleteDriver |
| GET | `/admin/bus/create` | admin.bus.create | BusController | create |
| POST | `/admin/bus/store` | admin.bus.store | BusController | store |
| GET | `/admin/route/create` | admin.route.create | RouteController | create |
| POST | `/admin/route/store` | admin.route.store | RouteController | store |

---

## Route Details

### Driver Login
**URL:** `/driver/login`  
**Method:** GET  
**View:** `auth/driver-login.blade.php`  
**Purpose:** Display driver login form

**URL:** `/driver/login`  
**Method:** POST  
**Validation:**
- username: required, string
- password: required, string

**Success:** Redirect to driver dashboard  
**Failure:** Return with error message

---

### Driver Register
**URL:** `/driver/register`  
**Method:** GET  
**View:** `auth/driver-register.blade.php`  
**Purpose:** Display driver registration form

**URL:** `/driver/register`  
**Method:** POST  
**Validation:**
- firstname: required, string, max:255, unique
- lastname: required, string, max:255
- age: required, integer
- contactNumber: required, string
- address: required, string
- username: required, string, max:255, unique
- password: required, string, min:6
- email: required, email, unique

**Success:** Redirect to login with success message  
**Failure:** Return with validation errors

---

### Driver Dashboard
**URL:** `/driver/dashboard`  
**Method:** GET  
**Auth:** Required  
**View:** `driver/dashboard.blade.php`  
**Data:**
- users: Collection of all users with bus and route relationships

**Purpose:** Display all drivers with their bus assignments and schedules

---

### Driver Search
**URL:** `/driver/search`  
**Method:** GET  
**Auth:** Required  
**View:** `driver/search.blade.php`  
**Query Parameters:**
- search_username: string (optional)

**Data:**
- users: Collection of matching users
- searchUsername: Search query string

**Purpose:** Search for drivers by username

---

### Driver Report
**URL:** `/driver/report`  
**Method:** GET  
**Auth:** Required  
**View:** `driver/report.blade.php`  
**Purpose:** Display passenger reporting form

**URL:** `/driver/report`  
**Method:** POST  
**Auth:** Required  
**Validation:**
- busID: required, integer
- totalPassenger: required, integer

**Business Rules:**
- Bus must exist in database
- Total passengers cannot exceed bus capacity

**Success:** Display report with bus and route details  
**Failure:** Return with error message

---

### Driver Details
**URL:** `/driver/details`  
**Method:** GET  
**Auth:** Required  
**View:** `driver/details.blade.php`  
**Purpose:** Display route category details

---

### Admin Login
**URL:** `/admin/login`  
**Method:** GET  
**View:** `auth/admin-login.blade.php`  
**Purpose:** Display admin login form

**URL:** `/admin/login`  
**Method:** POST  
**Validation:**
- username: required, string
- password: required, string

**Success:** Redirect to admin dashboard  
**Failure:** Return with error message

---

### Admin Register
**URL:** `/admin/register`  
**Method:** GET  
**View:** `auth/admin-register.blade.php`  
**Purpose:** Display admin registration form

**URL:** `/admin/register`  
**Method:** POST  
**Validation:**
- username: required, string, max:255, unique
- password: required, string, min:6

**Success:** Redirect to login with success message  
**Failure:** Return with validation errors

---

### Admin Dashboard
**URL:** `/admin/dashboard`  
**Method:** GET  
**Auth:** Required (admin guard)  
**View:** `admin/dashboard.blade.php`  
**Data:**
- users: Collection of all users with bus and route relationships

**Purpose:** Display all drivers with management options

---

### Delete Driver
**URL:** `/admin/driver/delete`  
**Method:** POST  
**Auth:** Required (admin guard)  
**Form Data:**
- user_id: integer

**Action:** Updates driver username to "This Driver is not available now"  
**Success:** Redirect to dashboard with success message

---

### Create Bus
**URL:** `/admin/bus/create`  
**Method:** GET  
**Auth:** Required (admin guard)  
**View:** `admin/bus-create.blade.php`  
**Purpose:** Display bus creation form

**URL:** `/admin/bus/store`  
**Method:** POST  
**Auth:** Required (admin guard)  
**Validation:**
- busID: required, integer, unique, min:101
- route: required, string, exists in routes table
- passengerCapacity: required, integer

**Success:** Redirect to dashboard with success message  
**Failure:** Return with validation errors

---

### Create Route
**URL:** `/admin/route/create`  
**Method:** GET  
**Auth:** Required (admin guard)  
**View:** `admin/route-create.blade.php`  
**Purpose:** Display route creation form

**URL:** `/admin/route/store`  
**Method:** POST  
**Auth:** Required (admin guard)  
**Validation:**
- routeID: required, string, unique
- routeFrom: required, string
- routeTo: required, string
- oras: required, string

**Success:** Redirect to dashboard with success message  
**Failure:** Return with validation errors

---

## Middleware

### Authentication Middleware
- **web:** Applied to all routes (session, CSRF)
- **auth:** Applied to protected driver routes
- **auth:admin:** Applied to protected admin routes

### Route Groups
- **driver:** Prefix `/driver`, name prefix `driver.`
- **admin:** Prefix `/admin`, name prefix `admin.`

---

## Named Routes Usage

### In Controllers
```php
return redirect()->route('driver.dashboard');
return redirect()->route('admin.dashboard');
```

### In Blade Templates
```blade
<a href="{{ route('driver.login') }}">Login</a>
<a href="{{ route('admin.bus.create') }}">Create Bus</a>
```

### In Forms
```blade
<form action="{{ route('driver.login') }}" method="POST">
<form action="{{ route('admin.route.store') }}" method="POST">
```

---

## Testing Routes

### List All Routes
```bash
php artisan route:list
```

### Test Specific Route
```bash
php artisan route:list --name=driver
php artisan route:list --name=admin
```

### Clear Route Cache
```bash
php artisan route:clear
```

### Cache Routes (Production)
```bash
php artisan route:cache
```

---

## API Endpoints (Future)

Currently, this application uses web routes only. To add API endpoints:

1. Create routes in `routes/api.php`
2. Use API resource controllers
3. Implement API authentication (Sanctum/Passport)
4. Return JSON responses

Example:
```php
Route::prefix('api')->group(function () {
    Route::get('/buses', [BusController::class, 'index']);
    Route::get('/routes', [RouteController::class, 'index']);
});
```

---

## Security Notes

1. **CSRF Protection:** All POST routes require CSRF token
2. **Authentication:** Protected routes check authentication
3. **Authorization:** Admin routes use separate guard
4. **Validation:** All form submissions are validated
5. **Rate Limiting:** Can be added to prevent abuse

---

## Quick Reference

### Driver URLs
- Login: http://localhost:8000/driver/login
- Register: http://localhost:8000/driver/register
- Dashboard: http://localhost:8000/driver/dashboard

### Admin URLs
- Login: http://localhost:8000/admin/login
- Register: http://localhost:8000/admin/register
- Dashboard: http://localhost:8000/admin/dashboard
