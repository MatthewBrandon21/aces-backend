<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Celecturer extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('bio', 'like', '%' . $search . '%');
        });
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
