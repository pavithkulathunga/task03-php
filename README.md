# PHP Authentication System

A simple yet secure user authentication system built with PHP, MySQL, and HTML/CSS. This project demonstrates fundamental web security practices including password hashing, prepared statements for SQL injection prevention, and session management.

---

## 📋 Project Overview

This is a complete authentication system that allows users to:
- **Register** new accounts with validation
- **Login** with credentials
- **View** their profile information after authentication
- **Logout** securely

### Key Features

- ✅ **User Registration** with form validation
  - Name, email, username, and password fields
  - Password confirmation verification
  - Email and username uniqueness checks
  - Input sanitization and validation

- ✅ **Secure Login System**
  - Email/username based authentication
  - Password hashing using PHP's `password_hash()`
  - Session-based authentication
  - Error handling with user feedback

- ✅ **Protected Dashboard**
  - Welcome page only accessible to authenticated users
  - Session validation on page load
  - User information display
  - Secure logout functionality

- ✅ **Security Features**
  - Prepared statements to prevent SQL injection
  - Password hashing (PASSWORD_DEFAULT algorithm)
  - Input validation for email and username formats
  - Session management and protection

- ✅ **Responsive UI**
  - Clean, minimal design
  - Password visibility toggle
  - Error and success message display
  - Easy navigation between pages

---

## 🔧 Project Structure

```
task3/
├── index.php                 # Login page
├── register.php              # Registration page
├── welcome.php               # Protected dashboard (after login)
├── css/
│   └── style.css            # Stylesheet
├── inc/
│   ├── dbh.inc.php          # Database connection
│   ├── functions.inc.php     # Validation and user functions
│   ├── login.inc.php         # Login form handler
│   ├── logout.inc.php        # Logout handler
│   └── register.inc.php      # Registration form handler
├── js/
│   └── script.js            # Client-side JavaScript
└── README.md                # This file
```

---

## 🚀 Setup & Installation

### Prerequisites

- **XAMPP** (or similar PHP/MySQL server)
- **PHP** 7.0 or higher
- **MySQL** database server
- **Web browser** (Chrome, Firefox, Safari, Edge)

### Step 1: Download & Setup

1. Extract the project to your XAMPP htdocs folder:
   ```
   C:\xampp\htdocs\task3\
   ```

2. Start XAMPP services:
   - Open XAMPP Control Panel
   - Click "Start" for **Apache** and **MySQL**

### Step 2: Create Database

1. Open **phpMyAdmin** in your browser:
   ```
   http://localhost/phpmyadmin
   ```

2. Create a new database named `phpproject01`:
   - Click "New" → Enter database name → Click "Create"

3. Create the `users` table with the following SQL:
   ```sql
   CREATE TABLE users (
       usersId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
       usersName VARCHAR(128) NOT NULL,
       usersEmail VARCHAR(128) NOT NULL UNIQUE,
       usersUid VARCHAR(128) NOT NULL UNIQUE,
       usersPwd VARCHAR(255) NOT NULL
   );
   ```

   Alternatively, run this in the SQL query tab:
   ```sql
   CREATE TABLE `phpproject01`.`users` (
     `usersId` INT NOT NULL AUTO_INCREMENT,
     `usersName` VARCHAR(128) NOT NULL,
     `usersEmail` VARCHAR(128) NOT NULL UNIQUE,
     `usersUid` VARCHAR(128) NOT NULL UNIQUE,
     `usersPwd` VARCHAR(255) NOT NULL,
     PRIMARY KEY (`usersId`)
   );
   ```

### Step 3: Configure Database Connection

The database connection is already configured in `inc/dbh.inc.php` with:
- **Server**: localhost
- **Username**: root
- **Password**: (empty by default)
- **Database**: phpproject01

If your MySQL setup is different, update these values in `inc/dbh.inc.php`.

### Step 4: Run the Application

1. Open your browser and navigate to:
   ```
   http://localhost/task3/
   ```

2. You should see the **Login page**

---

## 📖 How to Use

### Registering a New Account

1. From the login page, click **"Register here"**
2. Fill in the registration form:
   - **Name**: Full name
   - **Email**: Valid email address
   - **Username**: Alphanumeric characters only
   - **Password**: Your desired password
   - **Confirm Password**: Re-enter password
3. Click **"Register"**
4. If successful, return to login page
5. If there are errors, follow the error messages to fix them

### Logging In

