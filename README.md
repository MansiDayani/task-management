# Task Management Module

This is a Laravel-based Task Management System with role-based access control. The project includes separate dashboards and functionalities for Admin, Developer, Tester, and PM (Project Manager) roles.

## Project Overview

This project is a comprehensive task management system that includes:

- **Projects Management**: Create, edit, and manage projects
- **Tasks Management**: Assign and track tasks
- **Role-Based Access**: 4 different roles (Admin, Developer, Tester, PM)
- **Task Workflow**: Task submission → Testing → PM Review → Completion
- **Points System**: Points tracking and management
- **File Upload**: Upload files with task attempts

### Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Livewire 3, Vite
- **Styling**: Tailwind CSS, Bootstrap 5
- **Database**: SQLite (default) / MySQL
- **Authentication**: Laravel UI / Breeze

---

## Installation & Setup

### Prerequisites

To run this project, you need the following installed on your system:

1. **PHP 8.2 or higher**
2. **Composer** (PHP dependency manager)
3. **Node.js and npm** (for frontend assets)
4. **XAMPP/WAMP** (or any local server)

---

## Step-by-Step Setup Instructions

### Step 1: Composer Install

First, install PHP dependencies:

```bash
composer install
```

Or if you don't have composer installed globally:

```bash
php composer.phar install
```

This command will install all PHP packages listed in the `composer.json` file, such as:
- Laravel Framework
- Livewire
- Laravel UI
- And other dependencies

**Note**: If you encounter any errors, try running `composer update` command as well.

---

### Step 2: Environment Configuration

Create the `.env` file (if it doesn't exist already):

**Windows:**
```bash
copy .env.example .env
```

**Linux/Mac:**
```bash
cp .env.example .env
```

Now generate the application key:

```bash
php artisan key:generate
```

Check the database configuration in the `.env` file. By default, SQLite is used:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

If you want to use MySQL, update these settings in the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=
```

---

### Step 3: NPM Install

Now install frontend dependencies:

```bash
npm install
```

This command will install all JavaScript packages listed in the `package.json` file, such as:
- Vite (build tool)
- Tailwind CSS
- Bootstrap
- Axios
- And other frontend dependencies

**Note**: This command will create a `node_modules` folder where all npm packages will be installed.

---

### Step 4: Database Migration

Run migrations to create database tables:

```bash
php artisan migrate
```

This command will run all migration files in the `database/migrations` folder and create the following tables:

- `users` (with role field)
- `projects`
- `tasks`
- `task_attempts`
- `task_test_reviews`
- `pm_reviews`
- `points`
- `cache`
- `jobs`

**Important**: If you're using SQLite, ensure that the `database/database.sqlite` file exists. If it doesn't, create it manually or run this command:

```bash
php artisan migrate:install
```

---

### Step 5: Run Development Server

Now start the development server to run the project:

```bash
npm run dev
```

This command will run two things simultaneously:
1. **Laravel Development Server** (`php artisan serve`) - for the backend
2. **Vite Dev Server** - for frontend assets (CSS, JS) with hot reload

**Note**: 
- Laravel server will run on `http://127.0.0.1:8000` by default
- Vite server will run on its own port and automatically integrate with Laravel

---

## Alternative Commands

### If you want to run Laravel server and Vite separately:

**Terminal 1** - Laravel Server:
```bash
php artisan serve
```

**Terminal 2** - Vite Dev Server:
```bash
npm run dev
```

### For Production Build:

To build frontend assets:

```bash
npm run build
```

This will create optimized and minified files for production.

---

## Features

### 1. Admin Dashboard
- Manage all projects and tasks
- Manage users
- Manage points system
- Complete system overview

### 2. Developer Dashboard
- View assigned tasks
- Submit tasks (with files)
- Track task status

### 3. Tester Dashboard
- Review submitted tasks
- Submit test reviews
- Approve/reject task attempts

### 4. PM (Project Manager) Dashboard
- Manage projects and tasks
- Perform final reviews
- Approve task completion

### 5. Task Workflow
```
Pending → Submitted → Testing → PM Review → Completed
```

---

## Default Routes

- **Home**: `http://127.0.0.1:8000/`
- **Login**: `http://127.0.0.1:8000/login`
- **Register**: `http://127.0.0.1:8000/register`
- **Admin Dashboard**: `http://127.0.0.1:8000/admin/dashboard`
- **Developer Dashboard**: `http://127.0.0.1:8000/developer/dashboard`
- **Tester Dashboard**: `http://127.0.0.1:8000/tester/dashboard`
- **PM Dashboard**: `http://127.0.0.1:8000/pm/dashboard`

---

## User Roles

The system has 4 main roles:

1. **admin**: Complete system access
2. **developer**: For submitting tasks
3. **tester**: For testing tasks
4. **pm**: For managing projects and tasks

---

## Troubleshooting

### Composer Install Error:
- Check PHP version (8.2+ required)
- Run `composer self-update`
- Run `composer clear-cache`

### NPM Install Error:
- Check Node.js version
- Run `npm cache clean --force`
- Delete `node_modules` folder and run `npm install` again

### Migration Error:
- Check database connection
- Verify database settings in `.env` file
- Check SQLite file permissions

### Vite/Dev Server Error:
- Check if port 8000 and Vite port are available
- Run `npm run build` and try again

---

## Additional Commands

### Cache Clear:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Database Reset:
```bash
php artisan migrate:fresh
```

### Create New Migration:
```bash
php artisan make:migration create_table_name
```

### Create New Controller:
```bash
php artisan make:controller ControllerName