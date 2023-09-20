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
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('message');
            // Add other columns as needed
            $table->timestamps(); // Add timestamps if required
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
      
 };
