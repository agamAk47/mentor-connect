<div align="center">
  
# MentorConnect
**A Next-Generation Mentorship Platform for Startups and Industry Experts**

![MentorConnect](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-Atlas-47A248?style=for-the-badge&logo=mongodb&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)

</div>

## 📖 Overview

MentorConnect is an enterprise-grade Laravel web application designed to bridge the gap between emerging startups and seasoned industry mentors. Featuring a premium **Glassmorphism UI**, real-time messaging, and seamless role-based access, MentorConnect empowers founders to seek guidance, experts to give back to the community, and administrators to securely manage the platform.

The project is powered by **MongoDB**, offering a highly scalable NoSQL backend, and is fully configured for modern serverless deployment environments like Vercel.

---

## ✨ Key Features

- **Tri-Role Ecosystem:** Distinct, strictly protected experiences for `Startups`, `Mentors`, and `Administrators`.
- **Dynamic Mentorship Requests:** Startups can browse an extensive directory of approved mentors, view their expertise, and send direct mentorship requests.
- **Mentor Reviews & Ratings:** Startups can leave feedback and rate their mentors after a successful mentorship period.
- **Centralized Inbox & Messaging:** A unified, real-time messaging interface allowing startups and mentors to communicate seamlessly once a request is approved.
- **Community Board:** A built-in forum for users to share ideas, ask public questions, and network globally.
- **Comprehensive Admin Panel:** Powerful oversight tools for administrators to approve/reject mentors, manage all users, moderate posts, and view platform statistics.
- **Premium Glassmorphism UI:** Built with Tailwind CSS, featuring modern blur effects, micro-animations, and a highly responsive design system.
- **Cloud-Ready NoSQL Backend:** Fully integrated with MongoDB Atlas for scalable, document-based data storage using Laravel's Eloquent ORM.
- **Vercel Deployment Ready:** Includes pre-configured `vercel.json` and serverless routing for immediate zero-config deployment.

---

## 🚀 Getting Started

Follow these instructions to get the project up and running on your local machine.

### Prerequisites

*   **PHP:** >= 8.2
*   **Composer:** Latest version
*   **Node.js & NPM:** Latest version
*   **MongoDB:** Local instance or an active MongoDB Atlas Cluster

### Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/abhishak1305/Mentor-Connect.git
   cd Mentor-Connect
   ```

2. **Install Backend Dependencies:**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies:**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Configuration:**
   Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
   Generate your application key:
   ```bash
   php artisan key:generate
   ```

5. **Connect to MongoDB:**
   Open your `.env` file and update the database configuration with your MongoDB Atlas connection string:
   ```env
   DB_CONNECTION=mongodb
   DB_URI="mongodb+srv://<username>:<password>@cluster0.xxxxx.mongodb.net/?retryWrites=true&w=majority"
   DB_DATABASE=mentor_connect
   ```

6. **Run Migrations & Seed the Database:**
   This will create your collections and populate them with dummy data (categories, mentors, admin).
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Start the Development Server:**
   ```bash
   php artisan serve
   ```
   The application will be accessible at `http://localhost:8000`.

---

## ☁️ Deployment (Vercel)

MentorConnect is pre-configured for Vercel deployment. To deploy:
1. Push this repository to GitHub.
2. Import the project into Vercel.
3. Add your `.env` variables (`APP_KEY`, `DB_URI`, etc.) in the Vercel Environment Variables settings.
4. Click **Deploy**. Vercel will automatically detect the `vercel.json` configuration and deploy the application.

---

## 📄 Documentation
For a deep dive into the architecture, database schema, and detailed feature breakdowns, please refer to the [Project Details Document (PROJECT_DETAILS.md)](./PROJECT_DETAILS.md).

---

## 🔒 Security

Please ensure that you **never commit your `.env` file** to version control. If you discover a security vulnerability within MentorConnect, please open an issue or contact the repository maintainer directly.
