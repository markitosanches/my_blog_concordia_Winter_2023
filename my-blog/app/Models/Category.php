<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    static public function categorySelect(){
        $query = self::select()
        ->orderBy('category')
        ->get();
        return $query;
    }
}
