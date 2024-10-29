<div id="authModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeAuthModal()">
            <img src="https://img.icons8.com/ultraviolet/30/delete-sign.png" alt="">
        </span>
        <h3 id="authModalTitle">Login</h3>
        
        <form id="loginForm" onsubmit="handleLogin(event)">
            <input type="email" id="loginEmail" placeholder="Email" required>
            <input type="password" id="loginPassword" placeholder="Password" required>
            <button type="submit" class="small-button">Login</button>
        </form>

        <form id="registerForm" onsubmit="handleRegister(event)" style="display: none;">
            <input type="text" id="registerName" placeholder="Name" required>
            <input type="email" id="registerEmail" placeholder="Email" required>
            <input type="password" id="registerPassword" placeholder="Password" required>
            <input type="password" id="registerPasswordConfirmation" placeholder="Confirm Password" required>
            <button type="submit" class="small-button">Register</button>
        </form>
        
        <button onclick="showRegisterForm()">Need an account? Register here</button>
    </div>
</div>



<script>
    function openAuthPopup() {
        document.getElementById("authModal").style.display = "flex";
        showLoginForm(); // Show the login form by default
    }

    function closeAuthModal() {
        document.getElementById("authModal").style.display = "none";
    }

    function showLoginForm() {
        document.getElementById("loginForm").style.display = "block";
        document.getElementById("registerForm").style.display = "none";
        document.getElementById("authModalTitle").innerText = "Login";
    }

    function showRegisterForm() {
        document.getElementById("loginForm").style.display = "none";
        document.getElementById("registerForm").style.display = "block";
        document.getElementById("authModalTitle").innerText = "Register";
    }

    function handleLogin(event) {
        event.preventDefault();
        const email = document.getElementById("loginEmail").value;
        const password = document.getElementById("loginPassword").value;

        fetch('{{ route("ajax.login") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeAuthModal(); // Close the modal on success
                location.reload(); // Reload the page to reflect logged-in state
            } else {
                console.log(data);
                // alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function handleRegister(event) {
        event.preventDefault();
        const name = document.getElementById("registerName").value;
        const email = document.getElementById("registerEmail").value;
        const password = document.getElementById("registerPassword").value;
        const passwordConfirmation = document.getElementById("registerPasswordConfirmation").value;

        fetch('{{ route("ajax.register") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name, email, password, password_confirmation: passwordConfirmation })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeAuthModal(); // Close the modal on success
                location.reload(); // Reload the page to reflect logged-in state
            } else {
                console.log(data);
                // alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
