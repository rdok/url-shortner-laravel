<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortenedUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('shortened_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users');
            $table->text('url');
            $table->string('path');
        });
    }

    public function down()
    {
        Schema::table('shortened_urls', function (Blueprint $table) {
            $table->dropForeign('shortened_urls_author_id_foreign');
        });

        Schema::dropIfExists('shortened_urls');
    }
}
