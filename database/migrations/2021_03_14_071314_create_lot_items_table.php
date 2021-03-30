<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotItemsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('lot_items', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('lot_id');
         $table->unsignedBigInteger('product_id');
         $table->decimal('price', 10, 2)->default(0);
         $table->integer('amount')->default(0);
         $table->softDeletes();

         $table->foreign('lot_id')->references('id')->on('lots');
         $table->foreign('product_id')->references('id')->on('products');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('lot_items');
   }
}
