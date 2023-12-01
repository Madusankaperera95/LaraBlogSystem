<x-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Latest Blog Posts</h2>

                <!-- Job Listing Cards -->
                @foreach($blogPosts as $blogpost)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blogpost->title }}</h5>
                            <p class="card-text">
                                {{$blogpost->content }}
                                <a href="{{ route('blogposts.show', $blogpost->id) }}" class="card-link">Read More</a>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Author: {{ $blogpost->author }}</small>
                                <small class="text-muted ml-2">Posted
                                    on: {{ $blogpost->publishedDate }}</small>
                            </p>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center">
                {{ $blogPosts->links('pagination.bootstrap-4') }}
                </div>
                <!-- End Job Listing Cards -->

            </div>
        </div>
    </div>
</x-layout>
