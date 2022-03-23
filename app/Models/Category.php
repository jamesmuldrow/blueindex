<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get the Commands for the category
     */
    public function commands()
    {
        return $this->hasMany(Command::class);
    }
    
}
