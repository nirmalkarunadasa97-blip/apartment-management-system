# Apartment Management System

A comprehensive web-based application built with Laravel for managing apartment complexes, residents, maintenance requests, and administrative operations.

## Features

### For Administrators

-   **Dashboard**: Overview of system statistics and recent activities
-   **User Management**: Create and manage staff and resident accounts
-   **Apartment Management**: Add, edit, and manage apartment listings with images
-   **Maintenance Oversight**: View and manage all maintenance requests
-   **Reports**: Generate and view system reports

### For Staff

-   **Maintenance Management**: Update maintenance request status to completed
-   **Apartment Oversight**: Access to apartment information and maintenance tracking

### For Residents

-   **Dashboard**: Personal dashboard with quick access to features
-   **Profile Management**: Update personal information and change password
-   **Maintenance Requests**: Submit and track maintenance requests
-   **Apartment Information**: View apartment details and status

## Technology Stack

-   **Backend**: Laravel 10.x
-   **Frontend**: Blade Templates, AdminLTE 3.2, Bootstrap
-   **Database**: MySQL (via Doctrine DBAL)
-   **Authentication**: Laravel Sanctum
-   **JavaScript**: jQuery, Toastr notifications
-   **Styling**: AdminLTE, Custom CSS

## Requirements

-   PHP 8.1 or higher
-   Composer
-   Node.js and npm (for frontend assets)
-   MySQL database
-   Web server (Apache/Nginx)

## Installation

1. **Clone the repository:**

    ```bash
    git clone <repository-url>
    cd apartment-management-system
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies:**

    ```bash
    npm install
    ```

4. **Environment Configuration:**

    ```bash
    cp .env.example .env
    ```

    Configure your database and other environment variables in `.env`

5. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

6. **Database Setup:**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

7. **Build frontend assets:**

    ```bash
    npm run build
    # or for development
    npm run dev
    ```

8. **Start the development server:**
    ```bash
    php artisan serve
    ```

## Database Seeding

The application includes seeders for initial data:

-   **User Roles**: Admin, Staff, Resident
-   **Default Users**:
    -   Admin: `admin@apartment.com` / `password`
    -   Staff: `staff@test.com` / `password`
    -   Resident: `resident@test.com` / `password`

## Usage

### Accessing the Application

1. Visit the landing page at `/`
2. Click "Resident Register" to create a new resident account
3. Or click "Login" to access existing accounts

### User Roles and Permissions

-   **Admin (Role ID: 1)**: Full system access
-   **Staff (Role ID: 2)**: Maintenance management access
-   **Resident (Role ID: 3)**: Personal dashboard and maintenance requests

## Project Structure

```
apartment-management-system/
├── .editorconfig
├── .gitattributes
├── .gitignore
├── apartment-management.sql
├── artisan
├── composer.json
├── composer.lock
├── package-lock.json
├── package.json
├── phpunit.xml
├── README.md
├── TODO.md
├── vite.config.js
├── app/
│   ├── Console/
│   │   └── Kernel.php
│   ├── Exceptions/
│   │   └── Handler.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdDashController.php
│   │   │   ├── AdminMaintenanceController.php
│   │   │   ├── AdminUserController.php
│   │   │   ├── ApartmentController.php
│   │   │   ├── AuthController.php
│   │   │   ├── ChangePasswordController.php
│   │   │   ├── Controller.php
│   │   │   ├── LanadinController.php
│   │   │   ├── MaintenanceController.php
│   │   │   ├── ProfileController.php
│   │   │   ├── RegisterController.php
│   │   │   ├── ReportController.php
│   │   │   └── ResidentDashController.php
│   │   ├── Kernel.php
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── AuthenticateByRole.php
│   │   │   ├── EncryptCookies.php
│   │   │   ├── PreventRequestsDuringMaintenance.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustHosts.php
│   │   │   └── VerifyCsrfToken.php
│   │   └── Requests/
│   │       ├── AdminMaintenanceRequest.php
│   │       ├── MaintenanRequest.php
│   │       ├── PasswordUpdateRequest.php
│   │       ├── RegisterStoreRequest.php
│   │       └── UpdateProfileRequest.php
│   └── Models/
│       ├── Apartment.php
│       ├── ApartmentApplication.php
│       ├── ApartmentImage.php
│       ├── Maintenance.php
│       ├── MaintenanceType.php
│       ├── Resident.php
│       ├── User.php
│       └── UserRole.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── BroadcastServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/
│   ├── app.php
│   └── cache/
│       └── .gitignore
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   ├── session.php
│   └── view.php
├── database/
│   ├── .gitignore
│   ├── factories/
│   │   └── UserFactory.php
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── UserRoleSeeder.php
├── public/
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   ├── robots.txt
│   └── assets/
│       ├── img/
│       │   ├── 1.jpg
│       │   ├── 2.jpg
│       │   ├── 3.jpg
│       │   └── 4.jpg
│       │   └── reg.jpeg
│       └── plugins/
│           
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── landing.blade.php
│       ├── welcome.blade.php
│       ├── addash/
│       ├── admin_maintenance/
│       ├── apartments/
│       ├── auth/
│       ├── change_password/
│       ├── layer/
│       ├── maintenance/
│       ├── profile_update/
│       ├── report/
│       ├── resdash/
│       └── users/
├── routes/
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage/
│   ├── app/
│   │   └── .gitignore
│   ├── framework/
│   │   ├── .gitignore
│   │   ├── cache/
│   │   ├── sessions/
│   │   ├── testing/
│   │   └── views/
│   └── logs/
│       └── .gitignore
└── tests/
    ├── CreatesApplication.php
    ├── TestCase.php
    └── Feature/
        ├── ExampleTest.php
        └── Unit/
            └── ExampleTest.php
```

## Testing

Run the test suite:

```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

For questions or support, please contact the development team.
