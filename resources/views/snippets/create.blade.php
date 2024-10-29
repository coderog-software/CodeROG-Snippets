@extends('layouts.app')

<div id="newCodePopup" class="popup-overlay" style="display: ;">
    <div class="popup-content">
        <h2>Give an amazing name for your code snippet</h2>

        <form action="{{ route('snippet.store') }}" method="POST" class="create-snippet-form">
            @csrf
            <!-- <label for="snippet_type_id">Snippet Type:</label> -->
            <input type="hidden" name="snippet_type_id" required value="1">

            <input type="text" name="name" class="m20 p20 create-snippet-form-name-input" placeholder="Type Snippet Name" required>

            <button type="submit" class="create-snippet-form-submit">Create Snippet</button>
        </form>
    </div>
</div>


<style>
    /* Popup overlay to blur background */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000000;
        backdrop-filter: blur(5px);
    }

    /* Popup content styling */
    .popup-content {
        background: #000000;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        text-align: center;
        animation: slideDown 0.4s ease-in-out;
        color: white;
        box-shadow: #0e172094 0px 0px 15px;
    }

    /* Entry animation */
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .create-snippet-form {
        padding: 50px;
        display: flex;
        flex-direction: column;
    }

    .create-snippet-form-name-input {
        color: black;
        font-weight: bold;
        text-align: center;
        border-radius: 50px;
    }

    .create-snippet-form-submit {
        padding: 10px 8px;
        background-color: #1AAB29;
        color: #FFFFFF;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: medium;
    }
</style>