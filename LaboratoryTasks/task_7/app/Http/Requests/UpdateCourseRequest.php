<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'category' => ['sometimes', 'required', 'string', 'max:255'],
            'difficulty_level' => ['sometimes', 'required', 'in:beginner,intermediate,advanced'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0.01'],
        ];
    }
}

