<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PurchaseRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return Auth::check();
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      return [
         'payment_method' => 'required',
         'status' => 'required',
         'provider_id' => 'required',
         'amount' => 'required',
         'purchase_date' => 'required',
      ];
   }

   /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
   public function messages()
   {
      return [
         'payment_method.required' => 'Metodo de pagamento é obrigatório!',
         'status.required' => 'Status é obrigatório!',
         'provider_id.required' => 'Fornecedor é obrigatório!',
         'amount.required' => 'Ao menos um item precisa ser selecionado!',
         'purchase_date.required' => 'Data da compra é obrigatória!',
         'quota.required' => 'Campo obrigatório!',
      ];
   }
}
