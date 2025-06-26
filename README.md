# Nextro - نظام إدارة التعليم الإلكتروني

## نظرة عامة
Nextro هو نظام متكامل لإدارة التعليم الإلكتروني مبني على إطار عمل Laravel، يوفر منصة شاملة لإدارة الدورات التعليمية والباقات والطلاب والمعلمين.

## الميزات الرئيسية

### 👨‍💼 لوحة تحكم المدير
- إدارة الحسابات (طلاب، معلمين، مدراء)
- إدارة الفئات التعليمية
- إدارة الدورات والمواد التعليمية
- إدارة الباقات التعليمية
- نظام الشكاوى والمراسلات
- إدارة المدفوعات والماليات
- نظام الحضور والغياب
- إدارة المرافق والقاعات

### 👨‍🏫 لوحة تحكم المعلم
- عرض الدورات المسندة
- إدارة المواد التعليمية
- متابعة حضور الطلاب
- إدارة الشكاوى
- تحديث الملف الشخصي

### 👨‍🎓 واجهة الطالب
- تصفح الدورات والباقات
- التسجيل في الدورات
- الوصول للمواد التعليمية
- متابعة التقدم الأكاديمي
- التواصل مع المعلمين

## التقنيات المستخدمة

- **Backend**: Laravel 10
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **File Storage**: Laravel Storage
- **Icons**: Font Awesome

## متطلبات النظام

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM (للتطوير)

## التثبيت والتشغيل

### 1. استنساخ المشروع
```bash
git clone [repository-url]
cd Nextro
```

### 2. تثبيت التبعيات
```bash
composer install
npm install
```

### 3. إعداد البيئة
```bash
cp .env.example .env
php artisan key:generate
```

### 4. إعداد قاعدة البيانات
```bash
php artisan migrate
php artisan db:seed
```

### 5. إنشاء رابط التخزين
```bash
php artisan storage:link
```

### 6. تشغيل المشروع
```bash
php artisan serve
npm run dev
```

## هيكل المشروع

```
Nextro/
├── app/
│   ├── Http/Controllers/    # Controllers
│   ├── Models/             # Eloquent Models
│   └── Providers/          # Service Providers
├── resources/views/        # Blade Templates
├── routes/                 # Route Definitions
├── database/              # Migrations & Seeders
└── public/                # Public Assets
```

## الملفات المهمة

- `routes/web.php` - تعريف الراوتس
- `config/filesystems.php` - إعداد نظام الملفات
- `app/Models/` - نماذج قاعدة البيانات
- `resources/views/admin/` - صفحات لوحة التحكم

## المساهمة

نرحب بمساهماتكم! يرجى اتباع الخطوات التالية:
1. Fork المشروع
2. إنشاء branch جديد للميزة
3. Commit التغييرات
4. Push إلى Branch
5. إنشاء Pull Request

## الدعم

للاستفسارات والدعم التقني، يرجى التواصل مع فريق التطوير.

## الترخيص

هذا المشروع مرخص تحت رخصة MIT.

---

**Nextro** - منصة التعليم الإلكتروني المتكاملة 🚀
