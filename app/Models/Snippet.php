<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    use HasFactory;

    protected $fillable = ['snippet_type_id', 'uid', 'name'];

    public function type()
    {
        return $this->belongsTo(SnippetType::class, 'snippet_type_id');
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    // Custom accessor to get the type name
    public function getTypeNameAttribute()
    {
        return $this->type ? $this->type->name : null; // Return the name or null if no type exists
    }

}