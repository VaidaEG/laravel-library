@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h2>Book list</h2>
                <form action="{{route('book.index')}}" method="get" class="make-inline">
                    <div class="form-group">
                        <label>Author: </label>
                        <select class="form-control" name="author_id">
                            <option value="0" disabled @if($filterBy == 0) selected @endif>Select Author</option>
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}" @if($filterBy == $author->id) selected @endif>
                                    {{$author->name}} {{$author->surname}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a class="btn btn-primary" href="{{route('book.index')}}">Clear filter</a>
                </form>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($books as $book)
                            <li class="list-group-item list-line">
                                <div class="list-line__books">
                                    <div class="list-line__books__title">
                                        Title: {{$book->title}} 
                                    </div>
                                    <div class="list-line__books__author">
                                        Author: {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}};
                                    </div>
                                    <div class="list-line__books__author">
                                        ISBN: {{$book->isbn}}
                                    </div>
                                </div>
                                <div class="list-line__buttons">
                                    <a href="{{route('book.show', [$book])}}" class="btn btn-primary">SHOW</a>
                                    <a href="{{route('book.edit', [$book])}}" class="btn btn-primary">EDIT</a>
                                    <a href="{{route('book.pdf', [$book])}}" class="btn btn-warning">PDF</a>
                                    <form method="POST" action="{{route('book.destroy', [$book])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="pagination justify-content-center">{{$books->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection