# CITex - Calvin Institute Technology Exchange

## Project Overview

CITex (Calvin Institute Technology Exchange) is a web-based forum application designed for students and faculty at Calvin Institute to share knowledge and exchange ideas across various academic disciplines. The platform facilitates discussions within specific topic areas related to technology, science, engineering, and other fields.

## Key Features

- **User Authentication**: Secure registration and login system
- **Topic-Based Discussion**: Content organized by academic departments and sub-topics
- **Content Creation**: Users can create, edit, and delete posts
- **Comments System**: Interactive discussion through comments on posts
- **Docker Ready**: Containerized setup for easy deployment

## Academic Departments

The forum is divided into three main academic divisions:

1. **IBDA/IEE**: Informatics, Business Digital, and Artificial Intelligence / Industrial & Electrical Engineering
   - Web Programming
   - Microcontrollers
   - Object Oriented Programming
   - System Database

2. **BMS/CFP**: Biomedical Science / Consumer Food Production
   - Genomics
   - Biotechnology
   - Nutrition
   - Food Processing

3. **ASD/SCCE**: Architecture & Sustainable Design / Smart City & Civil Engineering
   - Sustainable Architecture
   - Green Building
   - Smart Construction
   - Civil Engineering

## Project Structure

```
cit_exchange/
├── asd_scce.php           # Architecture & Civil Engineering section
├── bms_cfp.php            # Biomedical Science & Food Processing section
├── comment.php            # Comment handling
├── create_post.php        # Post creation functionality
├── db.php                 # Database connection handler
├── delete_post.php        # Post deletion functionality
├── docker-compose.yml     # Docker Compose configuration
├── Dockerfile             # Docker configuration
├── ibda_iee.php           # Informatics & Electrical Engineering section
├── index.php              # Main landing page
├── login.html             # Login interface
├── login.php              # Login processing
├── logout.php             # Session termination
├── register.html          # Registration interface
├── register.php           # Registration processing
├── update_post.php        # Post update functionality
├── view_posts.php         # Post display logic
├── css/                   # Style sheets
│   ├── loginstyles.css    # Login/register page styling
│   └── styles.css         # Main application styling
└── database/              # Database initialization
    └── init.sql           # SQL schema and initial data
```

## Technologies Used

- **Backend**: PHP 8.0
- **Database**: MySQL 8.0
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 4.5
- **Containerization**: Docker

## Database Schema

The application uses a MySQL database with the following main tables:
- **users**: Stores user account information
- **posts**: Contains all forum posts with topic categorization
- **comments**: Stores user comments on posts

## Docker Setup

The project is containerized using Docker for easy deployment and consistent environments:

```bash
# Start the application with Docker Compose
docker-compose up -d
```

This will:
- Build and start a PHP 8.0 container with Apache
- Start a MySQL 8.0 database container
- Initialize the database with the schema from init.sql
- Map the application to port 8080

## Environment Configuration

The Docker environment is configured with the following variables:
- **MySQL Host**: db
- **MySQL User**: forum_user
- **MySQL Password**: forum_password
- **MySQL Database**: forum_db

## Getting Started

1. Clone this repository
2. Navigate to the project directory
3. Run `docker-compose up -d`
4. Access the application at http://localhost:8080
5. Register a new account to begin participating in discussions

## Development

To modify the application:
1. Make changes to the PHP files in the project directory
2. The changes will be immediately reflected due to volume mounting

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Open a pull request

## License

This project is created for educational purposes at Calvin Institute of Technology.

## Author

Your Name - Calvin Institute of Technology
