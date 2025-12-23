# Testing Checklist

## Pre-Testing Setup

- [ ] MySQL server is running
- [ ] Database `alibus` is created
- [ ] Migrations have been run successfully
- [ ] Laravel development server is running (`php artisan serve`)
- [ ] No errors in `storage/logs/laravel.log`

## Admin Portal Testing

### Admin Authentication
- [ ] Can access admin login page (`/admin/login`)
- [ ] Can register new admin account (`/admin/register`)
- [ ] Registration validates unique username
- [ ] Registration requires password
- [ ] Can login with correct credentials
- [ ] Cannot login with incorrect credentials
- [ ] Error message displays for wrong credentials
- [ ] Can logout successfully

### Admin Dashboard
- [ ] Dashboard loads after login (`/admin/dashboard`)
- [ ] Can see list of all drivers
- [ ] Driver information displays correctly:
  - [ ] ID
  - [ ] First Name
  - [ ] Last Name
  - [ ] Age
  - [ ] Contact Number
  - [ ] Address
  - [ ] Username
  - [ ] Email
  - [ ] Bus ID
  - [ ] Route
  - [ ] Bus Capacity
- [ ] Navigation menu is visible
- [ ] Can access all menu items

### Route Management
- [ ] Can access route creation page (`/admin/route/create`)
- [ ] Form displays correctly
- [ ] Can create new route with:
  - [ ] Route ID (e.g., "R001")
  - [ ] Route From (e.g., "Downtown")
  - [ ] Route To (e.g., "University")
  - [ ] Time (e.g., "08:00 AM")
- [ ] Success message displays after creation
- [ ] Cannot create duplicate route ID
- [ ] Validation errors display correctly
- [ ] Can navigate back to dashboard

### Bus Management
- [ ] Can access bus creation page (`/admin/bus/create`)
- [ ] Form displays correctly
- [ ] Can create new bus with:
  - [ ] Bus ID (must be >= 101)
  - [ ] Route ID (must exist in routes table)
  - [ ] Passenger Capacity (number)
- [ ] Success message displays after creation
- [ ] Cannot create bus with ID < 101
- [ ] Cannot create bus with non-existent route
- [ ] Cannot create duplicate bus ID
- [ ] Validation errors display correctly
- [ ] Can navigate back to dashboard

### Driver Management
- [ ] Can view all drivers in dashboard
- [ ] Delete button appears for each driver
- [ ] Confirmation dialog appears when clicking delete
- [ ] Driver is marked as unavailable after deletion
- [ ] Username changes to "This Driver is not available now"
- [ ] Success message displays after deletion

## Driver Portal Testing

### Driver Authentication
- [ ] Can access driver login page (`/driver/login`)
- [ ] Can access registration page (`/driver/register`)
- [ ] Registration form validates all fields:
  - [ ] First Name (required)
  - [ ] Last Name (required)
  - [ ] Age (required, number)
  - [ ] Contact Number (required)
  - [ ] Address (required)
  - [ ] Username (required, unique)
  - [ ] Password (required, min 6 chars)
  - [ ] Email (required, unique, valid email)
- [ ] Cannot register with existing username
- [ ] Cannot register with existing email
- [ ] Success message displays after registration
- [ ] Can login with correct credentials
- [ ] Cannot login with incorrect credentials
- [ ] Error message displays for wrong credentials
- [ ] Can logout successfully

### Driver Dashboard
- [ ] Dashboard loads after login (`/driver/dashboard`)
- [ ] Driver ID displays in header
- [ ] Can see list of all drivers with schedules
- [ ] Driver information displays correctly:
  - [ ] ID
  - [ ] First Name
  - [ ] Age
  - [ ] Bus ID
  - [ ] Route (From - To)
  - [ ] Passenger Capacity
- [ ] Navigation menu is visible
- [ ] Search button is visible
- [ ] Report Route button is visible
- [ ] Category Route button is visible

### Driver Search
- [ ] Can access search page (`/driver/search`)
- [ ] Search form displays correctly
- [ ] Can search by username
- [ ] Search results display correctly
- [ ] Results show:
  - [ ] ID
  - [ ] First Name
  - [ ] Last Name
  - [ ] Age
  - [ ] Address
  - [ ] Bus ID
- [ ] "No users found" message displays for no results
- [ ] Can navigate back to dashboard

### Passenger Reporting
- [ ] Can access report page (`/driver/report`)
- [ ] Form displays correctly
- [ ] Can submit report with:
  - [ ] Bus ID (number)
  - [ ] Total Passenger (number)
- [ ] Error displays if bus ID doesn't exist
- [ ] Error displays if passenger count exceeds capacity
- [ ] Success message displays after valid submission
- [ ] Report details display after submission:
  - [ ] Route From
  - [ ] Route To
  - [ ] Total Passengers
  - [ ] Passenger Capacity
  - [ ] Route Time Date
