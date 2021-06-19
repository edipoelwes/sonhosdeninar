<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('recipes', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('sale_id');
         $table->string('path')->nullable();

         $table->foreign('sale_id')->references('id')->on('sales');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('recipes');
   }
}
