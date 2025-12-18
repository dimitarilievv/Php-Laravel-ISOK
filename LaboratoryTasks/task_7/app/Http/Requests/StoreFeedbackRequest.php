<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => ['required', 'exists:courses,id'],
            'author_name' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string'],
            'score' => ['required', 'integer', 'between:1,10'],
        ];
    }
}

