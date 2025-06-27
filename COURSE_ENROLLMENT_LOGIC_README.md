# نظام تسجيل الكورسات والبكجات - Course Enrollment System

## نظرة عامة
تم تطوير نظام متكامل لإدارة تسجيل الطلاب في الكورسات والبكجات مع دعم الخصومات والتحقق من التعارضات.

## الميزات الرئيسية

### 1. تسجيل الكورسات المنفصلة
- **خصم منفصل لكل كورس**: يمكن وضع خصم مختلف لكل كورس على حدة
- **إمكانية الكورس المجاني**: يمكن جعل أي كورس مجاني (خصم 100%)
- **عرض السعر النهائي**: حساب تلقائي للسعر بعد الخصم

### 2. تسجيل البكجات
- **خصم على البكج ككل**: خصم موحد على جميع الكورسات في البكج
- **تصفية حسب الفئة**: عند إنشاء بكج، تظهر فقط الكورسات من الفئة المختارة
- **حساب السعر التلقائي**: حساب مجموع أسعار الكورسات + الخصم

### 3. منع التعارضات
- **منع التكرار**: لا يمكن تسجيل نفس الكورس مرتين
- **منع تعارض البكجات**: لا يمكن تسجيل بكج إذا كان الطالب مسجل في كورسات منفصلة من نفس البكج
- **رسائل تحذير**: إشعارات واضحة عند وجود تعارضات

## كيفية الاستخدام

### إنشاء فئة وكورسات
1. إنشاء فئة (مثل: بكالوريا، تاسع، عاشر)
2. إنشاء كورسات وربطها بالفئة المناسبة
3. تحديد السعر والعملة لكل كورس

### إنشاء بكج
1. اختيار فئة محددة (مثل: تاسع)
2. تلقائياً ستظهر فقط الكورسات من هذه الفئة
3. اختيار الكورسات المطلوبة
4. تحديد نوع الخصم (نسبة مئوية، سعر نهائي، أو بدون خصم)

### تسجيل طالب
1. الذهاب لصفحة الطالب
2. الضغط على "إضافة كورس"
3. اختيار الكورسات المطلوبة مع تحديد خصم لكل كورس
4. اختيار البكجات المطلوبة مع خصم موحد
5. تأكيد التسجيل

## أمثلة عملية

### المثال الأول: تسجيل كورسات منفصلة
```
فئة: بكالوريا
- رياضيات: 200$ (خصم 20% = 160$)
- عربي: 100$ (خصم 50% = 50$)
- علوم: 200$ (بدون خصم = 200$)
المجموع: 410$
```

### المثال الثاني: منع تعارض البكج
```
الطالب مسجل في:
- عربي تاسع (كورس منفصل)
- انجليزي تاسع (كورس منفصل)

عند محاولة تسجيل بكج "مسار تعليمي تاسع" الذي يحتوي على:
- رياضيات تاسع
- عربي تاسع ← تعارض!
- انجليزي تاسع ← تعارض!

النتيجة: رفض التسجيل مع رسالة تحذير
```

## الملفات المعدلة

### Controllers
- `app/Http/Controllers/Admin/Accounts/StudentController.php`
  - `enrollCourse()`: منطق التسجيل مع التحقق من التعارضات
  - `selectCourse()`: عرض صفحة اختيار الكورسات

- `app/Http/Controllers/Admin/Educational/PackageController.php`
  - `create()`: عرض صفحة إنشاء البكج
  - `store()`: حفظ البكج مع حساب السعر

### Views
- `resources/views/admin/accounts/Student/select-course.blade.php`
  - واجهة اختيار الكورسات مع خصم منفصل لكل كورس
  - حساب تلقائي للمجموع

- `resources/views/admin/educational-packages/create.blade.php`
  - تصفية الكورسات حسب الفئة
  - حساب أسعار البكجات

- `resources/views/admin/educational-packages/edit.blade.php`
  - نفس الميزات في صفحة التعديل

### Models
- `app/Models/User.php`: علاقة `studentNotes`
- `app/Models/Package.php`: علاقة `packageCourses`
- `app/Models/PackageCourse.php`: جدول الربط

## قاعدة البيانات

### الجداول المستخدمة
- `categories`: الفئات التعليمية
- `courses`: الكورسات
- `packages`: البكجات
- `package_courses`: ربط الكورسات بالبكجات
- `enrollments`: تسجيل الطلاب في الكورسات
- `student_packages`: تسجيل الطلاب في البكجات
- `payments`: الحركات المالية
- `student_notes`: ملاحظات الطلاب

