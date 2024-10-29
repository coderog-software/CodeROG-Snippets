

// Transforming the array into an object with `id` as keys
var structured_langs = all_langs.reduce(function(acc, lang) {
    acc[lang.id] = {
        name: lang.name,
        logo: lang.logo,
        ace_mode: lang.ace_mode
    };
    return acc;
}, {});

// ================================================

const tabLangButtons = document.getElementById("tab-lang-buttons");

        let isDragging = false;
        let startX;
        let scrollLeft;

        tabLangButtons.addEventListener("mousedown", (e) => {
            isDragging = true;
            startX = e.pageX - tabLangButtons.offsetLeft;
            scrollLeft = tabLangButtons.scrollLeft;
            tabLangButtons.classList.add("active");
        });

        tabLangButtons.addEventListener("mouseleave", () => {
            isDragging = false;
            tabLangButtons.classList.remove("active");
        });

        tabLangButtons.addEventListener("mouseup", () => {
            isDragging = false;
            tabLangButtons.classList.remove("active");
        });

        tabLangButtons.addEventListener("mousemove", (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - tabLangButtons.offsetLeft;
            const walk = (x - startX) * 2; // Adjust the scroll speed as needed
            tabLangButtons.scrollLeft = scrollLeft - walk;
        });


// ================================================

window.prepareNewCode = function(btn) {

    if (!isAuthenticated) {
        // Logic for opening the snippet creation popup
        openAuthPopup();
        return;
    }

    closeNewCodePopup();

    const langId = btn.attributes['data-lang-id'].value;
    const aceMode = structured_langs[langId].ace_mode;
    const langName = structured_langs[langId].name;

    document.querySelector("#code_hash").textContent = "";
    document.querySelector("#lang_id").textContent = langId;
    document.querySelector("#lang_name").textContent = langName;
    document.querySelector("#lang_name_floating").textContent = langName;

    const editorElement = document.getElementById("coderog-snippets-editor");
    if (editorElement) {
        var editor = ace.edit("coderog-snippets-editor");
        editor.session.setMode({
            path: "ace/mode/" + aceMode,
            inline: true
        })
        editor.setReadOnly(false);
        editor.setValue("// type your amazing " + langName + " code");
        editor.clearSelection();
    }

    saveEditorContent(true);
}

// Fetch language options and open the popup
window.addNewCodePopup = function() {
    document.getElementById("newCodePopup").style.display = "flex";
}

// Close the popup
window.closeNewCodePopup = function() {
    document.getElementById("newCodePopup").style.display = "none";
}


// Initialize Ace editor if it’s in use
document.addEventListener('DOMContentLoaded', (event) => {
    const editorElement = document.getElementById("coderog-snippets-editor");
    if (editorElement) {
        var editor = ace.edit("coderog-snippets-editor");
        editor.setTheme("ace/theme/terminal"); // Customize as needed
        editor.session.setMode("ace/mode/javascript"); // Set language mode
        editor.setReadOnly(true);
        editor.setValue("// select language/syntax first"); // Set the initial content of the editor
        editor.clearSelection();
    }

    var tb = document.querySelectorAll(".tab-button");
    tb[0].click();
});

window.changeEditorMode = function(btn) {
    const langId = btn.attributes['data-lang-id'].value;
    const aceMode = structured_langs[langId].ace_mode;

    document.querySelector("#lang_id").textContent = langId;
    document.querySelector("#code_hash").textContent = btn.attributes['data-code-hash'].value;

    const editorElement = document.getElementById("coderog-snippets-editor");

    if (editorElement) {
        var editor = ace.edit("coderog-snippets-editor");
        editor.session.setMode({
            path: "ace/mode/" + aceMode,
            inline: true
        })
        editor.setValue(btn.attributes['data-code'].value);
        editor.clearSelection();
        editor.setReadOnly(false);
    }
}

window.getEditorContent = function() {
    const editorElement = document.getElementById("coderog-snippets-editor");
    if (editorElement) {
        var editor = ace.edit("coderog-snippets-editor");
        const codeContent = editor.getValue(); // Gets the code content as text
        // console.log(codeContent); // You can log it or send it via AJAX to your Laravel app
        return codeContent;
    }
}

window.saveEditorContent = function(new_code = false) {
    if (!isAuthenticated) {
        // Logic for opening the snippet creation popup
        openAuthPopup();
        return;
    }

    

    const snippetUid = document.querySelector("#snippet_uid").textContent;
    const codeHash = document.querySelector("#code_hash").textContent;
    const langId = document.querySelector("#lang_id").textContent;
    const codeContent = getEditorContent();

    if (codeContent) {
        fetch('/code/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    snippet_uid: snippetUid,
                    hash: codeHash,
                    code: codeContent,
                    lang_id: langId
                })
            })
            .then(response => response.json())
            .then(data => {
                // console.log('Content saved successfully:', data);

                Toastify({
                    text: "Content saved successfully",
                    duration: 3000,
                    destination: "",
                    newWindow: true,
                    close: true,
                    gravity: "bottom", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                        offset: {
                        y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                    onClick: function(){} // Callback after click
                }).showToast();

                if (new_code === true) {
                    const buttonId = createAndAppendButton(langId, data.codeEntry.hash);
                    document.getElementById(buttonId).click();
                }
            })
            .catch(error => console.error('Error saving content:', error));
    } else {
        console.log('No content to save');
    }
}

