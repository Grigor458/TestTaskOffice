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
            <form action="{{route('getPostsByFilter')}}" method="get">

                <div>
                    <ul>
                        Category
                        @foreach($categories as $category)

                            <div class="form-check">

                                <input
                                    name="category_id[]" type="checkbox" value="{{ $category->id }}"
                                    @if (in_array($category->id, explode(',', request()->input('filter.category'))))
                                        checked
                                    @endif
                                >
{{--                                <input class="form-check-input category_name" type="checkbox"--}}
{{--                                       data-value="{{$category->id}}"--}}
{{--                                       id="flexCheckDefault{{$category->id}}" name="category_id">--}}
                                <label class="form-check-label"
                                       for="flexCheckDefault{{$category->id}}">{{$category->title}}  </label>
                            </div>

                        @endforeach
                    </ul>
                </div>
                <div>
                    <ul>
                        Tags
                        @foreach($tags as $tag)

                            <div class="form-check">
                                <input
                                    name="tag_id[]" type="checkbox" value="{{ $tag->id }}"
                                    @if (in_array($tag->id, explode(',', request()->input('filter.tag'))))
                                        checked
                                    @endif
                                >


                                {{--                                <input class="form-check-input tags_name" type="checkbox"--}}
                                {{--                                       id="flexCheckDefault{{$tag->id}}" value="{{$tag->id}}">--}}
                                {{--                                <input type="hidden" value="{{$tag->id}}" id="flexCheckDefault{{$tag->id}}" name="tag_id">--}}
                                <label class="form-check-label"
                                       for="flexCheckDefault{{$tag->id}}">{{ $tag->tag_title }}  </label>
                            </div>
                            {{--<li class="list-group-item tags_name" data-value="{{$tag->id}}">

                            </li>--}}
                        @endforeach
                    </ul>
                </div>

                <button type="submit">Search</button>
            </form>

        </div>
        <div id="demo" style="position: absolute">--}}

        </div>
        <div class="card-group demo" style="display: grid;
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

                if ($(this).is(':checked')) {
                    $(this).attr('value', 'true');
                    $.get("getPostByTags/" + $(this).data('value'), function (data) {
                        console.log(data);
                        $('#demo').html(data);
                    });
                } else {
                    $(this).attr('value', 'false');
                    console.log(55555555);
                }

            });

            $('.category_name').on('click', function () {
                $.get("getPostByCategory/" + $(this).data('value'), function (data) {
                    console.log(data);
                    $('#demo').html(data);
                });
            });

        })
    </script>
@endsection
