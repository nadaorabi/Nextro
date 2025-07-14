<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'teacher_id',
        'title',
        'description',
        'type',
        'delivery_type',
        'file_path',
        'start_at',
        'end_at',
        'total_grade',
        'general_comment',
        'comment_attachment',
        'comment_attachment_type',
        'comment_attachment_size',
        'commented_at'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'total_grade' => 'decimal:2',
        'commented_at' => 'datetime',
        'comment_attachment_size' => 'integer'
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * العلاقة مع التعليقات على هذا الواجب
     */
    public function comments()
    {
        return $this->hasMany(SubmissionComment::class, 'submission_id')
                    ->where('submission_type', 'assignment');
    }

    /**
     * العلاقة مع التعليقات العامة
     */
    public function generalComments()
    {
        return $this->morphMany(GeneralComment::class, 'commentable');
    }

    /**
     * التحقق من وجود تعليقات عامة
     */
    public function hasGeneralComments()
    {
        return $this->generalComments()->exists();
    }

    /**
     * التحقق من وجود مرفق للتعليق العام
     */
    public function hasCommentAttachment()
    {
        return !empty($this->comment_attachment);
    }

    /**
     * الحصول على حجم المرفق بتنسيق مقروء
     */
    public function getFormattedCommentAttachmentSizeAttribute()
    {
        if (!$this->comment_attachment_size) {
            return null;
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->comment_attachment_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }
}
