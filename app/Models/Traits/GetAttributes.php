<?php

namespace App\Models\Traits;

trait GetAttributes
{

   public function getCpfAttribute($value)
   {
      return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
   }

   public function getCnpjAttribute($value)
   {
      return substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, 12, 2);
   }

   public function getPhoneAttribute($value)
   {
      if (!$value) {
         return null;
      }

      return '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 5) . ' - ' . substr($value, 7, 9);
   }

   public function getPriceAttribute($value)
   {
      return floatval($value);
   }

   public function getDiscountAttribute($value)
   {
      return money_br($value);
   }

   // public function getCategoryAttribute($value)
   // {
   //    return ucwords($value);
   // }

   public function getPurchaseDateAttribute($value)
   {
      return date('d/m/Y', strtotime($value));
   }

   public function getPaymentMethodAttribute(int $value): string
   {
      switch ($value) {
         case 1:
            return 'Boleto Bancário';
            break;
         case 2:
            return 'Cartão de credito';
            break;
         case 3:
            return 'Transferência Bancaria';
            break;
         case 4:
            return 'Dinheiro';
            break;
         default:
            return '';
      }
   }

   public function getStatusAttribute(int $value): string
   {
      switch ($value) {
         case 1:
            return 'Faturado';
            break;
         case 2:
            return 'Pendente';
            break;
         default:
            return 'Cancelado';
      }
   }
}
