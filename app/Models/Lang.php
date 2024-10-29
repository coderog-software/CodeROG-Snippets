<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'ace_mode'];

    protected $hidden = ['created_at', 'updated_at'];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}
