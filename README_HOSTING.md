# Deployment Guide (Vercel + Aiven)

This project is prepared for deployment using **Vercel** (Frontend/Backend) and **Aiven** (MySQL Database).

## 1. Database Setup (Aiven)

1.  Log in to [Aiven](https://aiven.io/).
2.  Create a new **MySQL** service (the free tier works well).
3.  Once the service is running:
    *   Find the **Service URI** or connection details (Host, Port, User, Password).
    *   Create a database named `db_pengaduan_sekolah` (or use the default `defaultdb`).
4.  Run the `database.sql` script on your Aiven database using a tool like HeidiSQL or MySQL Workbench.
    *   **Note**: The script has `CREATE DATABASE` commented out because cloud providers usually provide the database for you.

## 2. Vercel Deployment

1.  Push your code to a GitHub/GitLab repository.
2.  Import the repository into **Vercel**.
3.  In the **Environment Variables** section, add the following:
    *   `DB_HOST`: (Your Aiven host)
    *   `DB_NAME`: (Your database name, e.g., `defaultdb`)
    *   `DB_USER`: (Your Aiven user, usually `avnadmin`)
    *   `DB_PASS`: (Your Aiven password)
    *   `DB_PORT`: (Your Aiven port, usually `11130`)
    *   `DB_SSL`: `true`
4.  Deploy.

## 3. Important Notes

*   **File Uploads**: Since Vercel is a serverless environment, files uploaded (like photos in reports) are **volatile** and will be lost when the function instance resets or you redeploy. 
    *   *Solution*: For production use, integrate a service like **Cloudinary** or **AWS S3** for file storage.
*   **Routing**: The application uses `vercel.json` to map clean URLs (like `/siswa_dashboard`) to the internal `index.php?page=...` structure.

## 4. Local Development

You can still run the project locally using XAMPP. The `config/database.php` will automatically fallback to `localhost` if the environment variables are not set.
