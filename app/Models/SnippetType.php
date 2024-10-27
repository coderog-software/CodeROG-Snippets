<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnippetType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function snippets()
    {
        return $this->hasMany(Snippet::class, 'snippet_type_id');
    }
}
