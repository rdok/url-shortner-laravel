<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users');
            $table->text('target');
            $table->string('slug');
        });
    }

    public function down()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->dropForeign('urls_author_id_foreign');
        });

        Schema::dropIfExists('urls');
    }
}
