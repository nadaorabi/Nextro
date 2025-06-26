# Unified Styling for Admin Show Pages

## Overview
تم توحيد التنسيقات بين صفحتي عرض الطالب والمعلم لتطابق بعضهما البعض تماماً مع الحفاظ على جميع الأحجام والوظائف الأصلية.

## الملفات المحدثة

### 1. ملف CSS الموحد
- **الموقع**: `public/css/admin-show-pages.css`
- **الوصف**: يحتوي على جميع التنسيقات المشتركة بين صفحتي الطالب والمعلم

### 2. صفحة الطالب
- **الموقع**: `resources/views/admin/accounts/Student/show.blade.php`
- **التغييرات**:
  - إضافة رابط لملف CSS الموحد
  - إزالة التنسيقات المكررة
  - استخدام class `password-field` لحقل كلمة المرور
  - إضافة ملف partial للمودالات

### 3. صفحة المعلم
- **الموقع**: `resources/views/admin/accounts/teacher/show.blade.php`
- **التغييرات**:
  - إضافة رابط لملف CSS الموحد
  - إزالة التنسيقات المكررة
  - استخدام class `password-field` لحقل كلمة المرور
  - إضافة ملف partial للمودالات
  - **تحديث كامل**: تطابق التصميم مع صفحة الطالب بالضبط

### 4. ملفات Partial للمودالات
- **الطالب**: `resources/views/admin/accounts/Student/partials/modals.blade.php`
- **المعلم**: `resources/views/admin/accounts/teacher/partials/modals.blade.php`

## التنسيقات الموحدة

### Custom Cards
- `.custom-card`: البطاقات المخصصة
- `.custom-card-header`: رؤوس البطاقات
- `.custom-card-body`: محتوى البطاقات

### Tables
- `.custom-table`: الجداول المخصصة
- `.custom-table-responsive`: الجداول المتجاوبة
- `.custom-table th`: رؤوس الجداول
- `.custom-table td`: خلايا الجداول

### Badges
- `.badge-custom`: البادجات المخصصة
- `.badge-paid`, `.badge-unpaid`: بادجات الدفع
- `.badge-user`, `.badge-admin`: بادجات المستخدمين

### Buttons
- `.btn-attendance`: أزرار الحضور
- `.btn-main`: الأزرار الرئيسية
- `.filter-btn`: أزرار التصفية
- `.filter-input`: حقول التصفية

### Statistics Boxes
- `.stats-box`: صناديق الإحصائيات
- `.stats-icon`: أيقونات الإحصائيات
- `.stats-title`, `.stats-value`, `.stats-desc`: عناصر الإحصائيات

### Modals
- `.modal-lg .modal-content`: المودالات الكبيرة
- `.modal-header`: رؤوس المودالات

### Responsive Design
- دعم كامل للأجهزة المحمولة
- تحسين العرض للشاشات الصغيرة
- تحسين أحجام الخطوط والأزرار

## المزايا

1. **التطابق التام**: صفحة المعلم تطابق صفحة الطالب بالضبط
2. **تقليل التكرار**: إزالة التنسيقات المكررة من الصفحات
3. **سهولة الصيانة**: تحديث التنسيقات من مكان واحد
4. **التناسق**: مظهر موحد بين جميع الصفحات
5. **الأداء**: تحسين سرعة التحميل
6. **قابلية التوسع**: سهولة إضافة صفحات جديدة

## الاستخدام

### إضافة ملف CSS لصفحة جديدة
```html
<link rel="stylesheet" href="{{ asset('css/admin-show-pages.css') }}">
```

### استخدام التنسيقات
```html
<!-- بطاقة مخصصة -->
<div class="custom-card">
  <div class="custom-card-header">
    <span>العنوان</span>
  </div>
  <div class="custom-card-body">
    المحتوى
  </div>
</div>

<!-- جدول مخصص -->
<div class="custom-table-responsive">
  <table class="custom-table">
    <!-- محتوى الجدول -->
  </table>
</div>

<!-- بادج مخصص -->
<span class="badge-custom badge-admin">الإدارة</span>

<!-- زر الحضور -->
<button class="btn btn-attendance">
  <i class="fas fa-calendar-check"></i> عرض الحضور
</button>

<!-- زر رئيسي -->
<button class="btn btn-main">
  <i class="fas fa-plus"></i> إضافة
</button>
```

## الحفاظ على الأحجام

تم الحفاظ على جميع الأحجام الأصلية:
- أحجام الخطوط
- أحجام الأزرار
- أحجام البطاقات
- أحجام الجداول
- المسافات والهوامش

## التطابق بين الصفحات

### العناصر المتطابقة:
1. **Class Schedule**: جدول الحصص مع زر الطباعة
2. **Statistics Boxes**: صناديق الإحصائيات الثلاثة
3. **Transaction History**: جدول المعاملات مع فلاتر السنة والشهر
4. **Action Buttons**: أزرار الحذف والتعديل والعودة
5. **Modals**: جميع المودالات بنفس التصميم
6. **Styling**: جميع التنسيقات والألوان متطابقة

### الوظائف المتطابقة:
1. **Print Schedule**: طباعة جدول الحصص
2. **Year Filter**: تصفية المعاملات حسب السنة
3. **Password Toggle**: إظهار/إخفاء كلمة المرور
4. **Modal Functionality**: جميع وظائف المودالات
5. **Responsive Design**: التجاوب مع جميع الشاشات

## التحديثات المستقبلية

لإضافة تنسيقات جديدة:
1. إضافتها إلى ملف `admin-show-pages.css`
2. اختبارها على جميع الصفحات
3. التأكد من التوافق مع الأجهزة المحمولة
4. التأكد من التطابق بين صفحتي الطالب والمعلم
5. تحديث هذا الملف التوثيقي 