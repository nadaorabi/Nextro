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
        // إضافة حقول التعليقات لجدول الواجبات
        Schema::table('assignments', function (Blueprint $table) {
            $table->text('general_comment')->nullable()->after('total_grade');
            $table->string('comment_attachment')->nullable()->after('general_comment');
            $table->string('comment_attachment_type')->nullable()->after('comment_attachment');
            $table->unsignedBigInteger('comment_attachment_size')->nullable()->after('comment_attachment_type');
            $table->timestamp('commented_at')->nullable()->after('comment_attachment_size');
        });

        // إضافة حقول التعليقات لجدول الاختبارات
        Schema::table('exams', function (Blueprint $table) {
            $table->text('general_comment')->nullable()->after('total_grade');
            $table->string('comment_attachment')->nullable()->after('general_comment');
            $table->string('comment_attachment_type')->nullable()->after('comment_attachment');
            $table->unsignedBigInteger('comment_attachment_size')->nullable()->after('comment_attachment_type');
            $table->timestamp('commented_at')->nullable()->after('comment_attachment_size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // حذف حقول التعليقات من جدول الواجبات
        Schema::table('assignments', function (Blueprint $table) {
            $table->dropColumn(['general_comment', 'comment_attachment', 'comment_attachment_type', 'comment_attachment_size', 'commented_at']);
        });

        // حذف حقول التعليقات من جدول الاختبارات
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn(['general_comment', 'comment_attachment', 'comment_attachment_type', 'comment_attachment_size', 'commented_at']);
        });
    }
};
