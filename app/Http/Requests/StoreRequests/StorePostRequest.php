<?php

namespace App\Http\Requests\StoreRequests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'string', 'in:draft,scheduled,published,failed'],
            'telegram_post_id' => ['nullable', 'string'],
            'post_url' => ['nullable', 'string'],
            'views' => ['nullable', 'integer'],
            'reactions_count' => ['nullable', 'integer'],
            'channel_id' => ['required', 'exists:channels,id'],
        ];
    }
}
