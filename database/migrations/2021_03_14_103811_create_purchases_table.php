<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('purchases', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('user_id');
         $table->unsignedBigInteger('provider_id');

         $table->integer('status')->nullable();
         $table->integer('payment_method')->nullable();
         $table->text('obs')->nullable();
         $table->date('due_date')->nullable();         //provider = fornecedor
         $table->decimal('total', 10, 2)->default(0);

         // $table->string('month_year')->default(strval(date('m/yy', strtotime(now()))));
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('user_id')->references('id')->on('users');
         $table->foreign('provider_id')->references('id')->on('providers');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('purchases');
   }
}
