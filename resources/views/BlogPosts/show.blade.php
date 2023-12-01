<x-layout>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Blog</h2>

                <!-- Blog Posts -->

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blogPost->title }}</h5>
                            <p class="card-text">{{ $blogPost->content }}</p>
                            <p class="card-text"><small class="text-muted">Author: {{ $blogPost->author }}</small></p>
                            <p class="card-text"><small class="text-muted">Published on: {{ $blogPost->publishedDate }}</small></p>
                        </div>
                    </div>
                <div class="mb-3">

                    <a href="{{ route('home') }}" class="btn btn-secondary ml-4">Back</a>
                </div>
                <!-- End Blog osts -->

            </div>
        </div>
    </div>
</x-layout>
