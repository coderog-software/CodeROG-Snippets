<div class="bottom-bar">
    <div class="bottom-bar-left">
        <div class="snippet-details">
            <div class="snippet-name-div">
                <span class="snippet-name" id="snippet-name">{{ $snippet->name }}</span>

                @if( $viewMode == 'editor' && $viewMode != 'embed' && $isOwnedByUser )
                    <img
                        src="https://img.icons8.com/poly/50/edit.png"
                        alt="Edit"
                        class="edit-icon hover-o6"
                        onclick="openSnippetDetailsEditModal()"
                    />
                @endif

            </div>
            @if($snippet->user)
            <span class="snippet-author">{{ $snippet->user->name }}</span>
            @endif
        </div>
    </div>

        <div style="display: none;">
            <small>Snippet UID: <span id="snippet_uid">{{ $snippet->uid }}</span></small>
            <small>Code Hash: <span id="code_hash"></span></small>
            <small>Lang ID: <span id="lang_id"></span></small>
            <small>Lang Name: <span id="lang_name"></span></small>
            <small>User ID: <span id="snippet_user_id">{{ $snippet->user_id }}</span></small>
        </div>

    @if(Auth::check())
        @if( $viewMode == 'editor' && $viewMode != 'embed' )
        <div style="display: none;">
            <small>User ID: <span id="user_id">{{ $user ? $user->id : "" }}</span></small>
            <small>User Name: <span id="user_name">{{ $user ? $user->email : "" }}</span></small>
            <small>User UID: <span id="user_hash"></span></small>
            <small>isOwnedByUser: <span id="isOwnedByUser">{{ $isOwnedByUser }}</span></small>
        </div>
        @endif
    @endif
    <div>
        <button onclick="toggleFullScreen()" class="small-button"><span>Fullscreen</span></button>
        <button class="copy-embed-button small-button" onclick="copyEmbedCode()">Copy Embed Code</button>
        @if( $viewMode == 'editor' && $viewMode != 'embed' && $isOwnedByUser )
            <button class="small-button" onclick="saveEditorContent()">Save Code</button>
        @endif
    </div>
    <div class="bottom-bar-right">
        <a class="coderog-snippets-logo" href="{{ url('snippet/' . $snippet->uid) }}" target="_blank">
            <img src="{{ asset('images/coderog-snippets-logo.svg') }}" alt="CodeROG Snippets Logo" class="coderog-logo">
        </a>
    </div>
</div>