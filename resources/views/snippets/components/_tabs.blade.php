<div class="tabs" id="tabs">
    <div id="tab-lang-buttons">
        @foreach ($snippet->codes as $code)
        <button id="code-{{ $code->hash }}"
            class="tab-button {{ $loop->first ? 'active' : '' }}"
            onclick="openCodeTab(this)"
            data-lang-id="{{ $code->lang_id }}"
            data-code-hash="{{ $code->hash }}"
            data-code="{{ $code->code }}">
            <img src="{{ $code->lang->logo }}" />
            {{ $code->lang->name }}
        </button>
        @endforeach
    </div>

    @if( $viewMode == 'editor' && $viewMode != 'embed' )
        <button class="tab-button" onclick="addNewCodePopup()">
            <img src="https://img.icons8.com/color/50/plus--v1.png" />
        </button>
    @endif
    
</div>
