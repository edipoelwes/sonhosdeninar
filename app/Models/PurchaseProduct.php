<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PurchaseProduct extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = [
      'company_id',
      'purchase_id',
      'product_id',
      'amount',
      'subtotal',
   ];

   public function getSubTotalAttribute($value)
   {
      return $value ? number_format($value, 2, ',', '.') : '0,00';
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
