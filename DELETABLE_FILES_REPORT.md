# Files That Can Be Deleted - Codebase Cleanup Report

Generated: $(date)

## 🗑️ Safe to Delete Categories

### 1. **Backup Directories** (Entire Directories)
These are full backup copies of the application - safe to delete if you have proper version control:

- ✅ `application_ori/` - Backup of application directory
- ✅ `old_php7/` - Old PHP 7 version backup
- ✅ `old_php803/` - Old PHP 8.0.3 version backup  
- ✅ `old_php8112/` - Old PHP 8.1.12 version backup
- ✅ `resources_ori/` - Backup of resources directory

**Estimated Space Saved:** ~40,000+ files

---

### 2. **Duplicate Module Directories** (Potential Duplicates)
These appear to be duplicate/experimental versions:

- ⚠️ `application/adminxx/` - Duplicate of `admin/` (check if referenced in routes/config)
- ⚠️ `application/picxx/` - Duplicate of `pic/` (check if referenced in routes/config)

**Note:** Only delete if NOT referenced in routes.php or config files. Check first!

---

### 3. **Backup Files (.bak)** - 36 files
All `.bak` files can be deleted:

```
application/adminxx/models/Avpevpinspectionmanagement_model.php.bak
application/admin/models/Avpevpinspectionmanagement_model.php.bak
application/adminxx/controllers/Avpevpinspectionmanagement.php.bak
application/admin/controllers/Avpevpinspectionmanagement.php.bak
application/picxx/views/permitall/permitall_evp.php.bak
application/pic/views/permitall/permitall_evp.php.bak
application/picxx/views/permitall/permitall_avp.php.bak
application/pic/views/permitall/permitall_avp.php.bak
```

**Note:** Only delete `.bak` files in `application/` directory (not in backup directories)

---

### 4. **Old/Legacy Files (_old)** - 73 files
Files with `_old` suffix:

```
application/admin/views/foundation/dashboard_staff_old.php
application/admin/views/serviceCharges/list_old.php
application/admin/config/constants._old.php
application/admin/controllers/PdfOutput_old_20-03-2019.php
application/admin/views/chargeCollection/list_old.php
application/admin/views/chargeCollection/list_old_sst.php
application/pic/config/constants_old.php
application/picxx/config/constants_old.php
application/support/views/foundation/dashboard_staff_old.php
```

**Note:** Only delete `_old` files in `application/` directory

---

### 5. **Copy Files (_copy)** - 31 files
Duplicate image files with `_copy` suffix:

```
resources/shared_img/NRM_LOGO_No_Background_-_Copy.png
resources/shared_img/WhatsApp_Image_2023-05-11_at_10_29_59_AM_copy1.png
resources/shared_img/WhatsApp_Image_2023-05-11_at_10_29_59_AM_copy.png
resources/shared_img/question_bank/*_Copy.jpg (multiple files)
```

---

### 6. **Test Files (_test)** - 32 files
Test files that can be removed:

```
application/pic/views/foundation/login_form_test.php
application/picxx/views/foundation/login_form_test.php
resources/shared_js/jquery/2.2.2/build/tasks/promises_aplus_tests.js
resources/shared_js/jquery/2.2.2/build/tasks/node_smoke_tests.js
resources/shared_js/jquery/2.2.2/build/tasks/lib/spawn_test.js
```

**Note:** Keep `system/libraries/Unit_test.php` if you use CodeIgniter unit testing

---

### 7. **Original Files (.orig)** - 36 files
Git merge conflict resolution files:

```
application/pic/views/permitall/permitall_*.php.orig (4 files)
application/picxx/views/permitall/permitall_*.php.orig (4 files)
```

**Note:** Only delete `.orig` files in `application/` directory

---

### 8. **Compressed Archives (.7z)** - 9 files
Archived files:

```
application/admin/views/permitprintout.7z
application/adminxx/views/permitprintout.7z
```

---

### 9. **Temporary Files** 
Files with `temp` in name (found 26 files):
- Mostly in jQuery library build tasks
- Can be safely deleted

---

### 10. **Old Log Files**
Old error logs (can be archived or deleted):

```
application/admin/logs/elog_*.php (older than 30 days)
application/pic/logs/elog_*.php (older than 30 days)
```

**Note:** Keep recent logs for debugging

---

## 📊 Summary

### Files in `application/` Directory (Active Code):
- **Backup files (.bak):** ~8 files
- **Old files (_old):** ~10 files  
- **Test files (_test):** ~2 files
- **Copy files (_copy):** ~31 files
- **Original files (.orig):** ~8 files
- **Compressed (.7z):** ~2 files
- **Total:** ~61 files

### Entire Directories:
- **Backup directories:** 5 directories (~40,000 files)
- **Duplicate modules:** 2 directories (if not used)

---

## ⚠️ Before Deleting:

1. **Check Git/Version Control:** Ensure all important changes are committed
2. **Verify Routes:** Check if `adminxx` or `picxx` are referenced in routes.php
3. **Backup First:** Create a backup before mass deletion
4. **Test After:** Test application after cleanup

---

## 🚀 Recommended Deletion Order:

1. **Safest:** Delete `.bak`, `_old`, `_copy`, `.orig`, `.7z` files in `application/` 
2. **Medium:** Delete `_test` files (except Unit_test.php)
3. **Check First:** Verify `adminxx/` and `picxx/` are not used
4. **Last Resort:** Delete backup directories (`application_ori/`, `old_php*/`)

---

## 📝 Notes:

- All paths are relative to project root (`C:\xampp\htdocs\`)
- Files in backup directories (`old_php*`, `application_ori`) are safe to delete
- Files in active `application/` directory should be reviewed before deletion
- Keep recent log files for debugging purposes

