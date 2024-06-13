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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('qty_id')->constrained('book_quantities')->onDelete('restrict');
            $table->foreignId('book_id')->constrained('books')->onDelete('restrict');
            $table->boolean('notify')->default(false);
            $table->date('issued_at')->nullable();
            $table->date('due_at')->nullable();
            $table->date('returned_at')->nullable();
            $table->enum('status', ['receive', 'pending', 'reject', 'return'])->default('pending');
            $table->enum('platform', ['online', 'offline'])->default('online');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
