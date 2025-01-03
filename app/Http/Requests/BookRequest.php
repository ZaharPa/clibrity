<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:' . implode(',', Book::$category),
            'size' => 'numeric|min:1'
        ];

        if ($this->isMethod('post')) {
            $rules['title_path'] = 'required|file|mimes:jpg,jpeg,png|max:2048';
            $rules['book_path'] = 'required|file|mimes:pdf|max:10240';
        }

        if ($this->isMethod('put')) {
            $rules['title_path'] = 'nullable|file|mimes:jpg,jpeg,png|max:2048';
            $rules['book_path'] = 'nullable|file|mimes:pdf|max:10240';
        }

        return $rules;
    }
}
