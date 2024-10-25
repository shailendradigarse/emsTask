# Laravel Project Setup

## Overview

This Laravel-based project streamlines event payment configurations for finance teams, enabling efficient management of payment methods and provider requests. With a user-friendly interface, role-based access control, and integrated email notifications, it supports seamless updates and external API integrations.

### Key Features

- Event Payment Configuration
- New Payment Provider Request and Approval
- Role-Based Access Control
- Comprehensive API Endpoints
- Email Notifications

## Prerequisites

1. **PHP** (version 8.0 or higher)
2. **Composer** (for managing PHP dependencies)
3. **MySQL** (or any other compatible database)
4. **Node** 
4. **Npm**

## Setup Instructions

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/shailendradigarse/emsTask.git
cd emsTask
```
### 2. Install PHP Dependencies

Install the PHP dependencies using Composer:

```bash
composer install
```

### 3. Install node Dependencies

Install the PHP dependencies using Composer:

```bash
npm install
```

### Configure Environment Variables

1. **Create the .env File**:

Copy the example environment file to create a new .env file:

```bash
cp .env.example .env
```

2 **Set Up Database Configuration**:

Open the .env file and configure your database settings:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Make sure to replace your_database_name, your_database_username, and your_database_password with your actual database credentials.

3 **Set Up Mail Configuration**:

Open the .env file and configure your email settings:

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="youremail@gmail.com"
MAIL_PASSWORD="youremailapppassword"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="youremail@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

4. **Generate Application Key**:
Generate a new application key for the Laravel project:

```bash
php artisan key:generate
```
5. **Run Migrations**:
Run the database migrations to set up the necessary tables:

```bash
php artisan migrate
```
6. **Run seeder**:
Open a new terminal and run seeder command to create some defult value:

```bash
php artisan db:seed
```

6. **Start PHP Server**:
Open a new terminal and start the PHP development server:

```bash
php artisan serve
```

7. **Run build**:
Open a new terminal and run the build:

```bash
npm run dev
```
The application will be accessible at http://127.0.0.1:8000 (or another port specified in the output).

## Summary
Cloned the repository and installed dependencies.
Configured the .env file for database and mail settings.
Generated application key and ran migrations.
Ran the PHP server to access the application.
