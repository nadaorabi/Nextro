# نظام الباقات التعليمية (Educational Packages System)

## نظرة عامة
تم إنشاء نظام متكامل لإدارة الباقات التعليمية في المشروع، يتضمن جميع العمليات الأساسية (CRUD) والميزات الإضافية.

## الملفات المنشأة

### 1. Routes (الراوتس)
- **الملف**: `routes/web.php`
- **الراوتس المضافة**:
  - `GET /admin/educational-packages` - عرض جميع الباقات
  - `GET /admin/educational-packages/create` - صفحة إنشاء باقة جديدة
  - `POST /admin/educational-packages` - حفظ باقة جديدة
  - `GET /admin/educational-packages/{package}` - عرض تفاصيل الباقة
  - `GET /admin/educational-packages/{package}/edit` - صفحة تعديل الباقة
  - `PUT /admin/educational-packages/{package}` - تحديث الباقة
  - `DELETE /admin/educational-packages/{package}` - حذف الباقة
  - `PATCH /admin/educational-packages/{package}/toggle-status` - تبديل حالة الباقة
  - `POST /admin/educational-packages/{package}/duplicate` - نسخ الباقة
  - `POST /admin/educational-packages/bulk-action` - إجراءات جماعية
  - `GET /admin/educational-packages/export` - تصدير الباقات

### 2. Views (الصفحات)
- **الملف**: `resources/views/admin/educational-packages/create.blade.php`
  - صفحة إنشاء باقة جديدة مع نموذج شامل
  - حقول: الاسم، الوصف، الفئة، السعر، العملة، الحالة، الصورة، اختيار الدورات

- **الملف**: `resources/views/admin/educational-packages/index.blade.php`
  - صفحة عرض جميع الباقات بتصميم بطاقات
  - ميزات البحث والفلترة والتصدير
  - إجراءات سريعة (عرض، تعديل، حذف)
  - عرض الفئة لكل باقة

- **الملف**: `resources/views/admin/educational-packages/show.blade.php`
  - صفحة تفاصيل الباقة
  - عرض معلومات الباقة والدورات المرتبطة والطلاب المسجلين
  - إحصائيات الباقة
  - عرض الفئة المرتبطة

- **الملف**: `resources/views/admin/educational-packages/edit.blade.php`
  - صفحة تعديل الباقة
  - نموذج مع البيانات الحالية
  - معاينة الصورة قبل التحميل
  - إمكانية تغيير الفئة

### 3. Controller
- **الملف**: `app/Http/Controllers/Admin/Educational/PackageController.php`
- **الدوال المضافة**:
  - `index()` - عرض جميع الباقات
  - `create()` - عرض صفحة الإنشاء
  - `store()` - حفظ باقة جديدة
  - `show()` - عرض تفاصيل الباقة
  - `edit()` - عرض صفحة التعديل
  - `update()` - تحديث الباقة
  - `destroy()` - حذف الباقة
  - `toggleStatus()` - تبديل حالة الباقة
  - `duplicate()` - نسخ الباقة
  - `bulkAction()` - إجراءات جماعية
  - `export()` - تصدير الباقات

### 4. Model
- **الملف**: `app/Models/Package.php`
- **الحقول المحدثة**:
  - `name` - اسم الباقة
  - `title` - عنوان الباقة
  - `description` - وصف الباقة
  - `category_id` - معرف الفئة
  - `price` - السعر
  - `currency` - العملة
  - `discount_percentage` - نسبة الخصم
  - `is_active` - نشط
  - `status` - الحالة
  - `image` - الصورة

### 5. Migration
- **الملف**: `database/migrations/2025_01_27_000000_add_missing_fields_to_packages_table.php`
- **الحقول المضافة**:
  - `name` (string, nullable)
  - `currency` (string, default: 'USD')
  - `status` (string, default: 'active')
  - `image` (string, nullable)

## الميزات المتاحة

### 1. إدارة الباقات
- ✅ إنشاء باقة جديدة
- ✅ عرض جميع الباقات
- ✅ عرض تفاصيل الباقة
- ✅ تعديل الباقة
- ✅ حذف الباقة

### 2. إدارة الفئات
- ✅ ربط الباقة بفئة محددة
- ✅ عرض الفئة المرتبطة بالباقة
- ✅ تغيير فئة الباقة

### 3. إدارة الدورات
- ✅ ربط الدورات بالباقة
- ✅ عرض الدورات المرتبطة
- ✅ إزالة الدورات من الباقة

### 4. إدارة الطلاب
- ✅ عرض الطلاب المسجلين في الباقة
- ✅ إحصائيات التسجيل

### 5. الميزات الإضافية
- ✅ تبديل حالة الباقة (نشط/غير نشط)
- ✅ نسخ الباقة
- ✅ البحث في الباقات
- ✅ فلترة حسب الحالة
- ✅ تصدير الباقات إلى CSV
- ✅ إجراءات جماعية (حذف، تفعيل، إلغاء تفعيل)

### 6. واجهة المستخدم
- ✅ تصميم متجاوب
- ✅ رسائل النجاح والأخطاء
- ✅ معاينة الصور
- ✅ تأكيد الحذف
- ✅ التنقل السلس بين الصفحات

## كيفية الاستخدام

### 1. الوصول للنظام
```
http://your-domain/admin/educational-packages
```

### 2. إنشاء باقة جديدة
1. انقر على "Create New Package"
2. املأ النموذج بالبيانات المطلوبة
3. اختر الدورات المراد ربطها بالباقة
4. انقر على "Save"

### 3. تعديل باقة موجودة
1. من صفحة الباقات، انقر على أيقونة التعديل
2. قم بتعديل البيانات المطلوبة
3. انقر على "Update Package"

### 4. حذف باقة
1. من صفحة الباقات، انقر على أيقونة الحذف
2. أكد الحذف في النافذة المنبثقة

### 5. تصدير الباقات
1. من صفحة الباقات، انقر على "Export"
2. سيتم تحميل ملف CSV يحتوي على جميع الباقات

## المتطلبات
- Laravel 8+
- PHP 7.4+
- قاعدة بيانات MySQL/PostgreSQL
- Bootstrap 5
- Font Awesome

## التثبيت
1. تأكد من تشغيل الـ migrations:
```bash
php artisan migrate
```

2. تأكد من وجود الصلاحيات المناسبة للمجلدات:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

3. إنشاء رابط رمزي للتخزين:
```bash
php artisan storage:link
```

## ملاحظات مهمة
- تأكد من وجود دورات نشطة قبل إنشاء الباقات
- الصور يتم حفظها في مجلد `storage/app/public/packages`
- يمكن تخصيص العملات المتاحة في الـ Controller
- النظام يدعم التعددية اللغوية (يمكن إضافة ترجمات)

## الدعم
لأي استفسارات أو مشاكل، يرجى التواصل مع فريق التطوير. 