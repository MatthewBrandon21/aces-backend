<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagefolder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [
        'user_id'
    ];

    protected $with = ['author'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn($query) => $query->where('username', $author))
        );
    }

    public function getRouteKeyName(){
        return 'id';
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
