<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_title',
        'user_id',
        'ticket_id',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by'
    ];

    public function ticket(): BelongsTo
    {


        return $this->belongsTo(Ticket::class);
    }
}