// ================================================

window.openSnippetDetailsEditModal = function() {
    if (!isAuthenticated) {
        // Logic for opening the snippet creation popup
        openAuthPopup();
        return;
    }
    document.getElementById("snippetDetailsEditModal").style.display = "flex";
}

window.closeSnippetDetailsEditModal = function() {
    document.getElementById("snippetDetailsEditModal").style.display = "none";
}

window.saveSnippetDetails = function(event) {
    event.preventDefault(); 
    
    const newSnippetName = document.getElementById("newSnippetName").value;
    const snippetUid = document.querySelector("#snippet_uid").textContent;

    // AJAX request
    fetch(`/snippet/${snippetUid}/update`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ name: newSnippetName })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Toastify({
                text: "Saved successfully!",
                duration: 3000,
                destination: "",
                newWindow: true,
                close: true,
                gravity: "bottom", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                    offset: {
                    y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                },
                onClick: function(){} // Callback after click
            }).showToast();

            // Update the name on the page
            document.getElementById("snippet-name").innerText = newSnippetName;
            closeSnippetDetailsEditModal();
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => alert("Error: " + error));
}

// ================================================

window.openCodeTab = function(btn) {

    const langId = btn.attributes['data-lang-id'].value;
    const langName = structured_langs[langId].name;

    changeEditorMode(btn);

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
    var activeTab = document.getElementById(btn.attributes.id.value);
    // activeTab.style.display = 'block'; // Set display to block before applying active class
    setTimeout(function() {
        activeTab.classList.add('active'); // Add active class after a short delay for opacity transition
    }, 10);

    // Add "active" class to the button that opened the tab
    btn.classList.add('active');

    document.querySelector("#lang_name_floating").textContent = langName;
}

// ================================================

window.copyEmbedCode = function() {
    const embedCode = `<iframe src="{{ url('embed/' . $snippet->uid) }}" width="100%" height="400px" style="border:0"></iframe>`;
    navigator.clipboard.writeText(embedCode).then(() => {
        // alert("Embed code copied to clipboard!");
        Toastify({
            text: "Embed code copied to clipboard!",
            duration: 3000,
            destination: "",
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
                offset: {
                y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
            },
            onClick: function(){} // Callback after click
        }).showToast();
    }).catch(err => {
        console.error("Failed to copy text: ", err);
    });
}

window.copyCodeCode = function(button) {
    const code = getEditorContent();

    // Create a temporary textarea element to hold the code
    const textarea = document.createElement('textarea');
    textarea.value = code;
    document.body.appendChild(textarea);

    textarea.select(); // Select the text
    textarea.setSelectionRange(0, 99999); // For mobile devices

    const successImg = button.querySelector('.copy-code-button-done-img');
    const errorImg = button.querySelector('.copy-code-button-error-img');
    const copyImg = button.querySelector('.copy-code-button-copy-img');

    try {
        // Copy the text inside the textarea
        const successful = document.execCommand('copy'); // Fallback for browsers that don't support Clipboard API
        const msg = successful ? 'successful' : 'unsuccessful';

        // Show success image
        if (successful) {

            Toastify({
                text: "Code copied to clipboard!",
                duration: 3000,
                destination: "",
                newWindow: true,
                close: true,
                gravity: "bottom", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                    offset: {
                    y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                },
                onClick: function(){} // Callback after click
            }).showToast();

            copyImg.style.display = 'none'; // Hide copy icon
            successImg.style.display = 'block'; // Show success icon

            setTimeout(() => {
                successImg.style.display = 'none'; // Hide success icon
                copyImg.style.display = 'block'; // Show copy icon again
            }, 500); // Show for 3 seconds
        } else {
            throw new Error('Copy command was unsuccessful');
        }
    } catch (err) {
        console.error('Oops, unable to copy: ', err);
        // Show error image
        copyImg.style.display = 'none'; // Hide copy icon
        errorImg.style.display = 'block'; // Show error icon

        setTimeout(() => {
            errorImg.style.display = 'none'; // Hide error icon
            copyImg.style.display = 'block'; // Show copy icon again
        }, 3000); // Show for 3 seconds
    }

    // Remove the textarea from the DOM
    document.body.removeChild(textarea);
}

// ================================================

window.toggleFullScreen = function() {
    const container = document.querySelector('body');

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

// ================================================

// Function to create and append the button
window.createAndAppendButton = function(lang_id, code_hash) {
    // Create the button element
    const button = document.createElement('button');
    const langName = structured_langs[lang_id].name;
    const langLogo = structured_langs[lang_id].logo;

    // Set attributes
    const buttonId = 'code-' + code_hash;
    button.id = buttonId;
    button.className = 'tab-button';
    button.onclick = function() { openCodeTab(this); }; // Set the onclick function
    button.setAttribute('data-lang-id', lang_id);
    button.setAttribute('data-code-hash', code_hash);
    button.setAttribute('data-code', '// type your amazing ' + langName + ' code');

    // Create the image element
    const img = document.createElement('img');
    img.src = langLogo;
    
    // Create a text node for the button label
    const textNode = document.createTextNode(langName);

    // Append the image and text to the button
    button.appendChild(img);
    button.appendChild(textNode);

    // Append the button to a parent element (e.g., a div with id 'buttonContainer')
    const buttonContainer = document.getElementById('tab-lang-buttons');
    buttonContainer.append(button);

    return buttonId;
}

// ================================================