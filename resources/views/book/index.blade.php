@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book list</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($books as $book)
                            <li class="list-group-item list-line">
                                <div class="list-line__books">
                                    <div class="list-line__books__title">
                                        Title: {{$book->title}}; 
                                    </div>
                                    <div class="list-line__books__author">
                                        Author: {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}};
                                    </div>
                                    <div class="list-line__books__author">
                                        ISBN: {{$book->isbn}}
                                    </div>
                                    <div class="list-line__books__author">
                                        About: {!!$book->about!!}
                                    </div>
                                </div>
                                <div class="list-line__buttons">
                                    <a href="{{route('book.show', [$book])}}" class="btn btn-primary">SHOW</a>
                                    <a href="{{route('book.edit', [$book])}}" class="btn btn-primary">EDIT</a>
                                    <form method="POST" action="{{route('book.destroy', [$book])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection