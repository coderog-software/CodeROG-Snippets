@extends('layouts.app')

<div class="container">
        <!-- Dropdown for language selection -->
        <label for="language-select">Language:</label>
        <select id="language-select">
            <option value="javascript">JavaScript</option>
            <option value="php">PHP</option>
            <option value="python">Python</option>
            <option value="html">HTML</option>
            <!-- Add other languages as needed -->
        </select>

        <!-- Button to toggle dark mode -->
        <button id="toggle-theme">Toggle Dark Mode</button>

        <!-- Ace Editor container -->
        <div id="editor" style="height: 400px; width: 100%;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Ace editor
            const editor = ace.edit("editor");
            editor.setTheme("ace/theme/monokai"); // Set initial dark theme
            editor.session.setMode("ace/mode/javascript"); // Default language mode

            // Toggle dark mode
            const toggleThemeButton = document.getElementById("toggle-theme");
            let isDarkMode = true;

            toggleThemeButton.addEventListener("click", () => {
                isDarkMode = !isDarkMode;
                editor.setTheme(isDarkMode ? "ace/theme/monokai" : "ace/theme/github");
            });

            // Language selection
            const languageSelect = document.getElementById("language-select");

            languageSelect.addEventListener("change", (event) => {
                const selectedLanguage = event.target.value;
                editor.session.setMode(`ace/mode/${selectedLanguage}`);
            });
        });
    </script>