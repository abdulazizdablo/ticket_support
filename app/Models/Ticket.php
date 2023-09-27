<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Label;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\Roles;

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

        $query->when($filter_determinator === 'category' && auth()->user()->hasRole(Roles::AGENT), function ($query) {

            return    $query->with('categories:name', 'labels:name')->whereNotNull('agent_id')
                ->selectRaw('group_concat(categories.name order by categories.name asc) as categories_names, tickets.*')->join('category_ticket', 'tickets.id', '=', 'category_ticket.ticket_id')->join('categories', 'categories.id', '=', 'category_ticket.category_id')->groupBy('ticket_id')->orderBy('categories_names')->get();
        });


        $tickets  = $query->when($filter_determinator === 'category', function ($query) {

            $query->with('categories:name', 'labels:name')
                ->selectRaw('group_concat(categories.name order by categories.name asc) as categories_names, tickets.*')->join('category_ticket', 'tickets.id', '=', 'category_ticket.ticket_id')->join('categories', 'categories.id', '=', 'category_ticket.category_id')->groupBy('ticket_id')->orderBy('categories_names');
        }, function (Builder $query) use ($filter_determinator) {

            $query->with('categories:name', 'labels:name')->orderBy($filter_determinator);
        })->get();


        return $tickets;

        /*  if ($filter_determinator === 'category' && auth()->user()->hasRole(Roles::AGENT)) {


            $tickets = $query->with('categories:name', 'labels:name')->whereNotNull('agent_id')
                ->selectRaw('group_concat(categories.name order by categories.name asc) as categories_names, tickets.*')->join('category_ticket', 'tickets.id', '=', 'category_ticket.ticket_id')->join('categories', 'categories.id', '=', 'category_ticket.category_id')->groupBy('ticket_id')->orderBy('categories_names')->get();

            return $tickets;
        } else if ($filter_determinator === 'category') {

            $tickets = $query->with('categories:name', 'labels:name')
                ->selectRaw('group_concat(categories.name order by categories.name asc) as categories_names, tickets.*')->join('category_ticket', 'tickets.id', '=', 'category_ticket.ticket_id')->join('categories', 'categories.id', '=', 'category_ticket.category_id')->groupBy('ticket_id')->orderBy('categories_names')->get();
            return $tickets;
        } else

            return $query->with('categories:name', 'labels:name')->orderBy($filter_determinator)->get();
    }*/
    }
}
