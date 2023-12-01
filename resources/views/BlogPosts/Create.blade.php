<x-layout>
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Add a Blog Post</div>
                        <div class="card-body">

                            <form method="post" action="{{ route('blogposts.store') }}" >
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control" name="content" rows="10" placeholder="Add the content of the Blog Post">{{ old('content') }}</textarea>
                                    @error('content')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Create Blog Post</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary ml-4">Back</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
