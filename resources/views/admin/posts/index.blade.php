@extends('partials.adminlay')
@section('content')
<div class="container">
    <h1 class="mb-4">Manage Posts <a href="{{ route('blog.admin.posts.create') }}" class="btn btn-success float-end">New Post</a></h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></td>
                    <td>{{ $post->category?->name ?? '-' }}</td>
                    <td>{{ $post->tags->pluck('name')->implode(', ') }}</td>
                    <td>{{ $post->published_at ? 'Published' : 'Draft' }}</td>
                    <td>
                        <a href="{{ route('blog.admin.posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('blog.admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
</div>
@endsection