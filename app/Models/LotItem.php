<?php

namespace App\Models;

use App\Models\Traits\{GetAttributes, SetAttributes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class LotItem extends Model
{
   use HasFactory, SoftDeletes, GetAttributes, SetAttributes;

   public $timestamps = false;

   protected $fillables = [
      'lot_id',
      'company_id',
      'product_id',
      'price',
      'amount'
   ];

   public function lot()
   {
      return $this->belongsTo(Lot::class);
   }

   public function product()
   {
      return $this->belongsTo(Product::class);
   }
}
