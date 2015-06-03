<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->string('post_title');
            $table->string('post_slug');
            $table->text('post_content');
            $table->boolean('is_published');
            $table->integer('author_id')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE posts ADD FULLTEXT search(post_title, post_content)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
