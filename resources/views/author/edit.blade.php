@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit author</div>
                <div class="card-body">
                    <form method="POST" action="{{route('author.update', [$author->id])}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Author Name:</label>
                            <input type="text" class="form-control" name="author_name" value="{{old('author_name', $author->name)}}">
                            <small class="form-text text-muted">Please edit authors name</small>
                        </div>
                        <div class="form-group">
                            <label>Author Surname:</label>
                            <input type="text" class="form-control" name="author_surname" value="{{old('author_surname', $author->surname)}}">
                            <small class="form-text text-muted">Please edit authors surname</small>
                        </div>
                        <div class="form-group">
                            <label>Author Portret:</label>
                            <img style="width: 100px; height: 150px; display: block; margin: 0 auto;" src="{{$author->portret}}" onerror="this.src='{{ asset('img/default.jpg') }}'">
                            <input type="file" class="form-control" name="author_portret">
                            <small class="form-text text-muted">Please upload portret</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection