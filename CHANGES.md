# Project Changes

This document summarizes configuration edits applied to align the deployment with a project served directly from `htdocs` and to fix logging path issues.

## 2025-10-13

### application/pic/config/config.php

- base_url
  - Before: `http://localhost/diass-main/`
  - After:  `http://localhost/`

- log_path
  - Before: `E:/logs2452/pic/`
  - After:  `C:/xampp/htdocs/application/pic/logs/`

### application/admin/config/config.php

- base_url
  - Before: `http://localhost/diass-main/admin/`
  - After:  `http://localhost/admin/`

- log_path
  - Before: `E:/logs2452/admin/`
  - After:  `C:/xampp/htdocs/application/admin/logs/`

## Notes

- Ensure the new log directories exist and are writable:
  - `application/pic/logs/`
  - `application/admin/logs/`

- For SQL Server connectivity in Apache PHP, verify extensions match Apache's PHP build (from phpinfo screenshot: PHP 8.2, TS, x64):
  - Place DLLs in `C:\xampp\php\ext\` and enable in `php.ini`:
    - `extension=php_pdo_sqlsrv_82_ts_x64.dll`
    - `extension=php_sqlsrv_82_ts_x64.dll`
  - Confirm `extension_dir = "C:\\xampp\\php\\ext"`, install Microsoft ODBC Driver for SQL Server (v18+), install the matching VC++ redistributable, then restart Apache.



