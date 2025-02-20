# Merkle-Tree-For-Authentication
```markdown
## Overview
This project presents a **web-based graphical password authentication system** that replaces traditional text-based passwords with a more interactive and visual approach. Users can authenticate using images or patterns, providing a secure and innovative alternative to logging in with text passwords.

## Features 🌟

- **Graphical Authentication**: Authenticate with images or patterns, making your password more visual and secure.
- **User Registration & Login**: Dedicated pages for easy sign-up and login.
- **Session Management**: Secure handling of user sessions, including the ability to log out.
- **Responsive UI**: Built with HTML5, CSS3, and JavaScript for a dynamic and mobile-friendly experience.
- **Database Integration**: MySQL is used to securely store user authentication data.
- **Apache & PHP Backend**: The server-side logic runs in PHP within a local XAMPP environment.

## Technologies Used 🛠️

### Frontend
- **HTML5**: Structure of the web pages.
- **CSS3**: Styling for a clean and modern design.
- **JavaScript**: Handles client-side interactivity for the graphical authentication process.

### Backend
- **PHP**: Server-side scripting to manage authentication and database interactions.
- **Apache Server**: Web server for handling requests, running in a local XAMPP environment.

### Database
- **MySQL**: Used to store user authentication data and credentials securely.

## Project Structure 📂

```
Graphical-Password-Authentication-Prototype/
│-- index.html              # Main UI for login/signup
│-- register.html           # User registration page
│-- login.html              # Login page
│-- css/
│   ├── index.css          # Main styles
│   ├── hstyle.css         # Header styling
│   ├── stylee.css         # Additional styles
│-- js/
│   ├── main.js            # Client-side authentication logic
│-- php/
│   ├── auth_handler.php   # Handles authentication logic
│   ├── logout.php         # Manages user logout
│   ├── db_conn.php        # Database connection setup
│   ├── setup_database.php # Script to initialize the database
```

## Installation Guide ⚙️

### Prerequisites
- **XAMPP** (includes Apache, MySQL, PHP)
- A **web browser** (e.g., Chrome, Firefox)

### Steps to Run Locally

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/graphical-password-auth.git
    ```

2. **Move the project to your XAMPP `htdocs` folder:**
    ```bash
    mv graphical-password-auth /c/xampp/htdocs/
    ```

3. **Start Apache & MySQL** via the XAMPP control panel.

4. **Create the database**:
    - Open **phpMyAdmin** and create a new database (e.g., `graphical_auth`).
    - Run the `setup_database.php` script to initialize tables.

5. **Open the project in a browser**:
    ``` 
    http://localhost/graphical-password-auth/index.html
    ```

## Usage 🚀

1. **Sign Up**: Register by selecting an image or pattern to be used as your password.
2. **Login**: Authenticate by re-selecting your previously chosen graphical password.
3. **Logout**: End your session securely when you're finished.

## Future Enhancements 🚧

- **Multi-Factor Authentication (MFA)**: Add extra layers of security.
- **Touchscreen & Gesture-Based Authentication**: Support for more intuitive authentication methods.
- **Enhanced Encryption Techniques**: Improve security for password storage using stronger encryption methods.

## Contributing 🤝

We welcome contributions! To help improve this project:

1. **Fork the repository**.
2. **Make improvements** or fix bugs.
3. **Submit a pull request** with your changes.

Your feedback and contributions are appreciated! 😊

## Contact 📬

For any questions, issues, or suggestions, please reach out via GitHub Issues or email us at [your-email@example.com](mailto:your-email@example.com).

---

**Built with security and innovation in mind! 🚀**
```

---
