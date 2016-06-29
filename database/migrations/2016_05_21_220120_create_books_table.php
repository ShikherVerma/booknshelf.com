<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('google_volume_id')->unique();
            $table->string('title');
            $table->string('isbn_10')->nullable();
            $table->string('isbn_13')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('description')->nullable();
            $table->string('publisher')->nullable();
            $table->date('published_date')->nullable();
            $table->integer('page_count')->nullable();
            $table->decimal('google_average_rating')->nullable();
            $table->smallInteger('google_ratings_count')->nullable();
            $table->string('image')->nullable();
            $table->string('language')->nullable();
            $table->string('google_info_link')->nullable();
            $table->timestamps();
            // $table->index(['title', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