- [ ] Can navigate back to dashboard

### Route Details
- [ ] Can access details page (`/driver/details`)
- [ ] Page loads correctly
- [ ] Can navigate back to dashboard

## Database Testing

### Users Table
- [ ] New users are created with hashed passwords
- [ ] Usernames are unique
- [ ] Emails are unique
- [ ] busID foreign key works correctly
- [ ] Timestamps are automatically set

### Admins Table
- [ ] New admins are created with hashed passwords
- [ ] Usernames are unique
- [ ] Timestamps are automatically set

### Buses Table
- [ ] New buses are created successfully
- [ ] busID is primary key
- [ ] route foreign key works correctly
- [ ] passengerTotal defaults to 0
- [ ] Timestamps are automatically set

### Routes Table
- [ ] New routes are created successfully
- [ ] routeID is primary key
- [ ] All fields are stored correctly
- [ ] Timestamps are automatically set

### Relationships
- [ ] User belongs to Bus
- [ ] Bus belongs to Route
- [ ] Bus has many Users
- [ ] Route has many Buses
- [ ] Eager loading works (no N+1 queries)

## Security Testing

### CSRF Protection
- [ ] All forms have @csrf token
- [ ] Forms fail without CSRF token
- [ ] CSRF token is validated

### XSS Protection
- [ ] User input is escaped in views
- [ ] HTML tags in input are escaped
- [ ] JavaScript in input is escaped

### SQL Injection
- [ ] Eloquent prevents SQL injection
- [ ] Special characters in input don't break queries

### Authentication
- [ ] Protected routes redirect to login
- [ ] Cannot access driver routes as admin
- [ ] Cannot access admin routes as driver
- [ ] Session expires after logout

### Password Security
- [ ] Passwords are hashed (not plain text)
- [ ] Password hashing uses bcrypt
- [ ] Passwords are not visible in database

## Performance Testing

### Page Load Times
- [ ] Login pages load < 1 second
- [ ] Dashboard loads < 2 seconds
- [ ] Forms submit < 1 second
- [ ] Search results load < 2 seconds

### Database Queries
- [ ] No N+1 query problems
- [ ] Eager loading is used where needed
- [ ] Indexes are properly set

## Browser Compatibility

- [ ] Works in Chrome
- [ ] Works in Firefox
- [ ] Works in Edge
- [ ] Works in Safari (if available)

## Responsive Design

- [ ] Pages display correctly on desktop
- [ ] Forms are usable on mobile
- [ ] Tables are readable on tablet

## Error Handling

### Validation Errors
- [ ] Display correctly on forms
- [ ] Are user-friendly
- [ ] Show specific field errors

### Database Errors
- [ ] Don't expose sensitive information
- [ ] Are logged properly
- [ ] Show user-friendly messages

### 404 Errors
- [ ] Invalid routes show 404
- [ ] 404 page is user-friendly

## Edge Cases

### Empty Data
- [ ] Empty tables display correctly
- [ ] No errors with no data

### Large Data
- [ ] Many users display correctly
- [ ] Many buses display correctly
- [ ] Many routes display correctly

### Special Characters
- [ ] Names with special characters work
- [ ] Addresses with special characters work
- [ ] Routes with special characters work

### Boundary Values
- [ ] Bus ID = 101 works (minimum)
- [ ] Bus ID = 100 fails (below minimum)
- [ ] Passenger capacity = 0 works
- [ ] Passenger total > capacity fails

## Integration Testing

### Complete Workflow
- [ ] Admin creates route
- [ ] Admin creates bus with that route
- [ ] Driver registers
- [ ] Admin assigns driver to bus (manual DB update)
- [ ] Driver logs in
- [ ] Driver sees assigned bus in dashboard
- [ ] Driver reports passenger count
- [ ] Admin sees updated information

## Regression Testing

After any code changes:
- [ ] Re-run all authentication tests
- [ ] Re-run all CRUD operation tests
- [ ] Re-run all validation tests
- [ ] Check for new errors in logs

## Documentation Testing

- [ ] README is accurate
- [ ] QUICK_START.md works
- [ ] LARAVEL_MIGRATION_GUIDE.md is complete
- [ ] CODE_COMPARISON.md is accurate
- [ ] All code examples work

## Final Checks

- [ ] No PHP errors
- [ ] No JavaScript errors
- [ ] No console warnings
- [ ] All images load correctly
- [ ] All links work
- [ ] All buttons work
- [ ] All forms submit correctly
- [ ] All validations work
- [ ] All redirects work
- [ ] All flash messages display

## Sign-off

- [ ] All critical tests passed
- [ ] All high-priority tests passed
- [ ] Known issues documented
- [ ] Ready for deployment

---

**Testing Date:** _______________

**Tested By:** _______________

**Notes:**
