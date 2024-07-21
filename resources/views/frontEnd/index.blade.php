@extends('layouts.app')

@section('content')
    <div class="container mt-4"">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('assets/images/placeholder.webp') }}" class="card-img-top" alt="Placeholder Image">
                        <div class="card-header">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                            <a href="{{ route('post.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Posted on {{ $post->created_at->format('F j, Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
