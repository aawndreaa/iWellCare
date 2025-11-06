# iWellCare Deployment Guide for Hostinger (Painless Method)

## Why Hostinger?
Hostinger offers one-click Laravel installation, making deployment extremely easy compared to manual setups.

## Prerequisites
- Hostinger hosting account (Business Web Hosting or higher recommended)
- Domain name
- FTP access (optional, for manual file uploads if needed)

## Step-by-Step Deployment

### Step 1: Sign Up/Login to Hostinger
1. Go to [hostinger.com](https://www.hostinger.com)
2. Sign up for Business Web Hosting plan ($2.99/month)
3. Complete account setup and domain configuration

### Step 2: Access hPanel (Hostinger Control Panel)
1. Login to your Hostinger account
2. Click "hPanel" to access the control panel
3. Navigate to "Websites" section

### Step 3: Install Laravel Using Auto-Installer
1. In hPanel, go to "Websites" → "Auto Installer"
2. Search for "Laravel" in the application list
3. Click "Install" on the Laravel option
4. Configure installation:
   - **Domain:** Select your domain
   - **Directory:** Leave as root (/) or choose subdirectory
   - **Version:** Select latest stable Laravel version
   - **Database:** Create new database (recommended)
   - **Admin Details:** Set admin email/password
5. Click "Install Now"
6. Wait 2-3 minutes for installation to complete

### Step 4: Upload iWellCare Files
Since Hostinger's auto-installer creates a basic Laravel structure, you need to replace it with iWellCare:

**Option A: FTP Upload (Recommended)**
1. Get FTP credentials from hPanel → "Files" → "FTP Accounts"
2. Connect using FileZilla or similar FTP client
3. Navigate to your website's root directory
4. Delete existing Laravel files (keep public_html structure)
5. Upload all files from `iwellcare_deployment.zip` (extract first)
6. Ensure `public` folder contents go into `public_html`

**Option B: File Manager**
1. In hPanel, go to "Files" → "File Manager"
2. Navigate to your website directory
3. Upload `iwellcare_deployment.zip`
4. Extract the zip file
5. Move files to appropriate locations

### Step 5: Database Setup
1. In hPanel, go to "Databases" → "MySQL Databases"
2. Create a new database (if not done during Laravel install)
3. Note down database name, username, and password
4. Access phpMyAdmin from hPanel
5. Import `database_export_manual.sql` into your database

### Step 6: Configure Environment
1. In File Manager, locate the uploaded files
2. Copy `env.example` to `.env`
3. Edit `.env` with your settings:
   ```
   APP_NAME=iWellCare
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=localhost  # Usually localhost for Hostinger
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password

   MAIL_MAILER=smtp
   MAIL_HOST=smtp.hostinger.com
   MAIL_PORT=587
   MAIL_USERNAME=your_email@yourdomain.com
   MAIL_PASSWORD=your_email_password
   MAIL_ENCRYPTION=tls
   ```

### Step 7: Generate Application Key
1. In hPanel, go to "Advanced" → "SSH Access"
2. Enable SSH if not already enabled
3. Connect via SSH terminal
4. Navigate to your website directory: `cd public_html`
5. Run: `php artisan key:generate`

### Step 8: Set Permissions
1. In SSH terminal, run:
   ```
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   ```

### Step 9: Clear Cache and Optimize
1. In SSH terminal, run:
   ```
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Step 10: Test Your Installation
1. Visit your domain (https://yourdomain.com)
2. Try registering a new user
3. Test login functionality
4. Check if database connections work

## Troubleshooting

**Blank Page:**
- Check PHP version (should be 8.0+)
- Verify .env file is properly configured
- Check file permissions

**Database Connection Error:**
- Verify database credentials in .env
- Ensure database exists and user has permissions

**File Upload Issues:**
- Check FTP credentials
- Ensure correct directory structure

## Hostinger-Specific Features
- **Free SSL:** Automatically enabled
- **Backups:** Daily automatic backups
- **CDN:** Built-in for faster loading
- **Email:** Free professional email accounts

## Support
- Hostinger has 24/7 live chat support
- Extensive knowledge base
- Laravel-specific documentation

This method is much faster than manual deployment and Hostinger handles most server configurations automatically.