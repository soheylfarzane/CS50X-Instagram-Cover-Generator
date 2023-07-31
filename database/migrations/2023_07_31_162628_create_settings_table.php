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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->string('banner1');
            $table->string('banner2');
            $table->string('banner3');
            $table->string('banner4');
            $table->string('slogan');
            $table->string('description');
            $table->string('message');
            $table->string('aboutUrl');
            $table->string('siteUrl');
            $table->string('updatedUrl');
            $table->timestamp('updated_at');
            $table->string('version');
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
        Schema::dropIfExists('settings');
    }
};
