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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('publisher_id');
            $table->string('isbn')->unique();
            $table->date('publication_date');
            $table->integer('number_of_pages');
            $table->text('summary')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('type', ['popular', 'recent', 'featured', 'recommended'])->default('recent');
            $table->enum('preview', ['active', 'inactive'])->default('inactive');
            $table->string('shelf')->nullable();
            $table->string('row')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('restrict');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
