<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'commentable_type',
        'commentable_id',
        'comment',
        'attachment_file',
        'attachment_type',
        'attachment_size'
    ];

    protected $casts = [
        'attachment_size' => 'integer',
    ];

    /**
     * علاقة مع المدرس
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * علاقة مع الواجب أو الاختبار
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * الحصول على حجم الملف المرفق بتنسيق مقروء
     */
    public function getFormattedAttachmentSizeAttribute()
    {
        if (!$this->attachment_size) {
            return null;
        }

        $bytes = $this->attachment_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * التحقق من وجود مرفق
     */
    public function hasAttachment()
    {
        return !empty($this->attachment_file);
    }

    /**
     * الحصول على اسم الملف المرفق
     */
    public function getAttachmentFileNameAttribute()
    {
        if (!$this->attachment_file) {
            return null;
        }

        return basename($this->attachment_file);
    }
}
