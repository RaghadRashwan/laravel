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
        Schema::table('comments', function (Blueprint $table) {

            $table->dropForeign('comments_post_id_foreign');
            $table->dropForeign('comments_user_id_foreign');

            $table->bigInteger('user_id')->unsigned()->nullable()->change();
            $table->bigInteger('post_id')->unsigned()->nullable()->change();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade')->change();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade')->change();
            
           

            
            // $table->foreignId('user_id')
            //     ->nullable()
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->foreignId('post_id')
            //     ->nullable()
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('post_id');
        });
    }
};
