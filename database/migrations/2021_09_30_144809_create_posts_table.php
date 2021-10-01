<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug', 355);
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('published')->default(1)->comment('1=published 2=draft');

            # long definition style for foreign keys
            /**
             *  $table->unsignedBigInteger('category_id')->nullable();
             *  $table->unsignedBigInteger('user_id')->nullable();
             *  $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
             *  $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
             */

            # shortdefinition style for foreign keys
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
