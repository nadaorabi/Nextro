#!/bin/bash

echo ""
echo "========================================"
echo "   إنشاء حساب المدير - Nextro System"
echo "========================================"
echo ""

echo "🚀 جاري تشغيل QuickAdminSeeder..."
php artisan db:seed --class=QuickAdminSeeder

echo ""
echo "✅ تم الانتهاء من إنشاء حساب المدير!"
echo ""
echo "💡 يمكنك الآن تسجيل الدخول باستخدام البيانات المعروضة أعلاه"
echo "" 