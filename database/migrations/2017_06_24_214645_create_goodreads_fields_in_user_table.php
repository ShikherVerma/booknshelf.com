<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodreadsFieldsInUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->bigInteger('goodreads_user_id')->nullable();
            $table->string('goodreads_oauth_token')->nullable();
            $table->string('goodreads_oauth_token_secret')->nullable();
            $table->index('goodreads_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('goodreads_user_id');
            $table->dropColumn('goodreads_oauth_token');
            $table->dropColumn('goodreads_oauth_token_secret');
        });
    }
}
