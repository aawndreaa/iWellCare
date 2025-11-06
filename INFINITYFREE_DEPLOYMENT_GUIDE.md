# iWellCare Deployment Guide for InfinityFree

## Prerequisites
- InfinityFree account with hosting space
- FTP access credentials
- Database created in InfinityFree control panel

## Files Prepared
- `iwellcare_deployment.zip` - Contains all application files optimized for production
- `database_export_manual.sql` - Database structure and initial setup

## Deployment Steps

### 1. Upload Files via FTP
1. Connect to your InfinityFree hosting using an FTP client (FileZilla recommended)
2. Navigate to the root directory (`htdocs` or `public_html`)
3. Upload `iwellcare_deployment.zip`
4. Extract the zip file contents directly in the root directory

### 2. Database Setup
1. Log into your InfinityFree control panel
2. Go to MySQL Databases section
3. Create a new database and note down:
   - Database name
   - Username
   - Password
   - Host (usually sqlXXX.infinityfree.com)
4. Access phpMyAdmin from the control panel
5. Select your database
6. Import `database_export_manual.sql`

### 3. Environment Configuration
1. In your FTP client, locate the extracted files
2. Copy `env.example` to `.env`
3. Edit `.env` file with your database credentials:
   ```
   APP_NAME=iWellCare
   APP_ENV=production
   APP_KEY=  # Generate a new key
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=sqlXXX.infinityfree.com
   DB_PORT=3306
   DB_DATABASE=if0_XXXXXXXX_iwellcare  # Your database name
   DB_USERNAME=if0_XXXXXXXX
   DB_PASSWORD=your_password
   ```
4. Configure other settings as needed (mail, etc.)

### 4. Generate Application Key
Since composer may not be available, you can generate the APP_KEY locally and update .env, or use an online Laravel key generator.

### 5. Set Permissions (if needed)
Ensure `storage` and `bootstrap/cache` directories are writable (usually 755 or 777 on shared hosting).

### 6. Access Your Application
- Visit your domain (https://yourdomain.com)
- The iWellCare application should now be running

## Post-Deployment Tasks
- Test user registration and login
- Verify database connections
- Check email functionality if configured
- Monitor logs in `storage/logs/laravel.log`

## Troubleshooting
- If you see a blank page, check PHP version (InfinityFree supports PHP 7.4+)
- Ensure .env file is properly configured
- Check file permissions
- Clear browser cache

## Notes
- The deployment package includes optimized vendor files (no-dev dependencies)
- Database export contains table structures but no sample data
- For production use, consider setting up SSL certificate through InfinityFree