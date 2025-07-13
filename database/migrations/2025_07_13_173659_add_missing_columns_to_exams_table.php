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
        Schema::table('exams', function (Blueprint $table) {
            $table->enum('type', ['manual', 'auto'])->default('manual')->after('description');
            $table->timestamp('start_at')->nullable()->after('type');
            $table->timestamp('end_at')->nullable()->after('start_at');
            $table->decimal('total_grade', 8, 2)->default(0)->after('end_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn(['type', 'start_at', 'end_at', 'total_grade']);
        });
    }
};
