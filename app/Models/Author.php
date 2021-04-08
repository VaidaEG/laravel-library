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
        $file = $request->file('author_portret');
        if (!empty($file)) {
            $name = $file->getClientOriginalName();
            // $name = rand(100000000, 99999999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $name);
            $author->portret = 'http://localhost/php-laravel/laravel-library/public/img/' . $name;
        }
        $author->save();
    }

    public function authorBooksList() 
    {
        return $this->hasMany('App\Models\Book', 'author_id', 'id');
    }
    public function edit(Request $request)
    {
        $file = $request->file('author_portret');
        if (!empty($file)) {
            $name = $file->getClientOriginalName();
            // $name = rand(100000000, 99999999) . '.' . $file->getClientOriginalExtension(); //<-- jeigu norime tureti random nuotraukos varda
            $file->move(public_path('img'), $name);
            $this->portret = 'http://localhost/php-laravel/laravel-library/public/img/' . $name;
        }
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
