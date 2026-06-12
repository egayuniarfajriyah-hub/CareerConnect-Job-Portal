# CareerConnect - Job Portal Website

CareerConnect is a modern Job Portal Website built with PHP Native, MySQL, Bootstrap 5, and Font Awesome. The platform connects job seekers with companies through an easy-to-use recruitment system.

## Features

### User Features

* User Registration & Login
* User Dashboard
* Browse Available Jobs
* Search Jobs by Title or Location
* View Job Details
* Apply for Jobs
* Upload CV
* Manage Profile
* View Application History

### Company Features

* Company Registration & Login
* Company Dashboard
* Manage Company Profile
* Post New Jobs
* Edit Job Listings
* Delete Job Listings
* View Applicants
* Accept or Reject Applications

### Public Features

* Modern Responsive Landing Page
* Dynamic Statistics
* Dynamic Featured Jobs
* Dynamic Trusted Companies
* Job Search Functionality
* Responsive Design

## Technologies Used

* PHP Native
* MySQL
* Bootstrap 5
* Font Awesome
* HTML5
* CSS3
* JavaScript

## Screenshots

### Landing Page

![Landing Page](assets/screenshots/landing-page.png)

### Company Dashboard

![Company Dashboard](assets/screenshots/company-dashboard.png)

### Manage Jobs

![Manage Jobs](assets/screenshots/manage-jobs.png)

### Applicants Management

![Applicants](assets/screenshots/applicants.png)

### User Dashboard

![User Dashboard](assets/screenshots/user-dashboard.png)

## Database Setup

1. Open phpMyAdmin
2. Create a database named:

```sql
careerconnect
```

3. Import:

```text
database/careerconnect.sql
```

## Installation

1. Clone this repository

```bash
git clone https://github.com/egayuniarfajriyah-hub/CareerConnect-Job-Portal.git
```

2. Move the project folder into:

```text
xampp/htdocs/
```

3. Configure database connection in:

```text
config/database.php
```

4. Start Apache and MySQL in XAMPP.

5. Open:

```text
http://localhost/CareerConnect-Job-Portal
```

## Project Structure

```text
CareerConnect-Job-Portal
│
├── assets/
│   └── screenshots/
│
├── auth/
│   ├── login.php
│   ├── register_user.php
│   ├── login_company.php
│   └── register_company.php
│
├── company/
│   ├── dashboard.php
│   ├── manage_jobs.php
│   ├── applicants.php
│   ├── profile.php
│   └── add_job.php
│
├── user/
│   ├── dashboard.php
│   ├── jobs.php
│   ├── profile.php
│   └── applications.php
│
├── config/
│   └── database.php
│
├── database/
│   └── careerconnect.sql
│
├── detail_job.php
├── index.php
└── README.md
```

## Future Improvements

* Company Logo Upload
* Job Categories
* Pagination
* Admin Dashboard
* Email Notifications
* Advanced Job Filtering

## Author

**Ega Yuniar Fajriyah**

Information Systems Student

GitHub: https://github.com/egayuniarfajriyah-hub

---

CareerConnect was developed as a portfolio project to demonstrate full-stack web development skills using PHP, MySQL, and Bootstrap.
