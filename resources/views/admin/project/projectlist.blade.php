@extends('partials.adminlay')

@section('title', 'Admin Panel | Project List')

<style>
    .td{
        padding: 0;
    }
</style>
@section('content')
    <div class="content" style="padding: 50px 0;">
        <h2 class="text-center" style="margin-bottom: 30px;">Project List</h2>
        <button class="btn btn-success mb-3"><a href="{{ route('admin.project.add') }}" class="text-white text-decoration-none">+Add New Project</a></button>
        @if($projects->isEmpty())
            <div class="alert alert-info text-center">
                No projects found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $project->projectname }}</td>
                                <td>{{ $project->clientname ?? 'Not specified' }}</td>
                                <td>
                                    <span class="label {{ $project->status ? 'label-success' : 'label-default' }}">
                                        {{ $project->status ? 'Completed' : 'Ongoing' }}
                                    </span>
                                </td>
                                <td>
                                    @if($project->description && strip_tags($project->description))
                                        <div class="ql-editor" style="padding: 0;">
                                            <p>{!! \Illuminate\Support\Str::words(strip_tags($project->description), 20, '...') !!}</p>
                                        </div>
                                    @else
                                        Not specified
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.project.edit', $project->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form class="mt-1" method="POST" action="{{ route('admin.project.destroy', $project['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project ?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection