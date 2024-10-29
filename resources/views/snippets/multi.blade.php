@extends('layouts.app')

@vite(['resources/css/snippets/snippets.css', 'resources/js/snippets/snippets.js'])

<script>
    // Assuming $langs is an array of objects with properties: id, name, logo, ace_mode
    const all_langs = @json($langs, JSON_PRETTY_PRINT);
</script>

<div class="coderog-snippets-container">

    @if( $viewMode == 'editor' && $viewMode != 'embed' && $isOwnedByUser )
        @include('snippets.components._new_code_popup')
    @endif

    @include('snippets.components._tabs')

    <div class="tab-contents" style="height: 100%;">
        
        @include('snippets.components._mini_navigation_bar')

        <div id="coderog-snippets-editor" style="height: calc(100% - 66px); width: 100%;"></div>
        <!-- <textarea style="height: 400px; width: 800px;">{{$snippet}}</textarea> -->

        <span id="lang_name_floating"></span>
    </div>

    @include('snippets.components._snippet_edit_modal')

    @include('snippets.components._bottom_bar')

</div>