<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('audio')->nullable();
            $table->string('image')->nullable();
            $table->string('users')->nullable();
            $table->boolean('anonymes')->nullable();
            $table->string('status')->nullable();
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->bigInteger('arrondissement_id')->nullable();
            $table->foreign('arrondissement_id')->references('id')->on('arrondissements')->onDelete('cascade');
            $table->bigInteger('commune_id')->nullable();
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade');
            $table->bigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('problems');
    }
}