1. On the login page, enter:
   - **Email**: Your registered email address (or username)
   - **Password**: Your password
2. Click **"Login"**
3. If credentials are correct, you'll be redirected to the welcome page
4. If incorrect, you'll see an error message

### After Login

1. You'll see your:
   - Email address
   - Current login timestamp
2. Click **"Logout"** to end your session
3. You'll be redirected back to the login page

---

## 🖼️ Screenshots

### Login Page
![Login Page](https://via.placeholder.com/600x400?text=Login+Page+Screenshot)
*The initial login form where users enter their credentials*

### Registration Page
![Registration Page](https://via.placeholder.com/600x400?text=Registration+Page+Screenshot)
*The registration form for new users with validation feedback*

### Welcome Page
![Welcome Page](https://via.placeholder.com/600x400?text=Welcome+Page+Screenshot)
*The protected dashboard shown after successful login*

### Error Handling
![Error Message](https://via.placeholder.com/600x400?text=Error+Message+Example)
*Example of validation error feedback to users*

---

## 🔐 Security Considerations

### Implemented Security Measures

1. **Password Hashing**: Uses `PASSWORD_DEFAULT` (bcrypt)
   ```php
   $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
   ```

2. **Prepared Statements**: Prevents SQL injection attacks
   ```php
   $stmt = mysqli_stmt_init($conn);
   mysqli_stmt_prepare($stmt, $sql);
   mysqli_stmt_bind_param($stmt, "ss", $param1, $param2);
   ```

3. **Session Management**: Server-side session storage
   ```php
   session_start();
   $_SESSION['userid'] = $row['usersId'];
   ```

4. **Input Validation**: 
   - Email format validation using `FILTER_VALIDATE_EMAIL`
   - Username format validation (alphanumeric only)
   - Password matching verification
   - Empty field checks

5. **Access Control**: Protected pages verify session before loading
   ```php
   if (!isset($_SESSION['useruid'])) {
       header("location: index.php");
       exit();
   }
   ```

### Best Practices for Production

- [ ] Use HTTPS instead of HTTP
- [ ] Add CSRF tokens to forms
- [ ] Implement rate limiting for login attempts
- [ ] Add password reset functionality
- [ ] Use environment variables for database credentials
- [ ] Implement email verification for registration
- [ ] Add user roles and permissions
- [ ] Log authentication events
- [ ] Implement account lockout after failed attempts

---

## 🐛 Troubleshooting

### Database Connection Error
**Error**: "Connection failed: No such file or directory"
- **Solution**: Verify MySQL is running in XAMPP
- Check database credentials in `inc/dbh.inc.php`

### "Please fill in all fields!" Error
**Cause**: You didn't fill out one or more form fields
- **Solution**: Complete all required fields before submitting

### "Username or email already taken!" Error
**Cause**: You're trying to register with an existing email/username
- **Solution**: Use a different email or username

### Session Not Persisting
**Cause**: Browser cookies disabled or session configuration issue
- **Solution**: Enable cookies in your browser settings
- Check PHP session settings in `php.ini`

### Page Redirects to Login
**Cause**: Session expired or you're accessing protected page without login
- **Solution**: Log in again, or increase session timeout in PHP configuration

---

## 📝 File Descriptions

| File | Purpose |
|------|---------|
| `index.php` | Main login page |
| `register.php` | User registration page |
| `welcome.php` | Protected dashboard page |
| `inc/dbh.inc.php` | MySQL database connection setup |
| `inc/functions.inc.php` | Validation and user management functions |
| `inc/login.inc.php` | Processes login form submissions |
| `inc/register.inc.php` | Processes registration form submissions |
| `inc/logout.inc.php` | Handles user logout and session destruction |
| `css/style.css` | All styling and layout CSS |
| `js/script.js` | Client-side JavaScript functions |

---

## 💡 Future Enhancements

- [ ] Email verification on registration
- [ ] Password reset functionality
- [ ] "Remember me" functionality
- [ ] Account settings/profile management
- [ ] User roles and permissions
- [ ] Two-factor authentication
- [ ] Login history/activity log
- [ ] Admin dashboard for user management
- [ ] Dark mode support
- [ ] Mobile app version

---

## 📄 License

This project is provided as-is for educational purposes.

---

## ✉️ Support

For issues or questions, review the **Troubleshooting** section or check the source code comments for more details on each functionality.

---

**Happy Coding! 🎉**
