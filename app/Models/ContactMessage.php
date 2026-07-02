<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_REPLIED = 'replied';
    public const STATUS_CLOSED = 'closed';

    public const METHOD_PHONE = 'phone';
    public const METHOD_EMAIL = 'email';
    public const METHOD_WHATSAPP = 'whatsapp';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'preferred_contact_method',
        'status',
        'admin_notes',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_READ,
            self::STATUS_REPLIED,
            self::STATUS_CLOSED,
        ];
    }

    public static function contactMethods(): array
    {
        return [
            self::METHOD_PHONE,
            self::METHOD_EMAIL,
            self::METHOD_WHATSAPP,
        ];
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->latest();
    }

    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }
}