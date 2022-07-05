@extends('layouts.app')

@section('content')
    <form action="{{route('category.update',$category->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Post Name:</label>
                    <input type="text" class="form-control" id="recipient-name" name="title"
                           data-value="{{$category->id}}" value="{{ $category->title }}">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
    </form>

@endsection
