@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Post Detail Card -->
                <div class="card">
                    <!-- Post Image -->
                    <img src="https://via.placeholder.com/800x400?text=Post+Image" class="card-img-top" alt="Post Image">

                    <div class="card-body">
                        <h1 class="card-title">{{ $post->title }}</h1>
                        <p class="card-text">{{ $post->content }}</p>
                        <small class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }}</small>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            @auth
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('comments.store', $post) }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </form>
                    </div>
                </div>
            @endauth

            <!-- Display Comments -->
            <div class="comments">
                @foreach ($post->comments as $comment)
                    <div class="card my-4">
                        <div class="card-body">
                            <p>{{ $comment->content }}</p>
                            <small class="text-muted">Posted by {{ $comment->user->name }} on
                                {{ $comment->created_at->format('F j, Y') }}</small>

                            <!-- Reply Form -->
                            @auth
                                <form method="POST" action="{{ route('comments.reply', $comment) }}">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <textarea class="form-control" name="body" rows="2" placeholder="Reply to this comment" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-secondary mt-2">Reply</button>
                                </form>
                            @endauth
                            @guest
                                <p class="mt-3">
                                    <a href="{{ route('login') }}" class="btn btn-info">Login to Reply</a>
                                </p>
                            @endguest

                            <!-- Display Replies -->
                            @foreach ($comment->replies as $reply)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <p>{{ $reply->content }}</p>
                                        <small class="text-muted">Posted by {{ $reply->user->name }} on
                                            {{ $reply->created_at->format('F j, Y') }}</small>
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
@endsection
