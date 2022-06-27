<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            // $table->enum('role', ['1'=>'Admin','2'=>'Employee','3'=>'Merchant'])->default(3);
            $table->enum('role', ['1','2','3'])->default(3);
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email',60)->unique();
            $table->string('password',100);
            $table->boolean('status');
            $table->string('profile_img');
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
};
