@extends('partials.adminlay')
@section('title','Amin Panel | Messages Received')
@section('content')
<div class="content py-5" style="overflow-x: auto;">
    <h1 class="text-center mb4">Messages Received:</h1>
    @if($contacts->isEmpty())
    <div class="alert alert-info text-center">
        No new messages yet!
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-light table-bordered shadow table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->firstname}} {{$contact->lastname}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->subject}}</td>
                        <td>{{$contact->message}}</td>
                        <td>
                            <form method="POST" action="{{route('admin.contact.destroy', $contact->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this message?')">Delete</button>
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