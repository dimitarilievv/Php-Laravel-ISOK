<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'difficulty_level' => ['required', 'in:beginner,intermediate,advanced'],
            'price' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}

