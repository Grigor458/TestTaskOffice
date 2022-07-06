@extends('layouts.app')

@section('content')
    <form action="{{route('comment.update',$comment->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Post Name:</label>
                    <input type="text" class="form-control" id="recipient-name" name="description"
                           data-value="{{$comment->id}}" value="{{ $comment->description }}">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Comment</button>
        </div>
    </form>





@endsection
