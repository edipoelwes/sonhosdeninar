<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Hash;

trait SetAttributes
{
   public function setCompanyIdAttribute($value)
   {
      $this->attributes['company_id'] = intval($value);
   }

   public function setCnpjAttribute($value)
   {
      $this->attributes['cnpj'] = $this->clearField($value);
   }

   public function setInscricaoEstadualAttribute($value)
   {
      $this->attributes['inscricao_estadual'] = $this->clearField($value);
   }


   public function setCpfAttribute($value)
   {
      $this->attributes['cpf'] = $this->clearField($value);
   }

   public function setPhoneAttribute($value)
   {
      $this->attributes['phone'] = $this->clearField($value);
   }

   public function setZipcodeAttribute($value)
   {
      $this->attributes['zipcode'] = $this->clearField($value);
   }

   public function setPasswordAttribute($value)
   {
      if (empty($value)) {
         unset($this->attributes['password']);
         return;
      }

      $this->attributes['password'] = Hash::make($value);
   }

   public function setPriceAttribute($value)
   {
      if (empty($value)) {
         $this->attributes['price'] = null;
      } else {
         $this->attributes['price'] = floatval($this->convertStringToDouble($value));
      }
   }

   public function setDiscountAttribute($value)
   {
      if (empty($value)) {
         $this->attributes['discount'] = 0;
      } else {
         $this->attributes['discount'] = floatval($this->convertStringToDouble($value));
      }
   }

   public function setCategoryAttribute($value)
   {
      if (empty($value)) {
         $this->attributes['category'] = null;
      } else {
         $this->attributes['category'] = mb_strtolower($value);
      }
   }

   // public function setStatusAttribute($value)
   // {
   //    if (empty($value)) {
   //       $this->attributes['status'] = null;
   //    } else {
   //       $this->attributes['status'] = intval($value);
   //    }
   // }

   public function setSaleDateAttribute($value)
   {
      if (empty($value)) {
         $this->attributes['sale_date'] = null;
      } else {
         $this->attributes['sale_date'] = $this->convertStringToDate($value);
      }
   }

   private function convertStringToDouble(?string $param)
   {
      if (empty($param)) {
         return null;
      }

      return str_replace(',', '.', str_replace('.', '', $param));
   }

   private function convertStringToDate(?string $param)
   {
      if (empty($param)) {
         return null;
      }

      list($day, $month, $year) = explode('/', $param);
      return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
   }

   private function clearField(?string $param)
   {
      if (empty($param)) {
         return '';
      }

      return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
   }
}
