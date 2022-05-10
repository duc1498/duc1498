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
    public function up()      //up:tao ra cau truc cua bang 
    {
        Schema::create('posts', function (Blueprint $table) {  //tao cau truc doi tuong cua bang
            $table->id();                           //tao 1 ten cot la id tang dan
            $table->timestamps();                  //khi nao bang du lieu tao ra khi nao update
            $table->string('title')->nullable();   //nullable: cho phep nguoi dung chua nhap vao
            $table->text('body')->nullable();      //tao them bang body
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()  // xoa bang
    {
        Schema::dropIfExists('posts');
    }
}
