<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PurchaseProduct extends Model
{
   use HasFactory, SoftDeletes;

   public $timestamps = false;

   protected $fillable = [
      'company_id',
      'purchase_id',
      'product_id',
      'amount',
      'subtotal',
   ];

   public function purchase()
   {
      return $this->belongsTo(Purchase::class);
   }

   public function product()
   {
      return $this->belongsTo(Product::class);
   }

   public function setSubTotalAttribute($value)
   {
      if (empty($value)) {
         $this->attributes['sub_total'] = null;
      } else {
         $this->attributes['sub_total'] = floatval($this->convertStringToDouble($value));
      }
   }

   private function convertStringToDouble(?string $param)
   {
      if (empty($param)) {
         return null;
      }

      return str_replace(',', '.', str_replace('.', '', $param));
   }
}
