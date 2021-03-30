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
         $table->unsignedBigInteger('provider_id'); //provider = fornecedor

         $table->integer('status')->nullable()->comment('1 => Confirmado, 2 => Pendente, 3 => Cancelado');
         $table->integer('payment_method')->nullable()->comment('1 => Boleto bancário, 2 => Cartão de credito, 3 => Transferência bancaria, 4 => Dinheiro');
         $table->text('note')->nullable();
         $table->date('purchase_date')->nullable();
         $table->integer('quota')->default(1)->nullable();
         // $table->decimal('total', 10, 2)->default(0);

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
