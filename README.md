# DIASS - Airside Services Management System

A comprehensive web application for managing airside services, permits, enforcement, and violations at Malaysia Airports (Sepang) Sdn Bhd.

## 🚀 Quick Overview

DIASS is a **CodeIgniter-based PHP application** designed to manage:
- **Airside Permits** (ADP, AVP, EVP, etc.)
- **Enforcement & Violations** (NOV - Notice of Violation)
- **Demerit Point System**
- **Service Charges & Collections**
- **Driver & Vehicle Management**
- **Permit Issuance & Renewals**

## 📋 Features

### Core Modules
- **Admin Module** - Full administrative control
- **PIC Module** - Personnel in Charge interface
- **Support Module** - Support functions
- **Excel Module** - Data export functionality

### Key Functionalities
- ✅ Notice of Violation (NOV) generation with serial number tracking
- ✅ Demerit point system with suspension management
- ✅ Permit management (ADP, AVP, EVP, GPU, VDGS, etc.)
- ✅ PDF document generation (TCPDF)
- ✅ Multi-language support (English & Malay)
- ✅ Offence catalog management (2019, 2020, 2025 revisions)
- ✅ Suspension period calculation
- ✅ Monetary penalty tracking

## 🛠️ Technology Stack

- **Framework:** CodeIgniter 3.x
- **PHP Version:** 8.0+
- **Database:** Microsoft SQL Server
- **PDF Library:** TCPDF
- **Frontend:** jQuery, Bootstrap, DataTables

## 📁 Project Structure

```
├── application/
│   ├── admin/          # Admin module
│   ├── pic/            # PIC module
│   ├── support/        # Support module
│   ├── excel/          # Excel export module
│   └── helpers/        # Shared helpers
├── system/             # CodeIgniter core
├── resources/          # Static assets (JS, CSS, images)
├── uploads/            # User uploads
└── index.php           # Entry point
```

## ⚙️ Requirements

- PHP 8.0 or higher
- Microsoft SQL Server
- Apache/Nginx web server
- Microsoft ODBC Driver for SQL Server
- PHP SQL Server extensions:
  - `php_pdo_sqlsrv_82_ts_x64.dll`
  - `php_sqlsrv_82_ts_x64.dll`

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ammarhamzi/DIASS.git
   cd DIASS
   ```

2. **Configure database**
   - Edit `application/{module}/config/database.php`
   - Set SQL Server connection details

3. **Configure base URL**
   - Edit `application/{module}/config/config.php`
   - Update `base_url` to match your environment

4. **Set permissions**
   - Ensure `application/{module}/logs/` is writable
   - Ensure `uploads/` directory is writable

5. **Install dependencies**
   - PHP extensions should be enabled in `php.ini`
   - No Composer dependencies required

## 🌐 Access Points

- **Admin:** `http://localhost/admin/`
- **PIC:** `http://localhost/pic/`
- **Support:** `http://localhost/support/`

## 📝 Recent Updates

### NOV Serial Number Format
- Updated format: `NOV/YYYY/MM/XXXX` (e.g., `NOV/2025/11/0004`)
- Running number resets monthly

### Suspension End Date Calculation
- Automatic calculation based on created date + suspension period
- Supports: 2 weeks, 1 month, 2 months, 4 months, 6 months, 12 months

### Code Improvements
- Added enforcement helper functions
- Consolidated PDF output controllers
- Improved error handling

## 📚 Documentation

- **CHANGES.md** - Configuration changes log
- **DELETABLE_FILES_REPORT.md** - Files cleanup guide

## 🔐 Security Notes

- Database credentials should be configured per environment
- Ensure proper file permissions on sensitive directories
- Log files contain sensitive information - handle appropriately

## 🐛 Troubleshooting

### SQL Server Connection Issues
- Verify ODBC Driver is installed
- Check PHP extensions match PHP version (TS/x64)
- Ensure VC++ Redistributable is installed

### PDF Generation Errors
- Check TCPDF library is properly installed
- Verify write permissions on temp directories

### Logging Issues
- Ensure log directories exist and are writable
- Check log path configuration in `config.php`

## 📄 License

This project is proprietary software for Malaysia Airports (Sepang) Sdn Bhd.

## 👥 Contributors

- Development Team
- Malaysia Airports (Sepang) Sdn Bhd

## 📞 Support

For issues and questions, please contact the development team.

---

**Last Updated:** November 2025

