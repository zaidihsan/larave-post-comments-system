<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
     {
        public function up()
        {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('message');
                $table->string('image_path')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->softDeletes($column = 'deleted_at', $precision = 0);
                $table->timestamps();
        
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
      
 };
