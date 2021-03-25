<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotasTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('quotas', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('purchase_id');
         $table->integer('quota')->default(1);
         $table->decimal('price', 10, 2)->default(0);
         $table->date('due_date')->nullable();
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('purchase_id')->references('id')->on('purchases');
         $table->foreign('company_id')->references('id')->on('companies');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('quotas');
   }
}
