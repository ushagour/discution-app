<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->text('role')->nullable();
            $table->bigInteger('point')->default(50);
            $table->string('facebook')->nullable();
            $table->string('github')->nullable();
            $table->string('google')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('about')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');// ->onDelete('cascade') on delete cascade pour supprimer les lien entre table category and posts 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
