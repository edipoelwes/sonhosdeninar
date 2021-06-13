<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdressesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('adresses', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('client_id');
         $table->string('zipcode')->nullable();
         $table->string('street')->nullable();
         $table->string('number')->nullable();
         $table->string('complement')->nullable();
         $table->string('neighborhood')->nullable();
         $table->string('state')->nullable();
         $table->string('city')->nullable();

         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')
         ->onDelete('cascade');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('adresses');
   }
}
