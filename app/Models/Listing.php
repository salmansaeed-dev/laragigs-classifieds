<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title','description','tags', 'company', 'website', 'location', 'email'];

    public function scopeFilter($query, array $filters){
        if(isset($filters['tag']) && $filters['tag'] != ''){

            $query->where('tags', 'like', '%'. $filters['tag']. '%');

        }

        if(isset($filters['search']) && $filters['search'] != ''){

            $query->where('title', 'like', '%'. $filters['search']. '%')
                ->orWhere('company', 'like', '%'. $filters['search'] .'%')
                ->orWhere('tags', 'like', '%'. $filters['search']. '%');

        }
    }

    // Relationship to user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
