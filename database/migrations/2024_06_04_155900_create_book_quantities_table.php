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
        Schema::create('book_quantities', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->nullable();
            $table->foreignId('book_id')->constrained('books')->onDelete('restrict');
            $table->integer('current_qty')->nullable();
            $table->enum('status', ['activate', 'deactivate'])->default('deactivate');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_quantities');
    }
};
