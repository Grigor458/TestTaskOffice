@extends('layouts.app')

@section('content')
    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                   <p>You have a error</p>
                </ul>
            </div>
        @endif

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                data-whatever="@getbootstrap">Create Comment
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
                        <form action="{{route('comment.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Post Name:</label>
                                <select name="postID" id="">
                                    @foreach($posts as $post)
                                        <option value="{{$post->id}}">{{$post->title}}</option>
                                    @endforeach
                                </select>

                                @error('post_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="recipient-name">Comment Description:</label>
                                <input type="text" class="form-control" id="recipient-name" name="description">
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
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
                @foreach ($comments as $comment)
                    <li class="list-group-item " data-value="{{$comment->id}}">{{ $comment->description }}
                        <i class="bi bi-trash comment" style="float: right" data-value="{{$comment->id}}"></i>
                        <a href="{{route('comment.edit',$comment->id)}}" style="float: right">edit</a></li>
                @endforeach
            </ul>
        </div>

    </div>



    {{ $comments->links('pagination::bootstrap-4') }}








    <script>
        $(document).ready(function () {
            $('.comment').on('click', function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "Delete",
                    url: 'comment/' + $(this).data('value'),
                    success: function () {
                        alert('success')
                    },
                });
            })
        })
    </script>
@endsection
