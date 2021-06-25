<?php

namespace App\Models;

use App\Models\Traits\{GetAttributes, SetAttributes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Sale extends Model
{
   use HasFactory, SoftDeletes, GetAttributes, SetAttributes;

   protected $fillable = [
      'company_id',
      'user_id',
      'client_id',
      'discount',
      'sale_date',
      'status',
      'payment_method',
      'note'
   ];

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function client()
   {
      return $this->belongsTo(Client::class);
   }

   public function sale_products()
   {
      return $this->hasMany(SaleProduct::class);
   }

   public function recipes()
   {
      return $this->hasMany(Recipe::class);
   }

   public function quotas()
   {
      return $this->hasMany(Quota::class);
   }
}
