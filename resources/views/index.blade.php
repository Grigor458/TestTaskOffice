@extends('welcome')

@section('posts')
    <div>

        <div class="card-group" style="display: grid;
  grid-template-columns: repeat(4, 1fr);
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
                        <span  class="likeOrDisslike" data-postId="{{$post->id}}"
                           data-userId="{{\Illuminate\Support\Facades\Auth::user()->id}}"
                           data-value="1">like
                            {{-- <span data-postId="{{$post->id}}"
                                   data-userId="{{\Illuminate\Support\Facades\Auth::user()->id}}"
                                   data-value="1">like</span>--}}</span>
                        <span class="likeOrDisslike" data-postId="{{$post->id}}"
                           data-userId="{{\Illuminate\Support\Facades\Auth::user()->id}}"
                           data-value="0">Dislike
                            {{-- <span class="likeOrDisslike" data-postId="{{$post->id}}"
                                   data-userId="{{\Illuminate\Support\Facades\Auth::user()->id}}"
                                   data-value="0">Dislike</span>--}}
                        </span>
                    </div>
                </div>

            @endforeach


        </div>


    </div>



    <script>
        $(document).ready(function () {
            $('.likeOrDisslike').on('click', function () {
           /*     var isLike = event.target.previousElementSibling == null;
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '/likeOrDisslike',
                    data: {isLike: isLike,postId}
                })
                console.log(isLike);*/
                let userId;
                let postId;
                var val;
                userId = $(this).attr('data-userId');
                postId = $(this).attr('data-postId');
                val = $(this).attr('data-value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: '/likeOrDisslike',
                    data: {userId: userId, postId: postId, val: val},
                    success: function ($data) {
                        console.log($data);
                        if ($data) {
                            // location.reload(true);
                        }
                    },
                });
            })
        })
    </script>
@endsection
