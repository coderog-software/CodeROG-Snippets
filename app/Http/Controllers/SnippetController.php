<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SnippetController extends Controller
{
    public function index()
    {
        $snippets = Snippet::paginate(10); // Adjust the number for pagination
        return view('snippets.index', compact('snippets'));
    }

    public function list(Request $request)
    {
        $sortOrder = $request->get('sort', 'newest'); // Default to 'newest' sorting

        // Choose sorting method based on request
        $snippets = Snippet::when($sortOrder === 'random', function ($query) {
            return $query->inRandomOrder();
        }, function ($query) {
            return $query->orderBy('created_at', 'desc');
        })
            ->paginate(6); // Display 6 snippets per page

        return view('snippets.list', compact('snippets', 'sortOrder'));
    }

    public function embed($uid)
    {
        $viewMode = 'embed';
        // Find the snippet by its UID
        $snippet = Snippet::with('codes.lang')->where('uid', $uid)->firstOrFail();

        $langs = Lang::all();

        // Different views based on the snippet type
        switch ($snippet->type_name) {
            case 'single':
                return view('snippets.single', compact('snippet'));
            case 'multi':
                return response()
                    ->view('snippets.multi', compact('snippet', 'langs', 'viewMode')) // or 'snippets.multi'
                    ->header('X-Frame-Options', 'ALLOW-FROM *') // Adjust this line as needed
                    ->header('Content-Security-Policy', "frame-ancestors 'self' *") // Adjust for CSP
                    ->header('Permissions-Policy', 'clipboard=()'); // Allow clipboard access
            default:
                abort(404); // Handle unknown snippet types
        }
    }

    public function show($uid)
    {
        $viewMode = 'editor';
        // Retrieve the currently authenticated user...
        $user = Auth::user();

        // Find the snippet by its UID
        $snippet = Snippet::with('codes.lang')->where('uid', $uid)->firstOrFail();

        // Check if the snippet belongs to the authenticated user
        $isOwnedByUser = $user && $snippet->user_id === $user->id;

        $langs = Lang::all();

        switch ($snippet->type_name) {
            case 'single':
                return view('snippets.single', compact('snippet'));
            case 'multi':
                return view('snippets.multi', compact('snippet', 'langs', 'user', 'viewMode', 'isOwnedByUser'));
            default:
                abort(404); // Handle unknown snippet types
        }
    }

    public function edit($uid)
    {
        // Find the snippet by its UID
        $snippet = Snippet::with('codes.lang')->where('uid', $uid)->firstOrFail();

        return view('snippets.edit', compact('snippet'));
    }

    public function create()
    {
        return view('snippets.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'snippet_type_id' => 'required|exists:snippet_types,id',
            'name' => 'required|string|max:255',
        ]);

        $uniqueUid = $this->generateUniqueUid();

        // Create the snippet with a unique identifier
        $snippet = Snippet::create([
            'snippet_type_id' => $request->snippet_type_id,
            'uid' => $uniqueUid,
            'name' => $request->name,
        ]);

        // Redirect to the newly created snippet's page
        return redirect()->route('snippet.show', ['uid' => $snippet->uid]);
    }

    private function generateUniqueUid()
    {
        do {
            $uid = Str::random(11); // Generate a random 11-character string
        } while (Snippet::where('uid', $uid)->exists()); // Check if it already exists

        return $uid;
    }

    public function update(Request $request, $uid)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $snippet = Snippet::where('uid', $uid)->firstOrFail();
        $snippet->name = $request->name;

        if ($snippet->save()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Could not update the snippet name.'], 500);
    }
}
