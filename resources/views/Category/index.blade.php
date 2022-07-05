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
                data-whatever="@getbootstrap">Create Category
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
                        <form action="{{route('category.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category Name:</label>
                                <input type="text" class="form-control" id="recipient-name" name="title">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <div class="container">
        <div class="row">
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item " data-value="{{$category->id}}">{{ $category->title }}
                        <i class="bi bi-trash category" style="float: right" data-value="{{$category->id}}"></i>
                        <a href="{{route('category.edit',$category->id)}}" style="float: right">edit</a></li>
                @endforeach
            </ul>
        </div>

    </div>

    {{ $categories->links('pagination::bootstrap-4') }}
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

        })


        $(document).ready(function () {
            $('.category').on('click', function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "Delete",
                    url: 'category/' + $(this).data('value'),
                    success: function () {
                        alert('success')
                    },
                });
            })
        })
    </script>
@endsection()
