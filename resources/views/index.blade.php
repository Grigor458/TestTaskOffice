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
                        <span class="likeOrDisslike" data-postId="{{$post->id}}"
                              data-userId="{{\Illuminate\Support\Facades\Auth::user()->id}}">Like</span>
                        <span class="likeOrDisslike" data-postId="{{$post->id}}"
                              data-userId="{{\Illuminate\Support\Facades\Auth::user()->id}}">Dislike

                        </span>
                    </div>
                </div>

            @endforeach


        </div>


    </div>



    <script>
        $(document).ready(function () {


            $('.likeOrDisslike').on('click', function () {

                var isActive = true;

                if (isActive = true) {
                    $(this).attr('data-value', 1)
                    isActive = false;
                } else {
                    $(this).attr('data-value', '')
                }

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
