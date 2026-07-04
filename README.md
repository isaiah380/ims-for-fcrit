# FCRIT Information Management System (IMS)

## Project Overview
The FCRIT Information Management System (IMS) is a comprehensive web portal designed for the Fr. Conceicao Rodrigues Institute of Technology. It streamlines the process of managing student academic and extracurricular achievements. The platform provides dedicated dashboards for Students, Faculty, and Administrators to facilitate the submission, review, and tracking of achievements across various college departments.

## Features
- **Role-Based Access Control:** Three distinct roles (Student, Faculty, Admin) with secure, custom-tailored dashboards.
- **Student Portal:**
  - Modern, responsive landing and login pages styled with FCRIT branding.
  - Seamless Google OAuth integration and phone number-based registration.
  - Submit academic achievements (Internships, Certificates, Competitions, Paper Publications) with PDF/Image proofs.
  - Track submission statuses (Pending, Approved, Rejected).
- **Faculty Portal:**
  - Review dashboard to view all student submissions.
  - Beautifully animated UI to approve or reject student documents and leave remarks.
- **Admin Portal:**
  - System-wide statistics and metrics (total students, pending reviews).
  - Department-wise student distribution grid (CE, ME, EXTC, EE, CSE, BSH).
  - Manage all user accounts (activate/deactivate, delete, filter, and search).

## Project Setup Steps
1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd ims
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install NPM dependencies:**
   ```bash
   npm install
   npm run build
   ```
4. **Environment Configuration:**
   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
   Generate the application key:
   ```bash
   php artisan key:generate
   ```
   *Note: Make sure to add your `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET` in the `.env` file to enable Google Login functionality.*

5. **Link Storage:**
   Ensure public files and uploaded documents are accessible:
   ```bash
   php artisan storage:link
   ```

## Database Setup
1. Create a MySQL database (e.g., `ims`).
2. Update the `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ims
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Run the migrations and seed the database with the default test accounts:
   ```bash
   php artisan migrate:fresh --seed
   ```

## Login Credentials (default test accounts)

You can use the following default accounts to test the application after running the seeder:

| Role | Email | Password | Notes |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@fcrit.ac.in` | `admin@123` | Full access to manage users and view stats. |
| **Faculty** | `sharmarahul@gmail.com` | `faculty@123` | Access to review, approve, and reject student submissions. |
| **Student** | *(Any)* | *(Any)* | You can login with any student details by registering a new account, or by using the **Google Sign-In** option on the login page! |

---
*Developed for Fr. Conceicao Rodrigues Institute of Technology (FCRIT).*
