# Welcome to Textbook Express!

Textbook Express is an innovative solution aimed at streamlining the process of buying and selling academic textbooks within the school community. As students, we understand the challenges associated with obtaining required textbooks each semester, whether it's the financial burden of purchasing new books or the hassle of finding buyers for textbooks we no longer need.

Our platform serves as a bridge between students looking to sell their used textbooks and those in need of affordable options for their courses. By creating a centralized marketplace, Textbook Express facilitates easy transactions, helping students save money while also promoting sustainability through the reuse of educational materials.

## Note

This project was initially developed as a school project, aiming to provide a solution to streamline the process of buing and selling academic books.

## Setup Instructions

1. **Clone the Repository:**
    - Clone the repository to your local machine using the command:
      ```
      git clone https://github.com/ikageng-sa/textbook-express.git
      ```

2. **Install Dependencies:**
    - Navigate to the project directory and install the required dependencies using Composer:
        ```
        cd textbook-express
        composer install
        ```

3. **Create Environment File:**
    - Create a .env file in the project root directory. They can duplicate the .env.example file and rename it:
        ```
        cp .env.example .env
        ```

4. **Generate Application Key:**
    - Run the following command to generate a unique application key for the project:
        ```
        php artisan key:generate
        ```

5. **Configure Database:**
    - Update the .env file with database connection details, including DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD, to match the user's local environment.

6. **Run Database Migrations:**
    - Execute database migrations to create the necessary tables in the database:
        ```
        php artisan migrate --seed --seeder=DatabaseSeeder
        ```

7. **Start the Development Server:**
    - Start the Laravel development server by running:
        ```
        php artisan serve
        ```

8. **Access the Application:**
    - Once the server is running, users can access the Textbook Express application by opening a web browser and navigating to http://localhost:8000 (or a different port if specified).
    - Default super user email: super.admin@example.com, password: password

## Built With

Textbook Express is built using the following technologies and tools:

- **Laravel**: A powerful PHP framework for building web applications.
- **Composer**: A dependency manager for PHP used to install and manage project dependencies.
- **MySQL**: An open-source relational database management system used for storing application data.
- **HTML/CSS/JavaScript**: Frontend technologies for creating the user interface and enhancing user experience.
- **Bootstrap**: A popular CSS framework for building responsive and mobile-first websites.
- **Git**: Version control system used for tracking changes in the project and collaborating with others.
- **GitHub**: A platform for hosting and managing Git repositories, used for project collaboration and version control.



## Contributing

This project is open to contributions. If you wish to make changes to the application:

Feel free to fork the repository and make your changes.
    If the change is substantial, please consider opening an issue on GitHub to discuss it before submitting a pull request.