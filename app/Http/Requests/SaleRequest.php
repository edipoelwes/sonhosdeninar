<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaleRequest extends FormRequest
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
         'client_id' => 'required',
         'payment_method' => 'required',
         'status' => 'required',
         'amount' => 'required'
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
         'client_id.required' => 'Cliente é obrigatório!',
         'payment_method.required' => 'Metodo de pagamento é obrigatório!',
         'status.required' => 'Status é obrigatório!',
         'amount.required' => 'Ao menos um item precisa ser selecionado!'
      ];
   }
}
