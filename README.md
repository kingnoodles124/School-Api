## Student Enrollment API

A modular RESTful API built with Laravel, featuring student registration, class management, class assignment, admin authentication (via Sanctum), validation, testing, and proper error handling.

## Features

Admin authentication using Laravel Sanctum

Student CRUD operations

Class CRUD operations

Many-to-many student ↔ class assignment

Over-enrollment protection using max_students

Eager loading to prevent N+1 issues

Validation using Form Request classes

Feature & Unit tests (Laravel Testing)

Clean RESTful architecture

API documentation via Postman Collection

## Tech Stack

Laravel 11.x

PHP 8.2+ (via Laravel Herd)

Sanctum (token-based API auth)

MySQL / SQLite

Postman for API documentation

PHPUnit for testing

## Installation & Local Setup

Follow these steps to run the API locally.

## Clone the Repository
git clone <your-repository-url>
cd <project-folder>

## Install Composer Dependencies
herd php composer install

## Copy Environment File
cp .env.example .env

## Update .env configuration

Minimum required fields:

APP_NAME=StudentEnrollmentAPI
APP_ENV=local
APP_DEBUG=true
APP_URL=http://studentenrollmentapi.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_enrollment
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=studentenrollmentapi.test
SESSION_DOMAIN=studentenrollmentapi.test


If using SQLite, modify DB settings accordingly.

## Generate App Key
herd php artisan key:generate

## Run Migrations & Seeders

This will create tables & insert the default admin user.

herd php artisan migrate --seed


Default admin credentials:

email: admin@example.com  
password: password

## Run Development Server

If using Laravel Herd, simply add the project and visit:

http://studentenrollmentapi.test


API routes are under:

http://studentenrollmentapi.test/api

🔐 Authentication (Laravel Sanctum)

Login using:

POST /api/admin/login
{
  "email": "admin@example.com",
  "password": "password"
}


You will receive:

{
  "token": "your_sanctum_token_here"
}


Use this token for protected routes:

Authorization: Bearer <token>

## API Endpoints
## Authentication
POST /api/admin/login

Returns Sanctum token for admin.

## Students
GET /api/students

List all students (eager-loaded classes).

POST /api/students
{
  "name": "John Doe",
  "email": "john@example.com",
  "birthdate": "2010-01-01",
  "grade": "5A"
}

GET /api/students/{id}

View single student.

PUT /api/students/{id}

Update student.

DELETE /api/students/{id}

Delete student.

🏫 Classes
GET /api/classes

List all classes (with students).

POST /api/classes
{
  "name": "Math",
  "section": "A",
  "max_students": 30
}

## Class Assignment
POST /api/classes/{class}/assign/{student}

Assign a student to a class.

Responses:

200 → Student assigned successfully.

400 → Class is full.

409 → Student already assigned.

## Testing

Run all tests:

herd php artisan test


Includes:

## Feature Test:

Student creation

Class assignment

## Unit Test:

Class over-enrollment logic

## API Documentation

A Postman Collection is included:

student-enrollment-api.postman_collection.json

Import into Postman to see full documentation and example requests.

## Project Structure (Important Files)
app/
 ├─ Models/
 │   ├─ Admin.php
 │   ├─ Student.php
 │   └─ SchoolClass.php
 ├─ Http/
 │   ├─ Controllers/
 │   │   ├─ AuthController.php
 │   │   ├─ StudentController.php
 │   │   └─ ClassController.php
 │   ├─ Requests/
 │   │   ├─ StoreStudentRequest.php
 │   │   └─ StoreClassRequest.php

database/
 ├─ seeders/
 │   └─ AdminSeeder.php
 ├─ migrations/
 └─ factories/
     ├─ AdminFactory.php
     ├─ StudentFactory.php
     └─ SchoolClassFactory.php

tests/
 ├─ Feature/
 │   ├─ StudentTest.php
 │   └─ ClassAssignmentTest.php
 └─ Unit/
     └─ ClassOverEnrollmentTest.php