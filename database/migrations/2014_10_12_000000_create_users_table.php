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
            $table->string('name');
            $table->string('password');
            $table->string('profile')->nullable();
            $table->string('phone')->unique();
            $table->boolean('phoneVerified')->nullable();
            $table->string('userId')->unique()->nullable();
            $table->boolean('active')->default(true);
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('permission_id')->default('4');
            $table->string('birthDay')->nullable();
            $table->string('referral')->nullable();
            $table->string('referralUser')->nullable();
            $table->string('token')->nullable();
            $table->rememberToken();
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
