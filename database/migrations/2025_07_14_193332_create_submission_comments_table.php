<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submission_comments', function (Blueprint $table) {
            $table->id();
            
            // نوع التقديم (واجب أو اختبار)
            $table->enum('submission_type', ['assignment', 'exam']);
            
            // معرف التقديم (رقم الواجب أو الاختبار)
            $table->unsignedBigInteger('submission_id');
            
            // معرف الطالب
            $table->unsignedBigInteger('student_id');
            
            // معرف المدرس
            $table->unsignedBigInteger('teacher_id');
            
            // نص التعليق
            $table->text('comment');
            
            // اسم الملف المرفق (اختياري)
            $table->string('attachment_file')->nullable();
            
            // نوع الملف المرفق
            $table->string('attachment_type')->nullable();
            
            // حجم الملف المرفق
            $table->unsignedBigInteger('attachment_size')->nullable();
            
            // تاريخ التعليق
            $table->timestamp('commented_at')->useCurrent();
            
            $table->timestamps();
            
            // فهارس للبحث السريع
            $table->index(['submission_type', 'submission_id']);
            $table->index(['student_id']);
            $table->index(['teacher_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_comments');
    }
};
