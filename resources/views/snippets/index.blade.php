@extends('layouts.app')

@section('title', 'CODEROG Snippets - Save, Share, and Discover Code Snippets')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">CODEROG Snippets</h1>
            <p class="hero-subtitle">Save, Share, and Discover Code Snippets with Ease</p>
            <a href="{{ route('snippet.create') }}" class="create-snippet-button">Create Snippet</a>
            <a href="{{ route('snippets.list') }}" style="margin-top: 20px">View Snippets</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose CODEROG Snippets?</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <h3>Organized Code</h3>
                    <p>Keep your snippets organized and accessible from anywhere, anytime.</p>
                </div>
                <div class="feature-item">
                    <h3>Collaborate & Share</h3>
                    <p>Share snippets with teammates and work together on projects seamlessly.</p>
                </div>
                <div class="feature-item">
                    <h3>Multi-language Support</h3>
                    <p>Store snippets in multiple programming languages in one place.</p>
                </div>
                <div class="feature-item">
                    <h3>Fast & Secure</h3>
                    <p>Your snippets are secure and accessible with lightning-fast load times.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <p>Ready to boost your productivity? Start creating and sharing your code snippets today!</p>
            <a href="{{ route('snippet.create') }}" class="cta-button">Create Your First Snippet</a>
        </div>
    </section>
@endsection

<style>
/* General Reset */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    color: #eee;
    background-color: #121212;
    line-height: 1.6;
    overflow-x: hidden;
}

/* Container */
.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Hero Section */
.hero {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    text-align: center;
    background: linear-gradient(135deg, #1c1c1c, #2a2a2a);
    animation: fadeIn 1.5s ease-in-out;
}

.hero-title {
    font-size: 2.5rem;
    color: #ffffff;
    text-shadow: 2px 2px 8px #000;
    margin-bottom: 10px;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #aaaaaa;
    margin-bottom: 30px;
}

/* Create Snippet Button */
.create-snippet-button {
    display: inline-block;
    padding: 15px 25px;
    font-size: 1rem;
    color: #ffffff;
    background: #e91e63;
    border-radius: 8px;
    text-decoration: none;
    transition: transform 0.3s ease, background 0.3s ease;
    box-shadow: 0 4px 15px rgba(233, 30, 99, 0.4);
}

.create-snippet-button:hover {
    transform: translateY(-4px);
    background: #ff4081;
}

/* Features Section */
.features {
    padding: 60px 0;
    background: #181818;
}

.section-title {
    font-size: 2rem;
    text-align: center;
    margin-bottom: 40px;
}

.features-grid {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
}

.feature-item {
    background: #222;
    padding: 30px;
    border-radius: 8px;
    transition: background 0.3s;
    text-align: center;
}

.feature-item:hover {
    background: #333;
}

.feature-item h3 {
    color: #e91e63;
    margin-bottom: 15px;
}

/* CTA Section */
.cta {
    padding: 40px 0;
    text-align: center;
    background: #2a2a2a;
}

.cta p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.cta-button {
    display: inline-block;
    padding: 12px 20px;
    font-size: 1.1rem;
    color: #fff;
    background: #e91e63;
    border-radius: 5px;
    text-decoration: none;
    transition: transform 0.3s ease, background 0.3s ease;
    box-shadow: 0 4px 15px rgba(233, 30, 99, 0.4);
}

.cta-button:hover {
    transform: translateY(-4px);
    background: #ff4081;
}

/* Keyframes for Animations */
@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

    </style>


<script>
    // Optional Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

</script>

