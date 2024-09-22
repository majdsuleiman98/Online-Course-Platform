
# Online Course Platform

This project is an online course platform developed using the Laravel framework. The platform allows users to browse and enroll in courses on a variety of subjects. It provides an interactive learning environment where users can follow lessons, take quizzes, and track their progress.

## Features

- **User Authentication**: Sign up, log in, and manage your account.
- **Browse Courses**: Explore a variety of courses on different subjects.
- **Enroll in Courses**: Register for courses and start learning immediately.
- **Follow Lessons**: Access structured lesson materials within each course.
- **Quizzes**: Take quizzes to test your understanding and improve your skills.
- **Progress Tracking**: Track your progress as you complete lessons and quizzes.

## Technologies Used

- **Laravel**: PHP framework for building the platform.
- **MySQL**: Database to store user information, courses, and quiz results.
- **Bootstrap**: Frontend framework for creating a responsive design.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/online-course-platform.git
    ```

2. Navigate to the project directory:
    ```bash
    cd online-course-platform
    ```

3. Install dependencies:
    ```bash
    composer install
    npm install
    ```

4. Set up environment variables:
    - Create a `.env` file by copying `.env.example` and update the necessary configurations:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. Run migrations to set up the database:
    ```bash
    php artisan migrate
    ```

6. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

- Users can sign up and log in to access courses.
- After enrolling in a course, users can follow lessons and take quizzes.
- Progress will be tracked as users complete each part of a course.

## Contributing

Contributions are welcome! If you'd like to help improve the platform, please fork the repository and submit a pull request.

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

