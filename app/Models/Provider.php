<?php

namespace App\Models;

use App\Models\Traits\{GetAttributes, SetAttributes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Provider extends Model
{
   use HasFactory, SoftDeletes, GetAttributes, SetAttributes;

   protected $fillable = [
      'company_id',
      'name',
      'cnpj',
      'phone',
   ];
}
