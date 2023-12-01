<x-layout>
    <div class="container">
        <div class="mx-4">
            <div class="bg-light p-10 rounded">
                <header>
                    <h1 class="h3 text-center font-weight-bold my-6 text-uppercase">  Manage Blogs Posts</h1>
                </header>
                @if(session('message'))
                    <div id ="success-alert" class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($blogposts as $blogpost)
                        <tr>
                            <td class="px-4 py-3">
                                <a href="{{ route('blogposts.show', $blogpost->id) }}">{{ $blogpost->title }}</a>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('blogposts.edit', $blogpost->id) }}" class="btn btn-primary">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('blogposts.destroy', $blogpost->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this post?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">No blog posts available.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $blogposts->links('pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

</x-layout>
