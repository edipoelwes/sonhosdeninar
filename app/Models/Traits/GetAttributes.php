<?php
namespace App\Models\Traits;

trait GetAttributes
{

   public function getCpfAttribute($value)
   {
      return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
   }

   public function getDocumentCompanyAttribute($value)
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
      return $value ? number_format($value, 2, ',', '.') : '0,00';
   }
}
