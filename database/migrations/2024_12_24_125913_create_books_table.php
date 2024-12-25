<?php

use App\Models\Book;
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

            $table->tinyText('title');
            $table->tinyText('author');
            $table->text('description');
            $table->unsignedInteger('size');
            $table->enum('category', Book::$category);
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('book_path')->nullable();
            $table->string('title_path')->nullable();

            $table->timestamps();
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
