<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Author extends Model
{
    use HasFactory;
    public static function create(Request $request) 
    {
        $author = new self;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();
    }

    public function authorBooksList() 
    {
        return $this->hasMany('App\Models\Book', 'author_id', 'id');
    }
    public function edit(Request $request)
    {
        $this->name = $request->author_name;
        $this->surname = $request->author_surname;
        $this->save();
    }

    // * Trecias variantas is author kontrolerio *
    // public static function new() 
    // {
    //     return new self;
    // } 
    // public function refreshAndSave(Request $request) 
    // {
    //     $this->name = $request->author_name;
    //     $this->surname = $request->author_surname;
    //     $this->save();
    //     return $this;
    // }
}
