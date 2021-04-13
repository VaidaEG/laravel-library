@extends('layouts.app')

@section('content')
{{-- <div class="alert alert-info" role="alert" id="mod" style="display: none;">
</div> --}}
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
                        <div class="d-flex justify-content-between align-items-center;">
                            <div class="d-flex justify-content-start;">
                            <button type="submit" class="btn btn-primary mr-2">Filter</button>
                            <a class="btn btn-primary me-2" href="{{route('book.index')}}">Clear filter</a>
                            </div>
                            <div class="d-flex justify-content-start;">
                                <div class="form-check align-self-center mr-2">
                                    <label class="form-check-label">
                                        Sort by title:
                                    </label>
                                </div>
                                <div class="form-check align-self-center mr-2">
                                    <input class="form-check-input" type="radio" name="sort" value="asc" id="sortASC" @if($sortBy == 'asc') checked @endif>
                                    <label class="form-check-label" for="sortASC">
                                        A-Z
                                    </label>
                                </div>
                                <div class="form-check align-self-center">
                                    <input class="form-check-input" type="radio" name="sort" value="desc" id="sortDESC" @if($sortBy == 'desc') checked @endif>
                                    <label class="form-check-label" for="sortDESC">
                                        Z-A
                                    </label>
                                </div>
                            </div>
                        </div>
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
                                    <form method="POST" data-book-id="{{$book->id}}" class="book-delete" action="{{route('book.destroy', [$book])}}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="pagination pagination-sm justify-content-center">{{$books->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection