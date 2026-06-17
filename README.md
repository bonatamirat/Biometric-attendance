# Biometric Attendance System 📌

A secure, modern attendance tracking system using fingerprint/biometric authentication for organizations, schools, and workplaces.

## 🚀 Key Features

✅ **Fingerprint/Facial Recognition** – Log attendance via biometric authentication  
✅ **Real-time Reporting** – Generate PDF/Excel reports for payroll & audits  
✅ **Employee Management** – Add, edit, and manage employee records  
✅ **Admin Dashboard** – Manage users, view statistics, and configure system settings  
✅ **Database Integration** – Uses MongoDB for flexible data storage  
✅ **Responsive Design** – Works on desktop and mobile devices  

## 📁 Project Structure

```
Biometric-attendance/
├── index.php              # Main landing page
├── login.php              # User login
├── logout.php             # Logout handler
├── attendance.php         # Attendance recording page
├── enroll.php             # Employee enrollment
├── manage_employee.php    # Employee management
├── manage_admin.php       # Admin user management
├── report.php             # Attendance reports
├── config.php             # Database configuration
├── api.php                # API endpoints
├── save_attendance.php    # Attendance save handler
├── fetch_attendance.php   # Attendance data fetcher
├── delete.php             # Delete records
├── migrate.php            # Database migration
├── help.php               # Help documentation
├── assets/
│   ├── css/               # Bootstrap and custom styles
│   ├── js/                # JavaScript files
│   └── images/            # Project images
├── uploads/               # Employee fingerprint images
├── vendor/                # Composer dependencies
├── composer.json          # PHP dependencies
└── README.md              # This file
```

## 🛠️ Installation

### Prerequisites

- PHP 7.4 or higher
- MongoDB 4.4 or higher
- Composer (for dependency management)
- Web server (Apache, Nginx, or built-in PHP server)

### Setup Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/bonatamirat/Biometric-attendance.git
   cd Biometric-attendance
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Configure database:**
   - Edit `config.php` with your MongoDB connection details

4. **Set up web server:**
   - Point your web server to the project root directory
   - Or use PHP built-in server:
   ```bash
   php -S localhost:8000
   ```

5. **Access the system:**
   - Open `http://localhost:8000` in your browser

## 📊 Usage

### For Employees
1. Login with your credentials
2. Place your finger on the biometric scanner
3. Attendance is automatically recorded with timestamp

### For Administrators
1. Login to admin dashboard
2. Manage employee records (add, edit, delete)
3. View attendance reports
4. Generate PDF/Excel reports
5. Configure system settings

## 🔧 Configuration

### MongoDB Setup

Make sure MongoDB is running and accessible.

### Biometric Device

The system expects a biometric device connected via USB.

## 📦 Dependencies

- [MongoDB PHP Library](https://www.mongodb.com/docs/drivers/php/) - For database operations
- [Bootstrap 5](https://getbootstrap.com/) - Frontend framework
- [jQuery](https://jquery.com/) - JavaScript library

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Open a Pull Request

## 📜 License

This project is open-source and available under the [MIT License](LICENSE).

## 📞 Support

For issues or questions:
- Open an issue on GitHub
- Check the `help.php` page for documentation

---

**Developed by:** Bona Tamirat  
**Project Type:** Academic/Commercial  
**Version:** 1.0.0
