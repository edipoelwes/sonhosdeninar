<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('providers', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->string('name')->nullable();
         $table->string('cnpj')->unique()->nullable();
         $table->string('phone')->nullable();
         $table->string('phone_secundary')->nullable();
         $table->timestamps();
         $table->softDeletes();

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
      Schema::dropIfExists('providers');
   }
}
