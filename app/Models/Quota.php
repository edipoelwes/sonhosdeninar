<?php

namespace App\Models;

use App\Models\Traits\{GetAttributes, SetAttributes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Quota extends Model
{
   use HasFactory, SoftDeletes, GetAttributes, SetAttributes;

   public $timestamps = false;

   protected $fillable = [
      'company_id',
      'purchase_id',
      'sale_id',
      'quota',
      'price',
      'due_date'
   ];

   public function purchase()
   {
      return $this->belongsTo(Purchase::class);
   }

   public function sale()
   {
      return $this->belongsTo(Sale::class);
   }
}
