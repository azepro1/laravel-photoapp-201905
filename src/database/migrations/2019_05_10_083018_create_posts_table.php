<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('path');
            $table->string('nickname');
            $table->string('caption');
            $table->integer('user_id');
            $table->timestamps();

            $table->foreign('user_id') //外部キー
            ->references('id')
            ->on('users')
            ->onDelete('cascade'); // userが削除されたとき、それに関連するpostも一気に削除される
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
