<?php

namespace App\Http\Requests\StoreRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChannelRequest extends FormRequest
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
             'telegram_id' => ['required', 'integer'],
            'username' => ['nullable', 'string', 'max:255', 'unique:channels,username,' . $this->channel->id],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'invite_link' => ['nullable', 'string', 'max:255'],
            'discussion_group_id' => ['nullable', 'integer', 'unique:channels,discussion_group_id,' . $this->channel->id],
            'discussion_group_link' => ['nullable', 'string', 'max:255', 'unique:channels,discussion_group_link,' . $this->channel->id],
            'comments_enabled' => ['required', 'boolean'],
            'anti_spam_enabled' => ['required', 'boolean'],
            'ban_on_link_username' => ['required', 'boolean'],
            'banned_usernames' => ['nullable', 'array'],
            'banned_usernames.*' => ['string'],
            'banned_links' => ['nullable', 'array'],
            'banned_links.*' => ['string'],
            'members_count' => ['required', 'integer'],
            'views_total' => ['required', 'integer'],
            'last_synced_at' => ['nullable', 'date'],
            'language' => ['required', 'string', 'max:5'],
            'bot_is_admin' => ['required', 'boolean'],
        ];
    }
}