### العلاقات
```php
// User Model
public function studentNotes() { return $this->hasMany(StudentNote::class, 'student_id'); }
public function enrollments() { return $this->hasMany(Enrollment::class, 'student_id'); }
public function studentPackages() { return $this->hasMany(StudentPackage::class, 'student_id'); }
public function payments() { return $this->hasMany(Payment::class, 'user_id'); }

// Package Model
public function packageCourses() { return $this->hasMany(PackageCourse::class); }
public function courses() { return $this->belongsToMany(Course::class, 'package_courses'); }
```

## JavaScript Features

### تصفية الكورسات حسب الفئة
```javascript
$('select[name="category_id"]').on('change', function() {
    const selectedCategoryId = $(this).val();
    const coursesSelect = $('#coursesSelect');
    
    if (selectedCategoryId) {
        coursesSelect.find('option').hide();
        coursesSelect.find(`option[data-category="${selectedCategoryId}"]`).show();
    } else {
        coursesSelect.find('option').show();
    }
});
```

### حساب السعر مع الخصم
```javascript
function calculateTotal() {
    let total = 0;
    
    // حساب الكورسات مع خصمها الخاص
    document.querySelectorAll('.course-checkbox:checked').forEach(function(checkbox) {
        let price = parseFloat(checkbox.getAttribute('data-price')) || 0;
        let courseId = checkbox.getAttribute('data-id');
        let courseDiscount = parseFloat(document.querySelector(`input[name="course_discounts[${courseId}]"]`).value) || 0;
        let finalPrice = price - (price * courseDiscount / 100);
        total += finalPrice;
    });
    
    // حساب البكجات مع الخصم العام
    let generalDiscount = parseFloat(document.getElementById('discountInput').value) || 0;
    document.querySelectorAll('.package-checkbox:checked').forEach(function(checkbox) {
        let price = parseFloat(checkbox.getAttribute('data-price')) || 0;
        let finalPrice = price - (price * generalDiscount / 100);
        total += finalPrice;
    });
    
    return total;
}
```

## رسائل النظام

### رسائل النجاح
- "تم تسجيل X كورس/باقة بنجاح!"

### رسائل التحذير
- "الكورسات التالية مسجلة مسبقاً: [أسماء الكورسات]"
- "الباقات التالية مسجلة مسبقاً: [أسماء الباقات]"
- "لا يمكن تسجيل الباقات التالية لوجود تعارض: [تفاصيل التعارض]"

## الاختبار

### البيانات التجريبية
تم إنشاء بيانات تجريبية تشمل:
- فئات: بكالوريا، تاسع، عاشر
- كورسات: رياضيات، عربي، علوم، انجليزي
- بكج: مسار تعليمي تاسع
- مستخدمين: admin، student

### تشغيل الاختبار
```bash
php artisan db:seed --class=CompleteDatabaseSeeder
php artisan serve
```

## الأمان والتحقق

### Validation Rules
```php
'courses' => 'nullable|array',
'courses.*' => 'integer|exists:courses,id',
'packages' => 'nullable|array',
'packages.*' => 'integer|exists:packages,id',
'discount' => 'nullable|numeric|min:0|max:100',
'course_discounts' => 'nullable|array',
'course_discounts.*' => 'nullable|numeric|min:0|max:100',
```

### التحقق من التعارضات
```php
// تحقق من تسجيل مسبق في الكورس
$alreadyEnrolled = \App\Models\Enrollment::where('student_id', $student->id)
    ->where('course_id', $courseId)
    ->exists();

// تحقق من تعارض البكج
foreach ($packageCourses as $packageCourse) {
    $alreadyEnrolledInCourse = \App\Models\Enrollment::where('student_id', $student->id)
        ->where('course_id', $packageCourse->id)
        ->exists();
    
    if ($alreadyEnrolledInCourse) {
        $conflicts[] = $packageCourse->title;
    }
}
```

## التطوير المستقبلي

### ميزات مقترحة
1. **خصم على مجموع الكورسات**: خصم إضافي عند تسجيل عدة كورسات
2. **بكجات موسمية**: بكجات بخصومات محدودة زمنياً
3. **نظام النقاط**: تراكم نقاط عند التسجيل
4. **تقارير مالية**: تقارير مفصلة عن الإيرادات والخصومات

### تحسينات تقنية
1. **API endpoints**: لتطبيق موبايل
2. **Webhooks**: لإشعارات خارجية
3. **Caching**: لتحسين الأداء
4. **Queue jobs**: للمعالجة الخلفية 