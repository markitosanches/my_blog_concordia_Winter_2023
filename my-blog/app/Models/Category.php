<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    static public function categorySelect(){
        $lang = session()->get('localeDB');

        $query = self::select('id',
        DB::raw("(case when category$lang is null then category else category$lang end) as category")
        )
        ->orderBy('category')
        ->get();
        return $query;
    }
}
