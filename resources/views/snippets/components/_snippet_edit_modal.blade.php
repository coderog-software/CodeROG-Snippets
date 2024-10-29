<!-- Modal for Editing Snippet Name -->
<div id="snippetDetailsEditModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeSnippetDetailsEditModal()">
            <img src="https://img.icons8.com/ultraviolet/30/delete-sign.png" alt="Close">
        </span>
        <h3>Edit Snippet Name</h3>
        <form id="snippetEditForm" onsubmit="saveSnippetDetails(event)">
            <input type="text" id="newSnippetName" value="{{ $snippet->name }}" />
            <button type="submit" class="small-button">Save</button>
        </form>
    </div>
</div>
