<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'video', 'description', 'module_id'];

    public function modules()
    {
        return $this->belongsTo(Module::class);
    }
}
