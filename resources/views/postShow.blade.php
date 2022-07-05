@extends('welcome')

@section('posts')

    <div class="card-group" style="display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;">
        <div class="card">
            <img class="card-img-top" src="{{asset('storage/images/' . $post->image) }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
            </div>

            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    @foreach($post->tags as $tag)
                        <li class="list-group-item">Tags-{{$tag->title}}</li>

                    @endforeach
                </ul>
            </div>


            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">Comments-{{$comment->description}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer">
                <small class="text-muted">Created {{$post->created_at}}</small>
            </div>
        </div>


    </div>


    </div>
@endsection
