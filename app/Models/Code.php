<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = ['snippet_id', 'lang_id', 'code', 'hash'];

    public function snippet()
    {
        return $this->belongsTo(Snippet::class);
    }

    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }

    // Custom accessor to get the lang name
    public function getLangNameAttribute()
    {
        return $this->lang ? $this->lang->name : null; // Return the name or null if no lang exists
    }
}
