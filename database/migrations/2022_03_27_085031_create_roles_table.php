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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('permission_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};
