<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code;
use Illuminate\Support\Str;
use App\Models\Snippet;
use Illuminate\Support\Facades\Auth;

class CodeController extends Controller
{
    public function save(Request $request) 
    {

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized request',
            ], 401);
        }

        try {
            // Validate the incoming request
            $request->validate([
                'snippet_uid' => 'required|string|exists:snippets,uid',
                'hash' => 'nullable|string',
                'lang_id' => 'required|integer|exists:langs,id',
                'code' => 'required|string'
            ]);

            // Generate a unique hash if not provided
            $hash = $request->hash ?: $this->generateUniqueHash();

            $snippet = Snippet::where('uid', $request->snippet_uid)->firstOrFail(); 

            $isOwnedByUser = $user && $snippet->user_id === $user->id;
            if (!$isOwnedByUser) {
                return response()->json([
                    'message' => 'Unauthorized request',
                ], 401);
            }

            // Try to save the code entry

            // Find or create a `Code` instance based on `snippet_id` and `hash`
            $codeEntry = Code::updateOrCreate(
                [
                    'snippet_id' => $snippet->id,
                    'hash' => $hash,
                ],
                [
                    'lang_id' => $request->lang_id,
                    'code' => $request->code,
                ]
            );

            // Check if the snippet does not have a user associated with it
            if (is_null($snippet->user_id)) {
                // Update the snippet with the authenticated user's ID
                $snippet->user_id = $user->id;
                $snippet->save();
            }

            return response()->json([
                'message' => 'Code saved successfully',
                'codeEntry' => $codeEntry
            ], $codeEntry->wasRecentlyCreated ? 201 : 200); // Return 201 if created, 200 if updated
        } catch (\Exception $e) {
            // Handle exceptions and return a 500 error response
            // Log the error for debugging purposes (optional)
            \Log::error('Failed to save code: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to save code: ' . $e->getMessage()], 500);
        }
    }

    private function generateUniqueHash()
    {
        do {
            $hash = Str::random(11); // Generate a random 11-character string
        } while (Code::where('hash', $hash)->exists()); // Check if it already exists

        return $hash;
    }
}
