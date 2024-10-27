<?php

namespace App\Http\Controllers;

use App\Models\Snippet;

class SnippetController extends Controller
{
    public function index()
    {
        $snippets = Snippet::paginate(10); // Adjust the number for pagination
        return view('snippets.index', compact('snippets'));
    }

    public function embed($uid)
    {
        // Find the snippet by its UID
        $snippet = Snippet::with('codes.lang')->where('uid', $uid)->firstOrFail();

        // Different views based on the snippet type
        switch ($snippet->type_name) {
            case 'single':
                return view('snippets.single', compact('snippet'));
            case 'multi':
                return view('snippets.multi', compact('snippet'));
                // $relatedSnippets = Snippet::where('type', 'multi')->where('id', '!=', $snippet->id)->get(); // Get related multi snippets
                // return view('snippets.multi', compact('snippet', 'relatedSnippets'));
            default:
                abort(404); // Handle unknown snippet types
        }
    }

    public function show($uid) {
        return $this->embed($uid);
    }
}
