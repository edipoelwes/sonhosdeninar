<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('sales', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('user_id');
         $table->unsignedBigInteger('client_id');
         $table->decimal('discount', 10, 2)->default(0);
         $table->decimal('total_price', 10, 2)->default(0);
         $table->integer('status')->nullable()->comment('1 => Confirmado, 2 => Pendente, 3 => Cancelado');
         $table->integer('payment_method')->nullable()->comment('1 => Boleto bancário, 2 => Cartão de credito, 3 => Transferência bancaria, 4 => Dinheiro');
         $table->text('description')->nullable();
         // $table->string('month_year')->default(strval(date('m/Y', strtotime(now()))));
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('user_id')->references('id')->on('users');
         $table->foreign('client_id')->references('id')->on('clients');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('sales');
   }
}
