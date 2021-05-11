<?php

namespace App\Models;

use App\Models\Traits\{GetAttributes, SetAttributes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
   use HasFactory, SoftDeletes, GetAttributes, SetAttributes;

   protected $fillable = [
      'company_id',
      'name',
      'cpf',
      'phone',
      'phone_secondary',
      'stars',
      'internal_obs'
   ];

   public function adress()
   {
      return $this->hasOne(Adress::class);
   }
}
