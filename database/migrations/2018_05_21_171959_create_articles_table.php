<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration 
{
	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('body');
            $table->string('author')->index();
            $table->integer('view_count')->unsigned()->default(0);
            $table->string('url')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('articles');
	}
}
