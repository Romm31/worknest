# WorkNest

## Project Description

WorkNest is a full-stack employee management system built with Laravel. It provides a centralized platform for managing employee records, tracking daily attendance, and processing leave requests. The application features role-based access control with separate interfaces for administrators and employees, enabling efficient workforce management through an intuitive web-based dashboard.

## Features

### Admin Features

-   Dashboard with workforce statistics and weekly attendance overview
-   Department management (create, edit, delete, activate/deactivate)
-   Position management (create, edit, delete, activate/deactivate)
-   Employee management with user account creation
-   Attendance monitoring with date and department filters
-   Leave request approval and rejection workflow
-   Activity log viewer for audit trails

### Employee Features

-   Personal dashboard with attendance summary
-   Daily check-in and check-out functionality
-   Attendance history with monthly statistics
-   Leave request submission and tracking
-   Personal profile view

## Tech Stack

| Layer          | Technology                                |
| -------------- | ----------------------------------------- |
| Backend        | Laravel 11 (PHP 8.2+)                     |
| Frontend       | Blade Templates, Livewire 3               |
| Interactivity  | Alpine.js                                 |
| Database       | SQLite (configurable to MySQL/PostgreSQL) |
| Authentication | Laravel Breeze (session-based)            |
| Styling        | Tailwind CSS 4                            |
| Build Tool     | Vite                                      |

## System Roles

### Admin

Administrators have full access to the system, including the ability to manage departments, positions, and employee records. They can monitor attendance across the organization and approve or reject leave requests submitted by employees.

### Employee

Employees can record their daily attendance through check-in and check-out actions. They have access to their personal attendance history, can submit leave requests, and view their profile information.

## Installation and Setup

### Requirements

-   PHP 8.2 or higher
-   Composer
-   Node.js 18 or higher
-   npm

### Installation Steps

1. Clone the repository:

```bash
git clone https://github.com/your-username/worknest.git
cd worknest
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install Node.js dependencies:

```bash
npm install
```

4. Create environment file:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Create the SQLite database file:

```bash
touch database/database.sqlite
```

7. Run database migrations and seeders:

```bash
php artisan migrate --seed
```

8. Build frontend assets:

```bash
npm run build
```

9. Start the development server:

```bash
php artisan serve
```

The application will be available at `http://127.0.0.1:8000`.

## Default Credentials

The following accounts are created by the database seeder for development and testing purposes:

| Role     | Email                 | Password |
| -------- | --------------------- | -------- |
| Admin    | admin@worknest.com    | password |
| Employee | employee@worknest.com | password |

These credentials are intended for local development only. Change or remove them before deploying to production.

## Project Structure

```
worknest/
├── app/
│   ├── Livewire/           # Livewire components for Admin and Employee sections
│   ├── Models/             # Eloquent models (User, Employee, Department, etc.)
│   ├── Policies/           # Authorization policies
│   └── Http/Middleware/    # Custom middleware for role-based access
├── database/
│   ├── factories/          # Model factories for testing and seeding
│   ├── migrations/         # Database schema migrations
│   └── seeders/            # Database seeders with sample data
├── resources/
│   ├── css/                # Tailwind CSS configuration
│   └── views/
│       ├── components/     # Reusable Blade components
│       ├── layouts/        # Application layouts
│       └── livewire/       # Livewire component views
└── routes/
    └── web.php             # Application routes
```

## Screenshots

Screenshots of the application interface will be added here.

## Notes

This project is a simulated client project developed for portfolio and educational purposes. It demonstrates proficiency in Laravel full-stack development, including Livewire for reactive interfaces, Tailwind CSS for styling, and role-based access control patterns. The codebase follows Laravel conventions and best practices for maintainability and scalability.
