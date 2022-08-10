<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [
        'id'
    ];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    public function getRouteKeyName(){
        return 'id';
    }
}
