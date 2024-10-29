<div id="newCodePopup" class="popup-overlay" style="display: none;">
    <div class="popup-content">
        <h2>Select Language</h2>
        @foreach ($langs as $lang)
        <button class="new-code-lang-select"
            onclick="prepareNewCode(this)"
            data-lang-id="{{ $lang->id }}">
            <img src="{{ $lang->logo }}" />
            {{ $lang->name }}
        </button>
        @endforeach
        <button onclick="closePopup()">Close</button>
    </div>
</div>