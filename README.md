# Clibrity
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Clibrity is a comprehensive book management platform that allows users to manage their personal book collections, write reviews, participate in discussion. Built with Laravel and Vue.js, Clibrity offers a seamless and responsive user experience.

## Features

- **User Authentication and Authorization**: Secure user registration, login, and role-based access control.
- **Book Management**: Users can add, edit, delete, and view books in their collection.
- **User Reviews and Ratings**: Users can write reviews and rate books, with real-time updates.
- **User Profile Management**: Users can manage their profiles, including personal information and book preferences.
- **Forum for Book Discussions**: Engage in discussions about books in a dedicated forum.
- **Pagination**: Efficiently navigate through book lists and reviews with pagination.
- **Responsive Design**: Optimized for both desktop and mobile devices.
- **Asynchronous Requests**: Utilize asynchronous API requests for improved performance and user experience.
- **Mail Notifications**: Send and receive email notifications using Mailpit.

## Tech Stack

- **Backend**: Laravel
- **Frontend**: Vue.js
- **Database**: MySQL
- **Real-time**: Pusher
- **Queue**: Laravel Queue (database driver)
- **Mail**: Mailpit
- **WebSockets**: Laravel Reverb

## Architecture

### Backend

The backend is built with Laravel, a PHP framework that provides a robust set of tools and an application architecture that includes:

- **Controllers**: Handle the HTTP requests and return responses.
- **Models**: Represent the data and business logic.
- **Migrations**: Manage the database schema.
- **Seeders**: Populate the database with initial data.
- **Events and Listeners**: Handle real-time events and notifications.
- **API Routes**: Define asynchronous API endpoints in `api.php`.
- **Web Routes**: Define web routes for the application in `web.php`.

### Frontend

The frontend is built with Vue.js, a progressive JavaScript framework for building user interfaces. It includes:

- **Layouts**: Define the overall structure of the application, such as headers, footers, and sidebars.
- **Pages**: Represent different views or screens in the application, such as the home page, profile page, and book details page.
- **Components**: Reusable Vue components for different parts of the application, such as buttons, forms, and modals.
- **Inertia.js**: Integrate Laravel with Vue.js for seamless server-side rendering and client-side navigation.


### Real-time

Real-time functionality is implemented using Pusher and Laravel Reverb, which allows for real-time notifications and updates. This includes:

- **Broadcasting**: Laravel Echo and Pusher for real-time event broadcasting.
- **WebSockets**: Real-time communication between the server and the client.

### Queue

The application uses Laravel Queue with the database driver to handle background jobs such as sending notifications and processing heavy tasks.

## Installation

To get started with Clibrity, follow these steps:

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/clibrity.git
    cd clibrity
    ```

2. Install the dependencies:
    ```sh
    composer install
    npm install
    ```

3. Copy the [.env.example](http://_vscodecontentref_/1) file to [.env](http://_vscodecontentref_/2) and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate the application key:
    ```sh
    php artisan key:generate
    ```

5. Run the database migrations and seeders:
    ```sh
    php artisan migrate --seed
    ```

6. Start the development server:
    ```sh
    php artisan serve
    npm run dev
    ```

## Usage

Once the server is running, you can access the application at `http://localhost:8000`.

## License

This project is licensed under the MIT License. See the LICENSE file for more information.

## Design
[Figma](https://www.figma.com/design/sIE8VsoMLYMj2LEGvYuTnj/Clibrity?node-id=0-1&t=7WPZGquDw09RjTJp-1)

## Screenshots
Below are some screenshots showing the functionality and appearance of the platform:

![registration page](https://github.com/user-attachments/assets/787e647d-9604-407a-ab46-b576568ad7d0)

![forum](https://github.com/user-attachments/assets/93e3d68c-0e23-4acc-8e8e-ff0db9acac8c)

![create book](https://github.com/user-attachments/assets/f951923d-674a-49ec-9e0e-c7bd7cf5396c)

![book page](https://github.com/user-attachments/assets/5affe38d-205e-41b7-a969-62246b7a8d30)

![main page](https://github.com/user-attachments/assets/78d2d974-3b48-438d-b67e-76888d001faa)
