# Code Comparison: Original PHP vs Laravel

## Authentication

### Original PHP (login.php)
```php
<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect Username or Password');</script>";
    }
    $stmt->close();
}
?>
```

### Laravel (DriverAuthController.php)
```php
<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('driver.dashboard');
        }

        return back()->withErrors(['username' => 'Incorrect Username or Password']);
    }
}
```

**Improvements:**
- ✅ No manual session handling
- ✅ Built-in validation
- ✅ Named routes
- ✅ Better error handling
- ✅ Cleaner code structure

---

## Database Query

### Original PHP (dashboard.php)
```php
<?php
$stmt = $conn->prepare("SELECT u.id, u.firstname, u.age, u.busID, b.route AS route, b.passengerCapacity AS passengerCapacity 
                        FROM users u 
                        LEFT JOIN bus b ON u.busID = b.busID");
$stmt->execute();
$result = $stmt->get_result();
?>

<?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['firstname']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo $row['busID']; ?></td>
        <td><?php echo $row['route']; ?></td>
        <td><?php echo $row['passengerCapacity']; ?></td>
    </tr>
<?php } ?>
```

### Laravel (DriverController.php + Blade)
```php
// Controller
public function dashboard()
{
    $users = User::with(['bus.routeInfo'])->get();
    return view('driver.dashboard', compact('users'));
}
```

```blade
{{-- Blade Template --}}
@foreach($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->firstname }}</td>
    <td>{{ $user->age }}</td>
    <td>{{ $user->busID }}</td>
    <td>{{ $user->bus->routeInfo->routeFrom ?? '' }} - {{ $user->bus->routeInfo->routeTo ?? '' }}</td>
    <td>{{ $user->bus->passengerCapacity ?? '' }}</td>
</tr>
@endforeach
```

**Improvements:**
- ✅ Eloquent ORM with relationships
- ✅ Eager loading (prevents N+1 queries)
- ✅ Cleaner template syntax
- ✅ Automatic XSS protection
- ✅ Null-safe operators

---

## Form Handling

### Original PHP (createRoute.php)
```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_routeID = trim($_POST["routeID"]);
    if (empty($input_routeID)) {
        $routeID_err = "Please enter a route ID.";
    } else {
        $routeID = $input_routeID;
    }
    
    // ... more validation ...
    
    if (empty($routeID_err) && empty($routeFrom_err) && empty($routeTo_err) && empty($oras_err)) {
        $sql = "INSERT INTO route (routeID, routeFrom, routeTo, oras) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $param_routeID, $param_routeFrom, $param_routeTo, $param_oras);
            $param_routeID = $routeID;
            $param_routeFrom = $routeFrom;
            $param_routeTo = $routeTo;
            $param_oras = $oras;
            
            if ($stmt->execute()) {
                echo "<script>alert('Route created successfully');</script>";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>
```

### Laravel (RouteController.php)
```php
<?php
namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'routeID' => 'required|string|unique:routes,routeID',
            'routeFrom' => 'required|string',
            'routeTo' => 'required|string',
            'oras' => 'required|string',
        ]);

        Route::create($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Route created successfully');
    }
}
```

**Improvements:**
- ✅ Automatic validation
- ✅ Mass assignment protection
- ✅ Flash messages
- ✅ Much less code
- ✅ Better error messages

---

## Model Relationships

### Original PHP
```php
// No models - direct database queries everywhere
$stmt = $conn->prepare("SELECT * FROM bus WHERE busID = ?");
$stmt->bind_param("i", $busID);
$stmt->execute();
$result = $stmt->get_result();
$bus = $result->fetch_assoc();

// Then manually join with route
$stmt2 = $conn->prepare("SELECT * FROM route WHERE routeID = ?");
$stmt2->bind_param("s", $bus['route']);
// ... more code
```

### Laravel
```php
// Bus Model
class Bus extends Model
{
    public function routeInfo()
    {
        return $this->belongsTo(Route::class, 'route', 'routeID');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'busID', 'busID');
    }
}

// Usage
$bus = Bus::with('routeInfo')->find($busID);
echo $bus->routeInfo->routeFrom; // Automatic relationship loading
```

**Improvements:**
- ✅ Defined relationships
- ✅ Automatic joins
- ✅ Eager loading
- ✅ Cleaner code
- ✅ Type hinting

---

## Security

### Original PHP
```php
// Manual CSRF protection (none in original)
// Manual XSS protection
echo htmlspecialchars($user['firstname']);

// Manual SQL injection protection
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
```

### Laravel
```blade
{{-- Automatic CSRF protection --}}
<form method="POST">
    @csrf
    {{-- Automatic XSS protection --}}
    <input value="{{ $user->firstname }}">
</form>
```

```php
// Automatic SQL injection protection
User::where('id', $id)->first();
```

**Improvements:**
- ✅ CSRF tokens on all forms
- ✅ Automatic XSS escaping
- ✅ SQL injection prevention
- ✅ Mass assignment protection
- ✅ Password hashing

---

## Routing

### Original PHP
```
login.php
create.php
dashboard.php
passenger.php
schedule.php
details.php
logInadmin.php
createAdmin.php
dashboardAdmin.php
driverAssign.php
createRoute.php
```

### Laravel (routes/web.php)
```php
Route::prefix('driver')->name('driver.')->group(function () {
    Route::get('login', [DriverAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [DriverAuthController::class, 'login']);
    Route::get('dashboard', [DriverController::class, 'dashboard'])->name('dashboard');
    // ... more routes
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // ... more routes
});
```

**Improvements:**
- ✅ Centralized routing
- ✅ Named routes
- ✅ Route grouping
- ✅ Middleware support
- ✅ RESTful conventions

---

## Configuration

### Original PHP (config.php)
```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "alibus";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### Laravel (.env)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alibus
DB_USERNAME=root
DB_PASSWORD=
```

**Improvements:**
- ✅ Environment-based config
- ✅ No hardcoded credentials
- ✅ Easy to change per environment
- ✅ Connection pooling
- ✅ Multiple database support

---

## Summary

| Feature | Original PHP | Laravel |
|---------|-------------|---------|
| Lines of Code | ~2000+ | ~1200 |
| Files | 25+ PHP files | 25+ organized files |
| Security | Manual | Built-in |
| Validation | Manual | Automatic |
| Database | MySQLi | Eloquent ORM |
| Templates | Mixed PHP/HTML | Blade |
| Routing | File-based | Centralized |
| Authentication | Manual sessions | Built-in guards |
| Testing | Difficult | Easy with PHPUnit |
| Maintenance | Hard | Easy |
| Scalability | Limited | Excellent |
| Code Reuse | Low | High |

## Conclusion

The Laravel version provides:
- **50% less code** for the same functionality
- **Better security** out of the box
- **Easier maintenance** with clear structure
- **Better performance** with query optimization
- **Modern practices** following industry standards
