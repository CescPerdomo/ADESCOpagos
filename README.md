# ADESCO Payment System

A comprehensive payment management system built with Laravel, featuring role-based access control, payment processing, receipt generation, and a modern UI with dark mode support.

## Requirements

- PHP >= 8.1
- Composer
- Node.js >= 16.x
- MySQL >= 8.0
- Git

## Installation

1. Clone the repository:
```bash
git clone https://github.com/CescPerdomo/ADESCOpagos.git
cd ADESCOpagos
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Environment Setup:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

6. Run migrations and seed the database:
```bash
php artisan migrate
php artisan db:seed
```

7. Build assets:
```bash
npm run dev
```

8. Start the development server:
```bash
php artisan serve
```

## Project Structure

### Key Directories

```
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Application controllers
│   │   ├── Middleware/     # Custom middleware
│   │   └── Requests/       # Form requests and validation
│   └── Models/            # Eloquent models
├── database/
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
│       ├── admin/        # Admin panel views
│       ├── components/   # Reusable UI components
│       └── layouts/      # Layout templates
└── routes/
    └── web.php          # Web routes
```

### Key Features

1. **Authentication System**
   - User registration and login
   - Password reset functionality
   - Email verification

2. **Role-Based Access Control**
   - Admin and User roles
   - Protected routes and middleware
   - Role-specific dashboards

3. **Payment Management**
   - Payment processing
   - Transaction history
   - Receipt generation (PDF)

4. **UI Components**
   - Modern, responsive design
   - Dark mode support
   - Reusable Blade components:
     - Forms and inputs
     - Buttons
     - Cards
     - Modals
     - Tables
     - Alerts
     - Badges
     - Loading spinners

## Available Routes

- `/` - Welcome page
- `/login` - User login
- `/register` - User registration
- `/dashboard` - User dashboard
- `/admin/dashboard` - Admin dashboard
- `/profile` - User profile management

## Database Schema

### Users Table
- id (primary key)
- name
- email
- password
- created_at
- updated_at

### Roles Table
- id (primary key)
- name
- created_at
- updated_at

### Transactions Table
- id (primary key)
- user_id (foreign key)
- amount
- description
- status
- created_at
- updated_at

### Receipts Table
- id (primary key)
- transaction_id (foreign key)
- receipt_number
- created_at
- updated_at

## Security

- CSRF protection enabled
- SQL injection prevention
- XSS protection
- Secure password hashing
- Rate limiting on authentication routes

## Development

### Adding New Features

1. Create necessary migrations:
```bash
php artisan make:migration create_your_table_name
```

2. Create models:
```bash
php artisan make:model YourModel
```

3. Create controllers:
```bash
php artisan make:controller YourController
```

### Running Tests

```bash
php artisan test
```

## Troubleshooting

### Common Issues

1. **Composer Dependencies**
```bash
composer dump-autoload
```

2. **Database Issues**
```bash
php artisan migrate:fresh --seed
```

3. **Cache Issues**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License.
