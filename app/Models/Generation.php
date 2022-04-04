<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Generation extends Model
{
    use HasFactory, Sluggable;
    
    protected $guarded = ['id'];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function frontliner(){
        return $this->hasMany(Frontliner::class);
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
