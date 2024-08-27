<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'title', 'owner', 'type', 'size', 'bedrooms',
        'location', 'image', 'price', 'term', 'rent',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
