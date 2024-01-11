<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkList extends Model
{
    use HasFactory;

    // new method - proxy to access the links that are related to each other
    public function links(){
        return $this->hasMany(Link::class);
    }
}
