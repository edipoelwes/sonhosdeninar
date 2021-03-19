<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
   const TYPES = ['Boleto Bancário', 'Cartão de credito', 'Transferência Bancaria', 'Dinheiro'];

   public static function all($columns = [])
   {
      return array_obj(self::TYPES);
   }

   // public static function find($type)
   // {
   //    return collect(self::all())->first(fn ($value) => $value == $type);
   // }
}
