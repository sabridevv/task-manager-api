# Task Manager API

This project is a Task Manager API built with Laravel 11, featuring user authentication using Sanctum, and CRUD operations for managing tasks.

## Features

- User Registration and Login
- Sanctum-based Authentication
- Create, Read, Update, and Delete Tasks
- Middleware for protecting routes

## Requirements

- PHP 8.0+
- Composer
- Laravel 11
- MySQL or another database supported by Laravel

## Installation

1. **Clone the Repository**
    ```bash
    git clone https://github.com/your-username/task-manager-api.git
    cd task-manager-api
    ```

2. **Install Dependencies**
    ```bash
    composer install
    ```

3. **Set Up Environment**
    Copy the `.env.example` file to `.env` and set up your database and other environment variables.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run Migrations**
    ```bash
    php artisan migrate
    ```

5. **Serve the Application**
    ```bash
    php artisan serve
    ```

## API Endpoints

### Authentication

- **Register**: `POST /api/register`
    - Request:
        ```json
        {
            "name": "Your Name",
            "email": "your-email@example.com",
            "password": "yourpassword",
            "password_confirmation": "yourpassword"
        }
        ```

- **Login**: `POST /api/login`
    - Request:
        ```json
        {
            "email": "your-email@example.com",
            "password": "yourpassword"
        }
        ```

### Tasks

- **Get All Tasks**: `GET /api/tasks`
    - Headers: `Authorization: Bearer your-auth-token`

- **Create a Task**: `POST /api/tasks`
    - Headers: `Authorization: Bearer your-auth-token`
    - Request:
        ```json
        {
            "title": "Complete project documentation",
            "description": "Finish the documentation for the project before the deadline."
        }
        ```

- **Create Multiple Tasks**: `POST /api/tasks`
    - Headers: `Authorization: Bearer your-auth-token`
    - Request:
        ```json
        [
            {
                "title": "Complete project documentation",
                "description": "Finish the documentation for the project before the deadline."
            },
            {
                "title": "Plan team meeting",
                "description": "Schedule and organize the team meeting for next Monday."
            }
        ]
        ```

- **Get a Task by ID**: `GET /api/tasks/{task_id}`
    - Headers: `Authorization: Bearer your-auth-token`

- **Update a Task**: `PUT /api/tasks/{task_id}`
    - Headers: `Authorization: Bearer your-auth-token`
    - Request:
        ```json
        {
            "title": "Complete project documentation (Updated)",
            "description": "Finish the documentation for the project before the new deadline.",
            "completed": false
        }
        ```

- **Delete a Task**: `DELETE /api/tasks/{task_id}`
    - Headers: `Authorization: Bearer your-auth-token`

## Example Task JSON Payload

### Single Task
```json
{
    "title": "Organize files",
    "description": "Sort and organize all digital files into appropriate folders and ensure backups are made."
}
