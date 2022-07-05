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
                data-whatever="@getbootstrap">Create Tag
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
                        <form action="{{route('tag.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Post Name:</label>
                                <select name="postId" id="">
                                    @foreach($posts as $post)
                                        <option value="{{$post->id}}">{{$post->title}}</option>
                                    @endforeach
                                </select>
                                @error('post_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" >Tag Title:</label>
                                <input type="text" class="form-control" id="recipient-name" name="title">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Tag</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <ul class="list-group">
        @foreach ($tags as $tag)
            <span>Post Id - {{$tag->post_id}}    </span>
            <li class="list-group-item tags_name" data-value="{{$tag->title}}">   {{ $tag->title }}</li>
        @endforeach
    </ul>


    {{ $tags->links('pagination::bootstrap-4') }}
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
        })

    </script>

    <script>
        $(document).ready(function () {
            $('.tags_name').on('click', function () {
                $.get("getPostByTags/" + $(this).data('value'), function( data ) {
                    alert( "Load was performed." );
                });
            });
        });
    </script>
@endsection
