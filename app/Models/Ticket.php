<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Label;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'status',
        'files'

    ];



    /**
     * The categories that belong to the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }


    /*protected function FilesAttribute(): Attribute
    {
        return Attribute::make(
            set: fn ( $value) => (array)$value,
            get: fn (array $value) => $value = implode(' ,',$value),
        );


        
    }*/


    public function getFilesAttribute()
    {
        $files = json_decode($this->attributes['files']);

        return implode(', ', $files);
    }

    public function logs(): HasMany
    {

        return $this->hasMany(Log::class);
    }
    protected $casts = [
        'files' => 'array'
    ];
}
