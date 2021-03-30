<?php

namespace App\Models;

use App\Models\Traits\{GetAttributes, SetAttributes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Purchase extends Model
{
   use HasFactory, SoftDeletes, GetAttributes, SetAttributes;

   protected $fillable = [
      'company_id',
      'user_id',
      'provider_id',
      'status',
      'payment_method',
      'purchase_date',
      'note',
      'quota',
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function provider()
   {
      return $this->belongsTo(Provider::class);
   }

   public function quotas()
   {
      return $this->hasMany(Quota::class);
   }

   public function lot()
   {
      return $this->hasOne(Lot::class);
   }

   public function purchaseProducts()
   {
      return $this->hasMany(PurchaseProduct::class);
   }
}
