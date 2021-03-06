<?php

namespace App\Models;

use App\Models\Traits\{GetAttributes, SetAttributes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Company extends Model
{
   use HasFactory, SoftDeletes, GetAttributes, SetAttributes;

   protected $fillable = [
      'social_name',
      'alias_name',
      'document_company',
      'document_company_secondary',
      'zipcodeer',
      'zipcode',
      'street',
      'number',
      'complement',
      'neighborhood',
      'state',
      'city',
   ];
}
