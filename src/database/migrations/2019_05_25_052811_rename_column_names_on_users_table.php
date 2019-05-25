<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnNamesOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('github_id', 'social_id'); //カラムリネーム
            $table->renameColumn('comment', 'social'); //カラムリネーム
            $table->string('image_path')->nullable();  //カラム追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('social_id', 'github_id');
            $table->renameColumn('social', 'comment');
            $table->dropColumn('image_path');
        });
    }
}
