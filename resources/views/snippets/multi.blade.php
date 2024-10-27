@extends('layouts.app')

<div class="coderog-snippets-container container">
    <!-- <h1>{{ $snippet->name }}</h1>
    <p>Type: {{ $snippet->type_name }}</p>
    <p>UID: {{ $snippet->uid }}</p> -->

    <div class="tabs">
        @foreach ($snippet->codes as $code)
        <button class="tab-button {{ $loop->first ? 'active' : '' }}" onclick="openCodeTab(event, 'code-{{ $code->id }}')">
            <img src="{{ $code->lang->logo }}" />
            {{ $code->lang->name }}
        </button>
        @endforeach
    </div>

    <div class="tab-contents">
        @foreach ($snippet->codes as $code)

        <div id="code-{{ $code->id }}" class="tab-content {{ $loop->first ? 'active' : '' }}">
            <span style="padding: 16px 16px 0px 16px;width:100%;display: flex;justify-content: space-between;">
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="14" viewBox="0 0 54 14">
                    <g fill="none" fill-rule="evenodd" transform="translate(1 1)">
                        <circle cx="6" cy="6" r="6" fill="#FF5F56" stroke="#E0443E" stroke-width=".5"></circle>
                        <circle cx="26" cy="6" r="6" fill="#FFBD2E" stroke="#DEA123" stroke-width=".5"></circle>
                        <circle cx="46" cy="6" r="6" fill="#27C93F" stroke="#1AAB29" stroke-width=".5"></circle>
                    </g>
                </svg>
                <button class="copy-code-button" data-code="{{ $code->code }}" onclick="copyCodeCode(this)">
                    <img src="https://img.icons8.com/fluency/40/copy.png" alt="" srcset="">
                </button>
            </span>
            <pre><code class="language-{{ strtolower($code->lang->name) }}">{{ $code->code }}</code></pre>
            <span style="font-family: Code-Pro-JetBrains-Mono,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;display:flex;align-items:flex-end;padding:10px;width:100%;justify-content:flex-end;color:#aaafcf;font-size:12px;line-height:1;position: fixed;right: 16px;bottom: 46px;">
                {{ $code->lang->name }}
            </span>
        </div>
        @endforeach
    </div>

    <div class="bottom-bar">
        <div class="bottom-bar-left">
            <div class="snippet-details">
                <span class="snippet-name">{{ $snippet->name }}</span>
                <span class="snippet-author">By text.lk</span>
            </div>
        </div>
        <div>
            <!-- <button onclick="toggleFullScreen()" class="small-button"><span>Fullscreen</span></button> -->
            <!-- <button class="copy-embed-button small-button small-button" onclick="copyEmbedCode()">Copy Embed Code</button> -->
        </div>
        <div class="bottom-bar-right">
            <a class="coderog-snippets-logo" href="{{ url('snippet/' . $snippet->uid) }}" target="_blank">
                <img src="{{ asset('images/coderog-snippets-logo.svg') }}" alt="CodeROG Snippets Logo" class="coderog-logo">
            </a>
        </div>
    </div>
</div>

<!-- Pure CSS for Tabs with Animation -->
<style>
    .coderog-snippets-container {
        padding-bottom: 40px;
        font-family: Code-Pro-JetBrains-Mono,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace;
    }

    .tabs {
        display: flex;
        background: #07080D;
        position: sticky;
        top: 0;
        z-index: 100000;
    }

    .tab-button {
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        transition: background-color 0.3s;
        color: white;
        font-size: x-small;
        opacity: 0.5;
        font-weight: 400;
        justify-items: center;
    }

    .tab-button.active {
        background-color: #0F111A;
        /* font-weight: bold; */
        opacity: 1;
    }

    .tab-button:hover {
        opacity: 1;
    }

    .tab-button img {
        width: 40px;
        margin-bottom: 5px;
    }

    .tab-content {
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        /* Animation for fading */
        font-size: 14px !important;
    }

    .tab-content.active {
        display: block;
        opacity: 1;
    }

    .code-section {
        border: 1px solid #ddd;
    }

    .hljs {
        background: #0f111a !important;
        padding: 16px 0 16px 16px !important;
    }

    .copy-code-button {
        opacity: 0.5;
        right: 16px;
        position: fixed;
    }

    .copy-code-button:hover {
        opacity: 1;
    }
</style>

<style>
    /* Bottom bar styling */
    .bottom-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 14px;
        background-color: #07080d;
        color: #FFFFFF;
        border-top: 1px solid #333;
        position: fixed;
        width: 100%;
        bottom: 0;
    }

    .bottom-bar-left {
        display: flex;
        align-items: center;
    }

    .snippet-details {
        display: flex;
        flex-direction: column;
        line-height: normal;
    }

    .snippet-name {
        font-weight: bold;
        margin-right: 16px;
    }

    .snippet-author {
        font-size: x-small;
    }

    .copy-embed-button {
        padding: 4px 8px;
        background-color: #1AAB29;
        color: #FFFFFF;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: x-small;
    }

    .copy-embed-button:hover {
        background-color: #27C93F;
    }

    .bottom-bar-right .coderog-logo {
        height: 20px;
        /* Adjust size as necessary */
    }

    .coderog-snippets-logo {
        opacity: 0.9;
    }

    .coderog-snippets-logo:hover {
        opacity: 1;
    }

    .small-button {
        padding: 4px 8px;
        background-color: #1AAB29;
        color: #FFFFFF;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: x-small;
    }

    .small-button:hover {
        background-color: #27C93F;
    }
</style>

<!-- Pure JavaScript for Tab Switching with Animation -->
<script>
    function openCodeTab(event, tabName) {
        // Get all elements with class="tab-content" and hide them
        var tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(function(content) {
            content.classList.remove('active');
            content.style.display = 'none'; // Hide content immediately
        });

        // Get all elements with class="tab-button" and remove the class "active"
        var tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(function(button) {
            button.classList.remove('active');
        });

        // Show the current tab
        var activeTab = document.getElementById(tabName);
        activeTab.style.display = 'block'; // Set display to block before applying active class
        setTimeout(function() {
            activeTab.classList.add('active'); // Add active class after a short delay for opacity transition
        }, 10);

        // Add "active" class to the button that opened the tab
        event.currentTarget.classList.add('active');
    }
</script>

<script>
    function copyEmbedCode() {
        const embedCode = `<iframe src="{{ url('embed/' . $snippet->uid) }}" width="100%" height="400px" style="border:0"></iframe>`;
        navigator.clipboard.writeText(embedCode).then(() => {
            alert("Embed code copied to clipboard!");
        }).catch(err => {
            console.error("Failed to copy text: ", err);
        });
    }

    function copyCodeCode(btn) {
        const codeCode = btn.attributes['data-code'].textContent;
        navigator.clipboard.writeText(codeCode).then(() => {
            alert("Code copied to clipboard!");
        }).catch(err => {
            console.error("Failed to copy text: ", err);
        });
    }
</script>

<script>
    function toggleFullScreen() {
        const container = document.querySelector('.container');

        if (!document.fullscreenElement) {
            if (container.requestFullscreen) {
                container.requestFullscreen();
            } else if (container.mozRequestFullScreen) { // Firefox
                container.mozRequestFullScreen();
            } else if (container.webkitRequestFullscreen) { // Chrome, Safari, and Opera
                container.webkitRequestFullscreen();
            } else if (container.msRequestFullscreen) { // IE/Edge
                container.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }
</script>