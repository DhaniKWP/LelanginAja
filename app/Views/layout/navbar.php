<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="/">LelanginAja</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item mx-2"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item mx-2"><a class="nav-link" href="/#kategori">Kategori</a></li>
        <li class="nav-item mx-2"><a class="nav-link" href="/#lelang">Lelang</a></li>

        <?php if(session()->get('logged_in')): ?>
            <li class="nav-item mx-2">
                <a class="btn btn-primary px-3" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item ms-2">
                <a class="btn btn-outline-danger" href="/logout">Logout</a>
            </li>
        <?php else: ?>
            <li class="nav-item mx-2">
                <a class="btn btn-outline-primary px-3" href="/login">Login</a>
            </li>
            <li class="nav-item ms-2">
                <a class="btn btn-primary px-3" href="/register">Register</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
