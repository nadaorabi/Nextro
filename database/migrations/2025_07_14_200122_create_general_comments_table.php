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
        Schema::create('general_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('commentable_type'); // 'assignment' or 'exam'
            $table->unsignedBigInteger('commentable_id'); // assignment_id or exam_id
            $table->text('comment');
            $table->string('attachment_file')->nullable();
            $table->string('attachment_type')->nullable();
            $table->bigInteger('attachment_size')->nullable();
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['commentable_type', 'commentable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_comments');
    }
};
