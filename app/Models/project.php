<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'slug', 'is_published'];

    // Assegno la relzione con i type al singolare
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
