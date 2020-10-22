<div id="header-site-top">
    <nav class="menu" tabindex="0">
        <div class="smartphone-menu-trigger"></div>
        <header class="avatar">
            <img src="/storage/profile_images/{{ Auth::user()->profile_image }}" />
            <h2>{{ Auth::user()->name }}</h2>
        </header>
        <ul>
            <h3 class="ml-3">Posts</h3>
            <li class="icon-dashboard"><span><a href="/yourposts">Your Posts</a></span></li>
            <li class="icon-customers"><span><a href="/posts">All Posts</a></span></li>
            <hr>
            <h3 class="ml-3"> Social</h3>
            <li class="icon-users"><span><a href="/users">User List</a></span></li>
            <li class="icon-users"><span><a href="/galleries">Gallery</a></span></li>
            @if (Auth::user()->user_role == 'Admin')
                <hr>
                <h3 class="ml-3">Administration</h3>
                <li class="icon-settings"><span><a href="/categories">Categories Administration</a></span></li>
            @endif
        </ul>
    </nav>
</div>
