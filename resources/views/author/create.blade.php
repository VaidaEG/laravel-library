@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new author</div>
                <div class="card-body">
                    <form method="POST" action="{{route('author.store')}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Author Name:</label>
                            <input type="text" class="form-control" name="author_name" value="{{old('author_name')}}">
                            <small class="form-text text-muted">Please enter new authors name</small>
                        </div>
                        <div class="form-group">
                            <label>Author Surname:</label>
                            <input type="text" class="form-control" name="author_surname" value="{{old('author_surname')}}">
                            <small class="form-text text-muted">Please enter new authors surname</small>
                        </div>
                            <div class="form-group">
                            <label>Author Portret:</label>
                            <input type="file" class="form-control" name="author_portret">
                            <small class="form-text text-muted">Please upload portret</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection