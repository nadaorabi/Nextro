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
        Schema::table('course_instructors', function (Blueprint $table) {
            $table->unsignedTinyInteger('percentage')->default(0)->after('instructor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_instructors', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
    }
};
