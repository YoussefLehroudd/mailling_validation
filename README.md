# mailling_validation

A Laravel application for email validation and registration system.

## Features
- User registration
- Email validation
- Registration success notifications

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP 8.1 or higher
- Composer
- Node.js and npm
- MySQL

## Installation & Setup

1. **Clone the repository**
```bash
git clone <repository-url>
cd registerApp
```

2. **Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

3. **Environment Setup**
```bash
# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

4. **Database Setup**

Create a new MySQL database:
```sql
mysql -u root -p
CREATE DATABASE mailling_validation;
```

Configure your `.env` file with database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mailling_validation
DB_USERNAME=root
DB_PASSWORD=your_password
```

Run migrations:
```bash
php artisan migrate
```

5. **Gmail SMTP Configuration**

To use Gmail SMTP, follow these steps:
1. Go to your Google Account settings
2. Enable 2-Step Verification if not already enabled
3. Generate an App Password:
   - Go to Security settings
   - Select 'App passwords' under 2-Step Verification
   - Generate a new app password for 'Mail'

Update your `.env` file with Gmail SMTP settings:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your.email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your.email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

6. **Build & Run**
```bash
# Build frontend assets
npm run build

# Start the Laravel server
php artisan serve
```

7. **Access the Application**
- Open your browser and visit: http://localhost:8000
- Try registering a new user
- Check your Gmail for the confirmation email

## Development

For development, you can run:
```bash
npm run dev
```
This will watch for any changes in your frontend assets and rebuild them automatically.

## Troubleshooting

If you encounter any issues:
1. Make sure all prerequisites are installed
2. Verify database credentials in `.env`
3. Ensure all dependencies are installed
4. Check storage folder permissions: `chmod -R 775 storage`
5. Clear Laravel cache:
```bash
php artisan config:clear
php artisan cache:clear
```

For Gmail SMTP issues:
1. Make sure 2-Step Verification is enabled
2. Verify you're using an App Password, not your regular Gmail password
3. Check that your Gmail account hasn't blocked the app access
