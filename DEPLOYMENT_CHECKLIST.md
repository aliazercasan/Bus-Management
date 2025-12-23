# Deployment Checklist

## Pre-Deployment

### Code Review
- [ ] All code is committed to version control
- [ ] No debug code or console.log statements
- [ ] No hardcoded credentials
- [ ] All TODO comments resolved
- [ ] Code follows Laravel conventions

### Testing
- [ ] All unit tests pass
- [ ] All feature tests pass
- [ ] Manual testing completed (see TESTING_CHECKLIST.md)
- [ ] No critical bugs
- [ ] Performance tested with realistic data

### Documentation
- [ ] README.md is up to date
- [ ] API documentation complete (if applicable)
- [ ] Deployment instructions documented
- [ ] Known issues documented

## Environment Setup

### Server Requirements
- [ ] PHP 8.1+ installed
- [ ] MySQL 5.7+ installed
- [ ] Composer installed
- [ ] Web server (Apache/Nginx) configured
- [ ] SSL certificate installed (for HTTPS)

### Laravel Configuration
- [ ] `.env` file created from `.env.example`
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` generated
- [ ] Database credentials configured
- [ ] Mail configuration set (if using email)

### Security
- [ ] Change default passwords
- [ ] Disable directory listing
- [ ] Set proper file permissions
- [ ] Configure firewall rules
- [ ] Enable HTTPS
- [ ] Set secure session configuration

## Database Setup

### Migration
- [ ] Database created
- [ ] Migrations run successfully
- [ ] Seeders run (if applicable)
- [ ] Database backup created

### Optimization
- [ ] Indexes created
- [ ] Query optimization done
- [ ] Database connection pooling configured

## File Permissions

```bash
# Storage and cache directories
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Make sure web server owns these
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

- [ ] Storage directory writable
- [ ] Bootstrap/cache directory writable
- [ ] Public directory readable
- [ ] Other directories not writable by web server

## Optimization

### Laravel Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

- [ ] Config cached
- [ ] Routes cached
- [ ] Views cached
- [ ] Autoloader optimized

### Composer Optimization
```bash
composer install --optimize-autoloader --no-dev
```

- [ ] Production dependencies only
- [ ] Autoloader optimized

## Web Server Configuration

### Apache (.htaccess)
- [ ] Rewrite rules configured
- [ ] Document root set to `/public`
- [ ] PHP version configured
- [ ] Memory limit set appropriately

### Nginx (nginx.conf)
- [ ] Server block configured
- [ ] Document root set to `/public`
- [ ] PHP-FPM configured
- [ ] SSL configured

## Monitoring

### Logging
- [ ] Log rotation configured
- [ ] Error logging enabled
- [ ] Log level set appropriately
- [ ] Log monitoring tool configured

### Performance
- [ ] Application monitoring tool installed
- [ ] Database monitoring configured
- [ ] Server monitoring configured
- [ ] Uptime monitoring configured

## Backup

### Database Backup
- [ ] Automated backup configured
- [ ] Backup retention policy set
- [ ] Backup restoration tested
- [ ] Off-site backup configured

### File Backup
- [ ] Application files backed up
- [ ] User uploads backed up
- [ ] Configuration files backed up

## Security Hardening

### Application
- [ ] CSRF protection enabled
- [ ] XSS protection enabled
- [ ] SQL injection protection verified
- [ ] Rate limiting configured
- [ ] Session security configured

### Server
- [ ] Firewall configured
- [ ] SSH key authentication enabled
- [ ] Unnecessary services disabled
- [ ] Security updates applied
- [ ] Fail2ban configured (optional)

## Post-Deployment

### Verification
- [ ] Application accessible via domain
- [ ] HTTPS working correctly
- [ ] All pages load correctly
- [ ] Forms submit correctly
- [ ] Authentication works
- [ ] Database connections work
- [ ] File uploads work (if applicable)
- [ ] Email sending works (if applicable)

### Testing
- [ ] Smoke tests passed
- [ ] Critical user flows tested
- [ ] Admin portal accessible
- [ ] Driver portal accessible
- [ ] No errors in logs

### Monitoring
- [ ] Error monitoring active
- [ ] Performance monitoring active
- [ ] Uptime monitoring active
- [ ] Backup monitoring active

## Rollback Plan

### Preparation
- [ ] Previous version backed up
- [ ] Database backup created
- [ ] Rollback procedure documented
- [ ] Rollback tested in staging

### Rollback Steps
1. [ ] Stop web server
2. [ ] Restore previous code version
3. [ ] Restore database backup (if needed)
4. [ ] Clear cache
5. [ ] Start web server
6. [ ] Verify application works

## Documentation

### Update Documentation
- [ ] Deployment date recorded
- [ ] Version number updated
- [ ] Changelog updated
- [ ] Known issues documented
- [ ] Contact information updated

### Team Communication
- [ ] Team notified of deployment
- [ ] Deployment notes shared
- [ ] Known issues communicated
- [ ] Support team briefed

## Maintenance

### Regular Tasks
- [ ] Schedule regular backups
- [ ] Schedule security updates
- [ ] Schedule dependency updates
- [ ] Schedule log cleanup
- [ ] Schedule performance reviews

### Monitoring Schedule
- [ ] Daily: Check error logs
- [ ] Weekly: Review performance metrics
- [ ] Monthly: Security audit
- [ ] Quarterly: Dependency updates

## Environment-Specific Checklist

### Production
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] Error reporting to log only
- [ ] HTTPS enforced
- [ ] Rate limiting strict
- [ ] Session lifetime appropriate

### Staging
- [ ] `APP_ENV=staging`
- [ ] `APP_DEBUG=true` (optional)
- [ ] Separate database
- [ ] Test data loaded
- [ ] Monitoring configured

## Final Checks

- [ ] All checklist items completed
- [ ] No critical issues
- [ ] Team ready for support
- [ ] Rollback plan ready
- [ ] Documentation complete

## Sign-off

**Deployed By:** _______________

**Date:** _______________

**Version:** _______________

**Notes:**
_______________________________________________
_______________________________________________
_______________________________________________

## Emergency Contacts

**System Administrator:** _______________

**Database Administrator:** _______________

**Development Team Lead:** _______________

**Support Team:** _______________

## Useful Commands

### Clear All Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Restart Services
```bash
# Apache
sudo systemctl restart apache2

# Nginx
sudo systemctl restart nginx

# PHP-FPM
sudo systemctl restart php8.1-fpm
```

### Check Logs
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Apache logs
tail -f /var/log/apache2/error.log

# Nginx logs
tail -f /var/log/nginx/error.log
```

### Database Operations
```bash
# Backup
mysqldump -u root -p alibus > backup.sql

# Restore
mysql -u root -p alibus < backup.sql
```

---

**Remember:** Always test in staging before deploying to production!
