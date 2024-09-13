# Mariata Homes Accommodation Assistance Application

This project is a web-based application designed for Mariata Homes, a charity organization offering temporary accommodation assistance to individuals from lower socio-economic backgrounds. The platform digitizes the previously paper-based process, allowing users (clients) to register, log in, and provide necessary details to apply for accommodation assistance. Admin users can manage the registered users through full CRUD operations.

### Note that this project was created for a university coursework and is not intended for commercial use.

## Coursework PDF

The coursework for this project can be found [here](https://github.com/sohel473/MariataHomes/blob/main/public/CourseWork_COMP1430_001287370.pdf).


## Features

### User Registration & Information Submission

-   **User Registration**: Clients can register by providing their details, such as name, date of birth, contact information, next of kin, and passport photo upload.
-   **User Information**: Clients fill out forms with personal details, including illness history, last known residence, and the source of recommendation (e.g., police, prison, immigration).

### Admin Functionalities

-   **Admin Login**: Admin users can log in to access administrative features.
-   **User Management (CRUD)**: Admins can Create, Read, Update, and Delete user records in the system.
-   **Search Users**: Admins can search for specific users based on their details.
-   **Generate Reports**: Admins can generate reports based on registered users.

### Data Storage

-   **Database**: All user information is securely stored in a MySQL database, ensuring safe and easy access for future reference.

## Technologies and Tools Used

### Backend Development

-   **PHP**: For server-side scripting and compatibility with the HTML and database structure.
-   **Laravel**: MVC framework used for efficient development, security, and handling application logic.
-   **Eloquent ORM**: Simplifies database interactions through an object-relational mapper.

### Database

-   **MySQL**: Used to manage user information with reliability and PHP compatibility.

### Frontend Development

-   **HTML**: Used to build the core structure of the user interface.
-   **JavaScript**: Adds interactivity and enhances the user experience.
-   **Bootstrap 4**: Provides a responsive and mobile-first design.
-   **Blade Template Engine**: Integrates PHP and HTML for dynamic content rendering.

## Installation

Follow the steps below to set up the project on your local machine:

### Prerequisites

-   PHP 8.x
-   Composer
-   MySQL
-   Node.js & NPM (for front-end assets)

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/yourusername/mariata-homes.git
    cd mariata-homes
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    ```

3. **Configure the database:**

    - Create a new database in MySQL.
    - Update the `.env` file with your database credentials.

4. **Run migrations:**

    ```bash
    php artisan migrate
    ```

5. **Start the development server:**

    ```bash
    php artisan serve
    npm run dev
    ```

6. **Access the application:**
   Open your browser and navigate to `http://localhost:8000`.

