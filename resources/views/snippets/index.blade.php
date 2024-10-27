@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Snippets</h1>
    <table id="snippet-table" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>UID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($snippets as $snippet)
                <tr>
                    <td>{{ $snippet->id }}</td>
                    <td>{{ $snippet->type }}</td>
                    <td>{{ $snippet->uid }}</td>
                    <td>
                        <a href="{{ route('snippet.show', $snippet->uid) }}">
                            {{ $snippet->name }}
                        </a>
                    </td>
                    <td>{{ $snippet->created_at }}</td>
                    <td>{{ $snippet->updated_at }}</td>
                    <td>
                        <a href="{{ route('snippet.show', $snippet->uid) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $snippets->links() }}
</div>

<script>
    // Initialize Great Table
    const table = new GreatTable('#snippet-table', {
        perPage: 10, // Set items per page if needed
    });
</script>
@endsection
