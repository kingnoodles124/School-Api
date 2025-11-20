<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'section' => 'required|string',
            'max_students' => 'required|integer|min:1'
        ];
    }

}
