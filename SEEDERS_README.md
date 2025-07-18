# Seeders Guide - دليل السيدرز

## نظرة عامة
تم تحديث جميع السيدرز لدعم حقل `user_name` الجديد. الآن يمكن للمستخدمين تسجيل الدخول باستخدام `user_name` بدلاً من `login_id`.

## السيدرز المتاحة

### 1. AdminSeeder
**الوصف**: ينشئ حساب إداري افتراضي
**الاستخدام**: `php artisan db:seed --class=AdminSeeder`
**بيانات الدخول**:
- Username: `admin`
- Password: `admin123`
- Email: `admin@admin.com`

### 2. UpdateExistingUsersWithUserName
**الوصف**: يحدث المستخدمين الموجودين بإضافة `user_name` فريد
**الاستخدام**: `php artisan db:seed --class=UpdateExistingUsersWithUserName`
**الميزات**:
- يبحث عن المستخدمين بدون `user_name`
- ينشئ `user_name` فريد بناءً على `login_id` أو الاسم
- يتجنب التكرار تلقائياً

### 3. CompleteDatabaseSeeder
**الوصف**: ينشئ بيانات تجريبية شاملة
**الاستخدام**: `php artisan db:seed --class=CompleteDatabaseSeeder`
**يشمل**:
- 1 إداري
- 3 معلمين
- 5 طلاب
- فئات ودورات وباقات
- تسجيلات وعلاقات

### 4. QuickTestSeeder
**الوصف**: ينشئ بيانات تجريبية سريعة للاختبار
**الاستخدام**: `php artisan db:seed --class=QuickTestSeeder`
**بيانات الدخول**:
- Admin: `admin` / `admin123`
- Teacher: `teacher` / `teacher123`
- Student: `student` / `student123`

### 5. SampleDataSeeder
**الوصف**: ينشئ طلاب تجريبيين مع تسجيلات
**الاستخدام**: `php artisan db:seed --class=SampleDataSeeder`

## كيفية الاستخدام

### إنشاء بيانات جديدة كاملة
```bash
php artisan db:seed
```

### تحديث المستخدمين الموجودين فقط
```bash
php artisan db:seed --class=UpdateExistingUsersWithUserName
```

### إنشاء بيانات تجريبية سريعة
```bash
php artisan db:seed --class=QuickTestSeeder
```

### إنشاء بيانات شاملة
```bash
php artisan db:seed --class=CompleteDatabaseSeeder
```

## بيانات المستخدمين التجريبية

### من CompleteDatabaseSeeder:
- **Admin**: `ahmed_admin` / `12345678`
- **Teachers**: 
  - `sara_teacher` / `12345678`
  - `mohamed_teacher` / `12345678`
  - `fatima_teacher` / `12345678`
- **Students**:
  - `abdullah_student` / `12345678`
  - `fatima_student` / `12345678`
  - `ali_student` / `12345678`
  - `maryam_student` / `12345678`
  - `youssef_student` / `12345678`

### من QuickTestSeeder:
- **Admin**: `admin` / `admin123`
- **Teacher**: `teacher` / `teacher123`
- **Student**: `student` / `student123`

## ملاحظات مهمة

1. **التفرد**: جميع `user_name` فريدة ومتحقق منها
2. **التوافق**: يعمل مع نظام تسجيل الدخول الجديد
3. **الترقية**: يمكن تشغيل `UpdateExistingUsersWithUserName` على البيانات الموجودة
4. **الأمان**: كلمات المرور آمنة ومشفرة

## استكشاف الأخطاء

### إذا لم يتم إنشاء `user_name`:
1. تأكد من وجود حقل `user_name` في قاعدة البيانات
2. شغل: `php artisan migrate`
3. شغل: `php artisan db:seed --class=UpdateExistingUsersWithUserName`

### إذا كان هناك تكرار في `user_name`:
1. السيدر يتعامل مع التكرار تلقائياً
2. يضيف أرقام متسلسلة للتمييز

### إذا لم يعمل تسجيل الدخول:
1. تأكد من تشغيل السيدرز
2. تحقق من وجود `user_name` في قاعدة البيانات
3. جرب إعادة تشغيل السيرفر 