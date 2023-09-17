<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Label;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        'status_id',
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

    public function comments(): HasMany
    {

        return $this->hasMany(Comment::class);
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

    public function scopeFilter(Builder $query, string $filter_determinator)
    {



        if ($filter_determinator === 'category') {


            $tickets = auth()->user()->tickets()->with('categories:name', 'labels:name')
                ->selectRaw('group_concat(categories.name order by categories.name asc) as categories_names, tickets.*')->join('category_ticket', 'tickets.id', '=', 'category_ticket.ticket_id')->join('categories', 'categories.id', '=', 'category_ticket.category_id')->groupBy('ticket_id')->orderBy('categories_names')->get();

            return $tickets;
        } else {


            return Ticket::with('categories:name', 'labels:name')->orderBy($filter_determinator)->get();
        }
    }
}
