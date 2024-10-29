@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Snippets</h1>

    <!-- Sorting Options -->
    <div class="sort-options">
        <a href="{{ route('snippets.index', ['sort' => 'newest']) }}" class="btn {{ $sortOrder === 'newest' ? 'active' : '' }}">Newest</a>
        <a href="{{ route('snippets.index', ['sort' => 'random']) }}" class="btn {{ $sortOrder === 'random' ? 'active' : '' }}">Random</a>
    </div>

    <!-- Snippet Cards Grid -->
    <div class="snippets-grid">
        @foreach ($snippets as $snippet)
            <div class="snippet-card">
                <div class="card-header">
                    <h2>{{ $snippet->name }}</h2>
                    <!-- <span class="snippet-type">{{ $snippet->type }}</span> -->
                </div>
                
                <div class="card-actions">
                    <a href="{{ route('snippet.show', $snippet->uid) }}" class="btn btn-primary">View</a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="pagination-links">
        {{ $snippets->links() }}
    </div>
</div>
@endsection

<style>
    /* public/css/snippets.css */

    /* Sorting Options */
    .sort-options {
        margin-bottom: 20px;
    }

    .sort-options .btn {
        margin-right: 10px;
        padding: 8px 12px;
        color: #ffffff;
        background-color: #333;
        text-decoration: none;
        border-radius: 5px;
    }

    .sort-options .btn.active {
        background-color: #e91e63;
    }

    /* Grid Layout for Cards */
    .snippets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .snippet-card {
        background-color: #1e1e1e;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        color: #ffffff;
        transition: transform 0.2s ease;
    }

    .snippet-card:hover {
        transform: scale(1.05);
    }

    .card-header h2 {
        font-size: 1.25rem;
        margin-bottom: 5px;
        color: #e91e63;
    }

    .snippet-type {
        font-size: 0.9rem;
        color: #bbbbbb;
    }

    .snippet-date {
        font-size: 0.85rem;
        color: #aaaaaa;
        margin-top: 10px;
    }

    .card-actions .btn {
        display: inline-block;
        padding: 10px 15px;
        background-color: #ff4081;
        color: #ffffff;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 15px;
        transition: background 0.3s;
    }

    .card-actions .btn:hover {
        background-color: #e91e63;
    }

    /* Pagination */
    .pagination-links {
        margin-top: 30px;
        text-align: center;
    }

    .pagination-links nav {
        display: inline-block;
        background: #333;
        padding: 8px;
        border-radius: 8px;
    }

    .pagination-links .page-link {
        color: #ffffff;
        background: #444;
        border: none;
        padding: 6px 12px;
        margin: 0 2px;
        transition: background 0.3s;
    }

    .pagination-links .page-link:hover {
        background: #e91e63;
    }

</style>