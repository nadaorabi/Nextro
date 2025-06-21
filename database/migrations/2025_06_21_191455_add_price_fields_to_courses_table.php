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
        Schema::table('courses', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->default(0.00)->after('credit_hours');
            $table->string('currency', 10)->default('USD')->after('price');
            $table->decimal('discount_percentage', 5, 2)->default(0.00)->after('currency');
            $table->boolean('is_free')->default(false)->after('discount_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['price', 'currency', 'discount_percentage', 'is_free']);
        });
    }
};
