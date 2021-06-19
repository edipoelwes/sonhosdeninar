<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
   use HasFactory;

   public $timestamps = false;
   protected $fillable = ['sale_id', 'name', 'path'];

   public function sale()
   {
      return $this->belongsTo(Sale::class);
   }
}
