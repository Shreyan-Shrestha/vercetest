# Render Deployment Guide

## Prerequisites
- GitHub repository with your code pushed
- Render.com account (https://render.com)

## Step-by-Step Deployment

### 1. Prepare Your Repository
Make sure your code is pushed to GitHub:
```bash
git add .
git commit -m "Add Render configuration"
git push origin main
```

### 2. Create Render Account & Connect GitHub
- Go to https://render.com and sign up
- Connect your GitHub account in Settings
- Authorize Render to access your repositories

### 3. Deploy Using render.yaml
The simplest way is using the `render.yaml` file included in your project:

#### Option A: Deploy from Dashboard
1. Click "New" → "Blueprint"
2. Connect your GitHub repository
3. Select the branch (main/master)
4. Render will automatically read `render.yaml`
5. Add the following environment variables:

**Required Environment Variables:**
```
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_URL=your-app-name.onrender.com
DB_HOST=your-database-render-url
DB_DATABASE=vercetest_db
DB_USERNAME=vercetest_user
DB_PASSWORD=your-secure-password
```

To generate APP_KEY:
```bash
php artisan key:generate --show
```

6. Click "Deploy Blueprint"

#### Option B: Manual Setup (Alternative)
If you prefer manual configuration:

1. **Create Web Service**
   - Click "New" → "Web Service"
   - Connect your GitHub repository
   - Name: `vercetest-web`
   - Environment: `Docker`
   - Build Command: (leave empty - uses Dockerfile)
   - Start Command: (leave empty - uses Dockerfile CMD)
   - Plan: Standard (or higher)
   - Add all environment variables listed above
   - Click "Create Web Service"

2. **Create Database Service**
   - Click "New" → "MySQL"
   - Name: `vercetest-db`
   - Database: `vercetest_db`
   - Username: `vercetest_user`
   - Password: (auto-generated, note it)
   - Plan: Standard
   - Region: Choose same as web service
   - Click "Create Database"

3. **Link Database to Web Service**
   - Go to your web service settings
   - Click "Environment"
   - Add these variables:
     ```
     DB_HOST=your-database-render-url
     DB_DATABASE=vercetest_db
     DB_USERNAME=vercetest_user
     DB_PASSWORD=your-password
     ```

### 4. Set Environment Variables
In your Render service settings → Environment:

**Critical variables:**
```
APP_NAME=Vercetest
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xxxxxxxxxxxxx (from php artisan key:generate --show)
APP_URL=https://your-app-name.onrender.com

DB_CONNECTION=mysql
DB_HOST=(from MySQL service internal connection string)
DB_PORT=3306
DB_DATABASE=vercetest_db
DB_USERNAME=vercetest_user
DB_PASSWORD=(your postgres password)

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
LOG_CHANNEL=stack
LOG_LEVEL=error
```

### 5. Run Database Migrations
After first deployment:

1. Go to your web service
2. Click "Shell" tab
3. Run:
```bash
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder --force
```

### 6. Deployment Complete! 🎉
- Your app is live at `https://your-app-name.onrender.com`
- Render automatically deploys on every push to main branch
- Check logs in the "Logs" tab for any issues

## Troubleshooting

### Deploy fails: "Cannot find Dockerfile"
- Ensure `Dockerfile` is in root directory
- Check file name (case-sensitive on Linux)

### 502 Bad Gateway
- Check service logs for PHP/Nginx errors
- Verify database credentials
- Ensure migrations have run

### Database connection fails
- Get internal connection URL from MySQL service
- Format: `mysql-xxx.c.renders-mysql.com` (use this in DB_HOST)
- Verify credentials match what you set

### Build/Compile errors
- Check Node.js installation: `node --version`
- Check PHP extensions in Dockerfile
- View full build logs on Render dashboard

### Running Artisan commands
- Use Shell tab in web service dashboard
- Or deploy and SSH into the instance

## Performance Tips

1. **Enable Query Caching**
   ```
   CACHE_DRIVER=redis (requires Redis service)
   ```

2. **Use CDN for Static Assets**
   - Enable Render's built-in CDN
   - Or connect Cloudflare

3. **Monitor Build Times**
   - Large `node_modules` increase build time
   - Use `.dockerignore` to exclude unnecessary files

## Continuous Deployment

By default, Render automatically deploys on every push to your GitHub branch. To disable:
- Service settings → Auto-Deploy → Off

## Custom Domain

To use your own domain:
1. Service settings → Custom Domains
2. Add your domain
3. Point DNS records to Render
4. Wait for SSL certificate (automatic)

## Need Help?

- Render Docs: https://render.com/docs
- Laravel Docs: https://laravel.com/docs
- Check Render logs for detailed error messages
