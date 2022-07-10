@extends('welcome')

@section('posts')

    <div class="col-md-4">
        <div class="input-group">
            <input type="search" class="form-control rounded searchAll" placeholder="Search" aria-label="Search"
                   aria-describedby="search-addon"/>
            <button type="button" class="btn btn-outline-primary">search</button>
        </div>
    </div>
    <div style="margin-top: 50px">


        <div style="width: 20%;left: 0;display:inline-block;background: white;z-index: 555">
            <div>
                <ul>
                    Category
                    @foreach($categories as $category)
                        <li value="{{$category->id}}" class="list-group-item category_name"
                            style="cursor: pointer">{{$category->title}}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <ul>
                    Tags
                    @foreach($tags as $tag)
                        <li class="list-group-item tags_name" data-value="{{$tag->title}}">   {{ $tag->title }}</li>
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="card-group" style="display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 10px;">


            @foreach($posts as $post)
                <div class="card">
                    <img class="card-img-top"
                         src="{{asset('storage/images/'.$post->category->id .'/' . $post->image) }}"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                    </div>

                    <div><p>Tags-{{$post->tags_count}}</p></div>
                    <div><p>Comments-{{$post->comments_count}}</p></div>
                    <div class="card-footer">
                        <small class="text-muted">Created {{$post->created_at}}</small>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user())
                        <a href="{{route('post.show',$post->id)}}" class="btn btn-primary">Show Post</a>
                    @endif

                    <div style="display: flex">
                        <span class="likeOrDisslike" data-postId="{{$post->id}}"
                              data-userId="{{Auth::user() ? Auth::user()->id : 'chka'}}"
                              {{ $post->isAuthUserLikedPost() ? "status="."active": ' ' }} data-value="1">Like</span>
                        <span class="likeOrDisslike" data-postId="{{$post->id}}"
                              {{ $post->isAuthUserDissLikedPost() ? "status="."active": ' ' }}
                              data-userId="{{Auth::user() ? Auth::user()->id : 'chka'}}"
                              data-value="0">Dislike

                        </span>
                    </div>
                </div>

            @endforeach


        </div>


    </div>

    <style>
        .likeOrDisslike[status="active"] {
            color: red;
            font-weight: bold;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('.likeOrDisslike').on('click', function () {
                let userId;
                let postId;
                var val;
                var status;
                userId = $(this).attr('data-userId');
                postId = $(this).attr('data-postId');
                val = $(this).attr('data-value');
                status = $(this).attr('status');

                var attr = $(this).attr('status');


                $(this).toggleClass("likeOrDisslike");
                if (typeof attr !== typeof undefined && attr !== false) {
                    $(this).removeAttr('status');
                } else {
                    $(this).attr('status', 'active')
                    // $(this).attr('data-value', '1')
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: '/likeOrDisslike',
                    data: {userId: userId, postId: postId, val: val, status: status},
                    success: function ($data) {
                        console.log($data);
                        $("#likeOrDisslike").load("index.blade.php");
                        if ($data) {

                            // location.reload(true);
                        }
                    },
                });

            })


            $('.searchAll').keypress(function (event) {
                var value = $(this).val();


                if (value.length >= 3) {


                    $.get("searchAll/" + value, function (data) {
                        console.log(data);
                    });

                }
            })


            $('.tags_name').on('click', function () {
                $.get("getPostByTags/" + $(this).data('value'), function (data) {
                    console.log(data);
                });
            });

            $('.category_name').on('click', function () {
                $.get("getPostByCategory/" + $(this).data('value'), function( data ) {
                    console.log(data);
                });
            });

        })
    </script>
@endsection
