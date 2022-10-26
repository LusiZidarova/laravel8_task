<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class Stream extends Model
{
    use HasFactory;
    protected $fillable=['title','description','tokens_price','type_id','date_expiration'];
    protected $table = 'streams';

    public function type(){
        return $this->belongsTo(Type::class,'type_id');
    }
}
