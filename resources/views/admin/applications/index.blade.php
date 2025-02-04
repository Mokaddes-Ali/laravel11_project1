@extends('layouts.master')

@section('content')
    <h1>Applications</h1>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Details</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr>
                    <td>{{ $application->user->name }}</td>
                    <td>{{ $application->details }}</td>
                    <td>{{ $application->status }}</td>
                    <td>
                        @if ($application->status === 'pending')
                            <form action="{{ route('admin.applications.approve', $application) }}" method="POST">
                                @csrf
                                <button type="submit">Approve</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
