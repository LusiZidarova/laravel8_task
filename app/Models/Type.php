<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stream;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';

    
    public function streams(){
        return $this->hasMany(Stream::class);
    }
}
