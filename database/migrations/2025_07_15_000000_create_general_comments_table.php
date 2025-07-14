<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('general_comments', function (Blueprint $table) {
            $table->id();
            $table->string('commentable_type');
            $table->unsignedBigInteger('commentable_id');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->text('comment');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('general_comments');
    }
}; 