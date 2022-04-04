<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Frontliner extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    protected $hidden = [
        'id',
        'generation_id',
        'created_at',
        'updated_at'
    ];

    protected $with = ['generation'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('bio', 'like', '%' . $search . '%');
        });

        $query->when($filters['generation'] ?? false, function($query, $generation){
            return $query->whereHas('generation', function($query) use ($generation){
                $query->where('slug', $generation);
            });
        });
    }

    public function generation(){
        return $this->belongsTo(Generation::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
