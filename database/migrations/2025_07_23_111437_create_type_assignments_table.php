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
        Schema::create('type_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('type_assignments_type', 255);
            $table->unsignedBigInteger('type_assignments_id');
            $table->string('my_bonus_field', 255);
            $table->foreignId('type_id')->constrained('product_types')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_assignments');
    }
};
