@extends('welcome')

@section('posts')
    <div>

        <div class="card-group" style="display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;">


            @foreach($posts as $post)
                <div class="card">
                    <img class="card-img-top" src="{{asset('storage/images/'.$post->category->id .'/' . $post->image) }}" alt="Card image cap">
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
                </div>
            @endforeach


        </div>


    </div>
@endsection
