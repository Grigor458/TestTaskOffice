@extends('layouts.app')

@section('content')
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{asset('storage/images/'.$post->category->id."/". $post->image) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"> {{$post->title}}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                card's content.</p>
            <div>
                @foreach($post->tags as $tag)
                    <p>Tags-{{$tag->title}}</p>
                @endforeach
            </div>

        </div>
    </div>



    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Post Name:</label>
                        <input type="text" class="form-control" id="recipient-name" name="title"
                               value="{{$post->title}}">
                    </div>
                    <input type="hidden" value="{{$post->category_id}}" name="categoryId">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
