<?php

namespace App\Http\Requests\UpdateRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:articles,slug,' . $this->article->id],
            'author_name' => ['nullable', 'string', 'max:255'],
            'author_url' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'string', 'in:draft,scheduled,published,failed'],
            'telegraph_url' => ['nullable', 'string'],
            'views' => ['nullable', 'integer'],
            'reactions_count' => ['nullable', 'integer'],
            'channel_id' => ['required', 'exists:channels,id'],
        ];
    }
}
