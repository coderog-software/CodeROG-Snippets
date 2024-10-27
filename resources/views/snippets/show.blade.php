
@extends('layouts.app')

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

/* Fade in Tabs */
.tabcontent {
  animation: fadeEffect 1s; /* Fading effect takes 1 second */
}

/* Go from zero to full opacity */
@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}
</style>

@section('content')
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">London</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
  <button class="tablinks" onclick="openCity(event, 'C#')">Tokyo</button>
</div>

<div id="London" class="tabcontent">
  <h3>London</h3>
  <p>London is the capital city of England.</p>
</div>

<div id="Paris" class="tabcontent">
  <h3>Paris</h3>
  <p>Paris is the capital of France.</p> 
</div>

<div id="C#" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

@endsection

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector(".tablinks").click();
});
</script>





<!-- resources/views/snippets/show.blade.php -->
<!-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $snippet->name }}</h1>
    <p>Type: {{ $snippet->type }}</p>
    <p>UID: {{ $snippet->uid }}</p>

    <h2>Related Codes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Language</th>
                <th>Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($snippet->codes as $code)
                <tr>
                    <td>{{ $code->id }}</td>
                    <td>{{ $code->lang->name }}</td>
                    <td>
                        <pre><code class="language-{{ strtolower($code->lang->name) }}">{{ $code->code }}</code></pre>
                    </td>
                </tr>
            @endforeach

            



            @foreach ($snippet->codes as $code)
                <pre><code class="language-{{ $code->lang_id }}">{{ $code->code }}</code></pre>
            @endforeach

            <h2>Using Highlight.js</h2>
            @foreach ($snippet->codes as $code)
                <pre><code class="language-{{ $code->lang_id }}">{{ $code->code }}</code></pre>
            @endforeach



        </tbody>
    </table>
</div>
@endsection -->
