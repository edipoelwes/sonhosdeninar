<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Adress extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = [
      'company_id',
      'client_id',
      'zipcode',
      'street',
      'number',
      'complement',
      'neighborhood',
      'state',
      'city',
   ];

   public function client()
   {
      return $this->belongsTo(Client::class);
   }
}
