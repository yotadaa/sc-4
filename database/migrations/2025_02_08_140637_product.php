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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name');
            $table->text('description'); // Using text for a longer description
            $table->integer('qty');
            $table->decimal('price', 10, 2); // 10 digits total, 2 decimal places
            $table->string('foto')->nullable(); // Store the image path
            $table->bigInteger('plan_id');
            $table->boolean('checked')->nullable();
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
