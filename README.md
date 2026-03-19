# Cape Town LMS

A full-featured Learning Management System built for the **University of Cape Town (UCT)**, providing a modern SPA-driven platform for academic course delivery, classroom management, and student engagement.

## Overview

Cape Town LMS is an institutional LMS built on Laravel 8 with a Vue 3 single-page application frontend. It features a multi-portal architecture with dedicated interfaces for administrators, teachers, and students, connected through a RESTful API backend. The platform includes a reusable CRUD mechanism layer and PrimeVue UI components for a polished user experience.

## Tech Stack

| Layer       | Technology                                         |
|-------------|-----------------------------------------------------|
| Backend     | PHP 7.3+ / 8.0, Laravel 8                         |
| Frontend    | Vue 3, Vue Router 4, Vuex 4, PrimeVue 3           |
| Auth        | Laravel Sanctum                                    |
| Database    | MySQL                                              |
| UI Library  | PrimeVue, PrimeIcons                               |
| Alerts      | SweetAlert2 (vue-sweetalert2)                      |
| Build Tools | Laravel Mix 6, Webpack                             |
| Containers  | Docker (docker-compose.yml)                        |
| Testing     | PHPUnit, Mockery                                   |

## Key Features

### Multi-Portal Architecture
- **Admin Portal** — Full platform management, categories, course oversight
- **Teacher Portal** — Course creation, classroom management, student engagement
- **Student Portal** — Course enrollment, classroom participation, submissions

### Academic Management
- Course creation with category classification
- Classroom management with membership tracking
- Course category hierarchy
- Student submission tracking

### Reusable CRUD Mechanism
- Abstracted data insertion, deletion, and retrieval layers
- Booking and order processing mechanisms
- Image customization utilities
- Summary processing helpers

### Vue 3 SPA Frontend
- Separate app bundles per portal (admin, teacher, student)
- Dedicated route configurations per user role
- Centralized Vuex store with composable utilities
- PrimeVue component library for consistent UI
- Reusable composables for CRUD operations, dialogs, and sorting

### API Layer
- Organized API routes by domain (academic, admin, student, teacher)
- JSON API resources for classrooms, courses, and categories
- Form request validation classes
- Token-based authentication via Sanctum

## Project Structure

```
app/
├── Http/Controllers/
│   ├── API/Backend/        # REST API controllers
│   │   ├── Academic/       # Course, classroom, category APIs
│   │   ├── Admin/          # Admin-specific APIs
│   │   └── Auth/           # Authentication API
│   └── Backend/            # Portal view controllers (Admin, Student, Teacher)
├── CrudMachanism/          # Reusable CRUD operation layers
├── Models/
│   ├── Academic/           # Course, Classroom, CourseCategory
│   └── Backend/            # Admin-specific models
└── Http/Resources/         # API resource transformations
resources/js/
├── components/backend/     # Vue 3 components
│   ├── admin/              # Admin portal components
│   ├── authentication/     # Sign-in components
│   └── layouts/            # Shared layout components
└── src/backend/
    ├── apps/               # Per-portal Vue app entry points
    ├── routes/             # Per-portal route definitions
    └── store/              # Vuex store configuration
routes/
├── api_academic.php        # Academic API routes
├── api_admin.php           # Admin API routes
├── api_student.php         # Student API routes
├── api_teacher.php         # Teacher API routes
├── web_admin.php           # Admin web routes
├── web_student.php         # Student web routes
└── web_teacher.php         # Teacher web routes
```

## Prerequisites

- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL
- Docker (optional)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mhmalvi/capetown-lms.git
   cd capetown-lms
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up the database**

   Configure your MySQL connection in `.env` and run:
   ```bash
   php artisan migrate
   ```

5. **Build frontend assets**
   ```bash
   npm run dev        # Development
   npm run production # Production
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

   Or use Docker:
   ```bash
   docker-compose up -d
   ```

## License

This project is proprietary software developed for the University of Cape Town.