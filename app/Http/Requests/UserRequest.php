<?php

namespace App\Http\Requests;
use App\Rules\UserRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Closure;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required',
            'email'=>'required|email',
            'age' => 'required|numeric|min:18',
            'city' => ['required',function (string $attribute, mixed $value, Closure $fail): void
            {
                if(strtoupper($value)!== $value){
                    $fail('The :attribute must be in Uppercase');
                }
            } ]       ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>':attribute is Required',
            'email.required'=>':attribute is Required',
            'email.email'=>':attribute must be a valid and unique Email address',
            'age.required'=>':attribute is Required',
            'age.numeric'=>':attribute should be a number',
            'age.min'=>':attribute must be greater than 18 year old',
            'city.required'=>':attribute is required',
            'city.alpha'=>' :attribute must be in letters'  
              ];
    }
    public function attributes(): array
    {
        return [
            'name'=> 'User Name',
            'email'=>'User Email',
            'age' => 'User Age',
            'city' => 'User City'        ];
    }
    // protected function prepareForValidation():void
    // {
    //     $this->merge([
    //         'city'=>strtoupper($this->city) ,
    //         'name'=>Str::slug($this->name)            

    //     ]);
    // }
    protected $stopOnFirstFailure = true ;
}
