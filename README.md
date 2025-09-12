
## 🛍️ E-Commerce Store - Laravel Project
A fully-featured e-commerce platform built with Laravel, featuring product management, user authentication, admin dashboard, RESTful API, and automated communication systems.

# ✨ Features
# 🎯 Core Functionality
Product Management: Complete CRUD operations for products

Category System: Organized product categorization

User Authentication: Secure login/register system with Laravel Breeze

Admin Dashboard: Comprehensive management interface

Responsive Design: Mobile-friendly Bootstrap interface

# 🛡️ Security Features
Role-Based Access Control: Admin/user permissions

Laravel Sanctum: API authentication

Rate Limiting: Protected API endpoints

CSRF Protection: Form security

Input Validation: Server-side validation

# 📊 Admin Dashboard
Product management with categories

User management system

Sales analytics and reporting

Order management interface

Inventory tracking

# 🔌 API Features
RESTful API: Versioned endpoints (v1)

API Resources: Structured JSON responses

Sanctum Authentication: Token-based security

Rate Limiting: Request throttling

Product & Category endpoints: Full CRUD operations

# 📧 Communication System
Welcome Emails: Automated user registration emails

Order Notifications: Real-time order updates

Multi-channel: Email and database notifications

Queue System: Background email processing

# 🚀 Installation
Prerequisites
PHP 8.1+

Composer

MySQL 5.7+

Node.js & NPM

Git

Setup Steps
Clone the repository

bash
git clone https://github.com/SalahAli2023/e-commerce-store.git
cd e-commerce-store
Install dependencies

bash
composer install
npm install
npm run build
Environment setup

bash
cp .env.example .env
php artisan key:generate
Database configuration

bash
# Edit .env file with your database credentials
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
Database migration & seeding

bash
php artisan migrate --seed
Storage link

bash
php artisan storage:link
Serve the application

bash
php artisan serve
# 📁 Project Structure
text
e-commerce-store/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── ProductController.php
│   │   │   ├── CategoryController.php
│   │   │   └── Api/V1/
│   │   ├── Resources/
│   │   └── Policies/
│   ├── Models/
│   ├── Mail/
│   ├── Notifications/
│   └── Providers/
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── public/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── auth/
│   │   └── emails/
│   └── js/
├── routes/
├── storage/
└── tests/
🔧 Configuration
Environment Variables
env
APP_NAME="E-Commerce Store"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
API Configuration
The API is available at /api/v1/ with the following endpoints:

GET /api/v1/products - List products

POST /api/v1/products - Create product (auth required)

GET /api/v1/products/{id} - Get product details

PUT /api/v1/products/{id} - Update product (auth required)

DELETE /api/v1/products/{id} - Delete product (auth required)

GET /api/v1/categories - List categories

POST /api/v1/categories - Create category (auth required)

# 👥 User Roles
Admin User
Email: s@gs.s

Password: 12

Permissions: Full access to all features

Regular User
Email: salah@g.com

Password: 12

Permissions: Browse products, make purchases

## 🎨 Admin Dashboard Features
# Product Management
Create, read, update, delete products

Category assignment

Image upload handling

Price management

Sale status toggle

# Category Management
Category creation and editing

Product count tracking

Slug generation

Organizational hierarchy

# User Management
User role management

Activity monitoring

Order history

## 🔌 API Usage Examples
Authentication
bash
# Get API token
curl -X POST http://localhost:8000/sanctum/token \
  -d "email=admin@example.com" \
  -d "password=password" \
  -d "device_name=api-client"
Get Products
bash
curl -X GET http://localhost:8000/api/v1/products \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"
Create Product (Authenticated)
bash
curl -X POST http://localhost:8000/api/v1/products \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "New Product",
    "description": "Product description",
    "price": 99.99,
    "category_id": 1,
    "on_sale": true
  }'
# 📧 Email System
Available Emails
Welcome Email: Sent to new users upon registration

Order Confirmation: Sent after purchase completion

Admin Notifications: Important system alerts

Configuration
Set up your mail provider in the .env file:

env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
# 🧪 Testing
Run Tests
bash
# Run PHPUnit tests
php artisan test

# Run specific test groups
php artisan test --group=api
php artisan test --group=authentication
Test Data
The database seeder includes:

50 sample products

10 product categories

Admin and test user accounts

Sample orders and reviews

# 🚀 Deployment
Production Setup
Set APP_ENV=production in .env

Configure production database

Set up SSL certificate

Configure queue workers

Set up monitoring and logging

Optimization
bash
# Optimize for production
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
🤝 Contributing
Fork the project

Create your feature branch (git checkout -b feature/AmazingFeature)

Commit your changes (git commit -m 'Add some AmazingFeature')

Push to the branch (git push origin feature/AmazingFeature)

Open a Pull Request

# 📝 Code Standards
This project follows:

PSR-12 coding standards

Laravel best practices

Semantic versioning

Conventional commits

## Troubleshooting

# Common Issues
Permission denied errors

bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
API authentication issues

Verify Sanctum configuration

Check CORS settings

Email not sending

Verify mail configuration in .env

Check queue workers are running

# Debug Mode
Enable debug mode in development:

env
APP_DEBUG=true
# 📊 Database Schema
Key Tables
users: User accounts and authentication

products: Product information and inventory

categories: Product categorization

orders: Customer orders

reviews: Product reviews and ratings

notifications: System notifications

# 🔐 Security Practices
CSRF protection enabled

XSS prevention

SQL injection prevention

Secure password hashing

API rate limiting

Input validation and sanitization

# 📈 Performance Tips
Use Laravel caching for frequently accessed data

Implement eager loading for relationships

Optimize images before upload

Use queue workers for email sending

Enable OPcache for PHP

# 📱 Mobile Responsiveness
The application features:

Bootstrap 5 responsive design

Mobile-friendly navigation

Touch-friendly interfaces

Optimized images for different devices

# 🌐 Browser Support
Chrome (latest)

Firefox (latest)

Safari (latest)

Edge (latest)

Mobile browsers

# 📄 License
This project is licensed under the MIT License - see the LICENSE.md file for details.

# 🙏 Acknowledgments
Laravel framework

Bootstrap CSS framework

Font Awesome icons

Laravel Breeze authentication

Laravel Sanctum API authentication

# 📞 Support
For support, please open an issue in the GitHub repository or contact the development team.