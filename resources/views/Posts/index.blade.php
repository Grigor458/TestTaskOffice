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
                data-whatever="@getbootstrap">Create Post
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
                        <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Post Name:</label>
                                <select name="categoryId" id="">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
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
    </div>

    {{-- <div style="display: grid;grid-template-columns: repeat(4, 1fr);gap: 10px;">
         @foreach($posts as $post)
             <div class="card" style="width: 18rem;">
                 <img class="card-img-top" src="{{asset('storage/images/' . $post->image) }}" alt="Card image cap">
                 <div class="card-body">
                     <h5 class="card-title"> {{$post->title}}</h5>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                         card's content.</p>
                     <div><p>Tags-{{$post->tags_count}}</p></div>
                     <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary">Edit Post</a>
                     <i class="bi bi-trash postEdit" style="float: right" data-value="{{$post->id}}"></i>

                 </div>
             </div>
         @endforeach
     </div>--}}



    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('.postEdit').on('click', function () {--}}
    {{--                $.ajax({--}}
    {{--                    headers: {--}}
    {{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--                    },--}}
    {{--                    type: "Delete",--}}
    {{--                    url: 'post/' + $(this).data('value'),--}}
    {{--                    success: function () {--}}
    {{--                        alert('success')--}}
    {{--                    },--}}
    {{--                });--}}
    {{--            })--}}
    {{--        })--}}
    {{--    </script>--}}











    <div class="col-md-10 offset-1">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Post Id</th>
                <th>Post Image</th>
                <th>Post Category</th>
                <th>Post Tags</th>
                <th>Author</th>
                <th>Start description</th>
                <th>Added Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img class="card-img-top" src="{{asset('storage/images/'.$post->category->id .'/'. $post->image) }}"
                             alt="Card image cap"
                             style="width: 50px;height: 50px;"></td>
                    <td>{{$post->category->title}}</td>
                    <td>
                        <ul class="demo">
                            @foreach($post->tags as $tag)
                                <li>{{$tag->title}}
                                    <span>
                                        <i class="bi bi-x-lg tagRemove" style="cursor:pointer;"
                                           data-value="{{$tag->id}}"></i>
                                    </span>
                                </li>

                            @endforeach
                        </ul>
                        <i class="bi bi-plus-circle tagAdd" style="float:right;cursor: pointer" data-toggle="modal" data-id="{{$post->id}}"
                           data-target="#exampleModal2"></i>

                    </td>
                    <td>{{$post->user_id}}</td>
                    <td>{{$post->id}}</td>
                    <td>{{$post->created_at}}</td>
                    <td><a href="{{route('post.edit',$post->id)}}">Edit Post</a></td>
                    <td><i class="bi bi-trash postEdit" style="cursor: pointer" data-value="{{$post->id}}"></i></td>

                </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Post Id</th>
                <th>Post Image</th>
                <th>Post Category</th>
                <th>Post Tags</th>
                <th>Post Added</th>
                <th>Start description</th>
                <th>Added Date</th>
            </tr>
            </tfoot>
        </table>

    </div>





    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <p>You have a error</p>
                </ul>
            </div>
        @endif

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <label for="recipient-name">Tag Title:</label>
                                <input type="text" class="form-control" id="recipient-name" name="title">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="postId" id="postId">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Tag</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <style>
        .demo {
            padding: 0;
            display: flex;
        }

        .demo > li {
            list-style: none;
            padding: 5px 10px;
            border: 1px solid;
            border-radius: 25px;
            background: white;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();

            $(".tagAdd").click(function(){
                let id = $(this).attr('data-id');
                console.log(id,$("#postId"))
                $("#postId").val(id)
            })
        });


        $(document).ready(function () {
            $('.tagRemove').on('click', function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "Delete",
                    url: 'tag/' + $(this).data('value'),
                    success: function ($data) {
                        console.log($data);
                        if ($data) {
                            location.reload(true);
                        }
                    },
                });
            })
        })
    </script>
@endsection
