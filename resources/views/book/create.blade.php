@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add ne book</div>
                <div class="card-body">
                    <form method="POST" action="{{route('book.store')}}">
                        <div class="form-group">
                            <label>Book title:</label>
                            <input type="text" class="form-control" name="book_title">
                            <small class="form-text text-muted">Please enter book title.</small>
                        </div>
                        <div class="form-group">
                            <label>ISBN:</label>
                            <input type="text" class="form-control" name="book_isbn">
                            <small class="form-text text-muted">Please enter book ISBN.</small>
                        </div>
                        <div class="form-group">
                            <label>Pages:</label>
                            <input type="text" class="form-control" name="book_pages">
                            <small class="form-text text-muted">Please enter the number of pages.</small>
                        </div>
                        <div class="form-group">
                            <label>About:</label>
                            <textarea id="summernote" name="book_about"></textarea>
                            <small class="form-text text-muted">Please write about this book.</small>
                        </div>
                        <div class="form-group">
                            <label>Author:</label>
                            <select name="author_id">  
                            @foreach ($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}
                            @endforeach
                            </select>
                            <small class="form-text text-muted">Please select authors name.</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
    $('#summernote').summernote();
});
</script>
@endsection