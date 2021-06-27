<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class SaleProduct extends Model
{
   use HasFactory, SoftDeletes;

   public $timestamps = false;

   protected $fillable = [
      'company_id',
      'sale_id',
      'lot_item_id',
      'amount',
      'subtotal'
   ];

   public function lot_item()
   {
      return $this->belongsTo(LotItem::class);
   }

   public function sale()
   {
      return $this->belongsTo(Sale::class);
   }
}
