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
			$table->bigInteger('category_id')->unsigned();
			$table->bigInteger('author_id')->unsigned();
			$table->string('name');
			$table->integer('stock');
			$table->text('description')->nullable();
            $table->timestamps();
			$table->softDeletes();

			// Set foreings id in the table
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
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
