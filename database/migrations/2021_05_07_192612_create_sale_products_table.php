<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('sale_products', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('sale_id');
         $table->unsignedBigInteger('lot_item_id');
         $table->integer('amount');
         $table->timestamps();

         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('sale_id')->references('id')->on('sales');
         $table->foreign('lot_item_id')->references('id')->on('lot_items');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('sale_products');
   }
}
