<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_type',
        'submission_id',
        'student_id',
        'teacher_id',
        'comment',
        'attachment_file',
        'attachment_type',
        'attachment_size',
        'commented_at'
    ];

    protected $casts = [
        'commented_at' => 'datetime',
        'attachment_size' => 'integer'
    ];

    /**
     * العلاقة مع الطالب
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * العلاقة مع المدرس
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * العلاقة مع الواجب (إذا كان التعليق على واجب)
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'submission_id');
    }

    /**
     * العلاقة مع الاختبار (إذا كان التعليق على اختبار)
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'submission_id');
    }

    /**
     * الحصول على حجم الملف المرفق بتنسيق مقروء
     */
    public function getFormattedAttachmentSizeAttribute()
    {
        if (!$this->attachment_size) {
            return null;
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->attachment_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * التحقق من وجود مرفق
     */
    public function hasAttachment()
    {
        return !empty($this->attachment_file);
    }
}
