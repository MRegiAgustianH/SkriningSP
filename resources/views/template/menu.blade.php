<li class="nav-item {{ request()->segment(1) == '' || request()->segment(1) == 'home' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">Home </a>
</li>
<li class="nav-item {{ request()->segment(1) == 'diagnosis' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('diagnosis') }}"> Skrining</a>
</li>
<li class="nav-item {{ request()->segment(1) == 'artikel_pengunjung' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('artikel_pengunjung') }}"> Artikel</a>
</li>
<li class="nav-item {{ request()->segment(1) == 'about' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('about') }}">Tentang</a>
</li>
<!-- <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a>
</li> -->
