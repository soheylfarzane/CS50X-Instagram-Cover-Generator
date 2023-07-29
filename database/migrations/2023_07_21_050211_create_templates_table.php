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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->boolean('active')->default(true);
            $table->boolean('font_id');
            $table->boolean('text1');
            $table->boolean('text2')->default(false);
            $table->boolean('text3')->default(false);
            $table->boolean('text4')->default(false);
            $table->boolean('text5')->default(false);
            $table->boolean('longText')->default(false);
            $table->integer('maxText1');
            $table->integer('maxText2')->nullable();
            $table->integer('maxText3')->nullable();
            $table->integer('maxText4')->nullable();
            $table->integer('maxText5')->nullable();
            $table->integer('maxLongText')->nullable();
            $table->boolean('logo')->default(false);
            $table->string('category_id');
            $table->timestamp('expire_at')->nullable();
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
        Schema::dropIfExists('templates');
    }
};
