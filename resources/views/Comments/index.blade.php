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
                        <form action="{{route('subcomment.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="recipient-name">Reply Comment:</label>
                                <input type="hidden" id="commentID" name="commentId">
                                <input type="text" class="form-control" id="recipient-name subcomment" name="description">
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


    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <ul class="list-group">--}}
    {{--                @foreach ($comments as $comment)--}}
    {{--                    <li class="list-group-item " data-value="{{$comment->id}}">{{ $comment->description }}--}}
    {{--                        <i class="bi bi-trash comment" style="float: right" data-value="{{$comment->id}}"></i>--}}
    {{--                        <a href="{{route('comment.edit',$comment->id)}}" style="float: right">edit</a></li>--}}
    {{--                @endforeach--}}
    {{--            </ul>--}}
    {{--        </div>--}}

    {{--    </div>--}}



    {{--    {{ $comments->links('pagination::bootstrap-4') }}--}}









    <section class="gradient-custom">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4 pb-2">Comments</h4>

                            <div class="row">
                                <div class="col">

                                    @foreach ($comments as $comment)
                                        <div class="d-flex flex-start">
                                            <img class="rounded-circle shadow-1-strong me-3"
                                                 src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                                                 alt="avatar" width="65"
                                                 height="65"/>
                                            <div class="flex-grow-1 flex-shrink-1">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="mb-1">
                                                            <span class="small">- 2 hours ago</span></p>
                                                        <span class="small demo" style="cursor:pointer;" data-value="{{$comment->id}}"  data-toggle="modal" data-target="#exampleModal"> Reply</span>
                                                    </div>
                                                    <p class="small mb-0">
                                                        {{$comment->description}}
                                                    </p>
                                                </div>

                                                @foreach($comment->subcomments as $subcomment)
                                                    <div class="d-flex flex-start mt-4">
                                                        <a class="me-3" href="#">
                                                            <img class="rounded-circle shadow-1-strong"
                                                                 src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"
                                                                 alt="avatar"
                                                                 width="65" height="65"/>
                                                        </a>
                                                        <div class="flex-grow-1 flex-shrink-1">
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p class="mb-1">
                                                                        Simona Disa <span
                                                                            class="small">- 3 hours ago</span>
                                                                    </p>
                                                                </div>
                                                                <p class="small mb-0">
                                                                    {{$subcomment->description}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>











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
                    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id"
                               value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Post Name:</label>
                            <select name="categoryId" id="">
{{--                                @foreach($categories as $category)--}}
{{--                                    <option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                                @endforeach--}}
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Post Name:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="postImage">
                                {{--                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="postImage">--}}
                                {{--                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Post</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <style>
        .gradient-custom {
            background: #4facfe;
            background: -webkit-linear-gradient(to bottom right, rgba(79, 172, 254,
            1), rgba(0, 242, 254, 1));
            background: linear-gradient(to bottom right, rgba(79, 172, 254, 1), rgba(0,
            242, 254, 1))
        }
    </style>
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


            $('.demo').on('click', function () {

            })


            $(".demo").click(function () {
                let id = $(this).attr('data-value');
                $("#commentID").val(id)
            })
        })
    </script>
@endsection
