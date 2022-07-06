@extends('welcome')

@section('posts')

    {{--    <div class="card-group" style="display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;">
            <div class="card">
                <img class="card-img-top" src="{{asset('storage/images/'.$post->category->id .'/'. $post->image) }}" alt="Card image cap">
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


        </div>--}}

    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0"
               href="#{{--https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details--}}">Post</a>
            {{--        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>--}}
            {{--        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>--}}
            {{--        <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>--}}
        </nav>
        <hr class="mt-0 mb-">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Post Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2"
                             src="{{asset('storage/images/'.$post->category_id .'/'. $post->image) }}" alt=""
                             style="height: 200px;width: 200px;">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <button class="btn btn-primary" type="button">Upload new image</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Post Title</label>
                                <input class="form-control" id="inputUsername" type="text"
                                       placeholder="Enter your username" value="{{$post->title}}">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Tags Count</label>
                                    <div>
                                        <small>{{$post->tags_count}}</small>

                                    </div>
                                    {{--                                <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="Valerie">--}}
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Comments Count</label>
                                    <div>
                                        <small>{{$post->comments_count}}</small>

                                    </div>
                                </div>
                            </div>
                            {{--                        <!-- Form Row        -->--}}
                            {{--                        <div class="row gx-3 mb-3">--}}
                            {{--                            <!-- Form Group (organization name)-->--}}
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <label class="small mb-1" for="inputOrgName">Organization name</label>--}}
                            {{--                                <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="Start Bootstrap">--}}
                            {{--                            </div>--}}
                            {{--                            <!-- Form Group (location)-->--}}
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <label class="small mb-1" for="inputLocation">Location</label>--}}
                            {{--                                <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                {{--                            <label class="small mb-1" for="inputEmailAddress">Email address</label>--}}
                                {{--                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">--}}
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" type="tel"
                                           placeholder="Enter your phone number" value="555-123-4567">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                    <input class="form-control" id="inputBirthday" type="text" name="birthday"
                                           placeholder="Enter your birthday" value="06/10/1988">
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="button">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <section class="gradient-custom">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4 pb-2">Comments</h4>

                            <div class="row">
                                <div class="col">

                                    @foreach ($post->comments as $comment)
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
                                                        <span class="small demo" style="cursor:pointer;"
                                                              data-value="{{$comment->id}}" data-toggle="modal"
                                                              data-target="#exampleModal"> Reply</span>
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









    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <p>You have a error</p>
                </ul>
            </div>
        @endif
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






    <style>
        body {
            margin-top: 20px;
            background-color: #f2f6fc;
            color: #69707a;
        }

        .img-account-profile {
            height: 10rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control, .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .gradient-custom {
            background: #4facfe;
            background: -webkit-linear-gradient(to bottom right, rgba(79, 172, 254,
            1), rgba(0, 242, 254, 1));
            background: linear-gradient(to bottom right, rgba(79, 172, 254, 1), rgba(0,
            242, 254, 1))
        }
    </style>


    <script>
        $(document).ready(function (){
            $(".demo").click(function () {
                alert(54654654);
                let id = $(this).attr('data-value');
                $("#commentID").val(id)
            })
        })
    </script>
@endsection
