<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('role')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('forget_url')->nullable()->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('register_url')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('forget_at')->nullable()->nullable();
            $table->tinyInteger('gender')->nullable();
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
        Schema::dropIfExists('users');
    }
}
