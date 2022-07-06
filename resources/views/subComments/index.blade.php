@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                <p>You have a error</p>
            </ul>
        </div>
    @endif
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                data-whatever="@getbootstrap">Create SubComment
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('subcomment.store')}}" method="post">
                            @csrf

                            <div>
                                <select name="commentId" id="">
                                    @foreach($comments as $comment)
                                        <option value="{{$comment->id}}">{{$comment->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">SubComment:</label>
                                <input type="text" class="form-control" id="recipient-name" name="description">
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <div class="container">
        <div class="row">
            <ul class="list-group">
                @foreach ($subComments as $subComment)
                    <li class="list-group-item " data-value="{{$subComment->id}}">{{ $subComment->description }}
                    {{--                        <i class="bi bi-trash category" style="float: right" data-value="{{$category->id}}"></i>--}}
                    {{--                        <a href="{{route('category.edit',$category->id)}}" style="float: right">edit</a></li>--}}
                @endforeach
            </ul>
        </div>

    </div>

    {{ $subComments->links('pagination::bootstrap-4') }}
@endsection
