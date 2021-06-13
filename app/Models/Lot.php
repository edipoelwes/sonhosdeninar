<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Lot extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = [
      'company_id',
      'purchase_id',
      'lot_number',
   ];

   public function purchase()
   {
      return $this->belongsTo(Purchase::class);
   }

   public function lotItems()
   {
      return $this->hasMany(LotItem::class);
   }
}
