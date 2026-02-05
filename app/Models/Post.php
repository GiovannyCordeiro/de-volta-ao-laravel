<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
