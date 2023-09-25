<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable(); // Ссылка на родительский комментарий
            $table->string('user_name'); // User Name
            $table->string('email'); // E-mail
            $table->string('home_page')->nullable(); // Home page (необязательное поле)
            $table->text('text'); // Text
            $table->timestamps();
            // Внешний ключ для parent_id, который ссылается на id в той же таблице
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
