<!-- NavBar For Guest Users -->
<nav class="nav">
  <div class="nav-left">
      <a class="nav-item" href="/">
          {{--<img src="/img/logos/little_logo_black.png" alt="Booknshelf logo">--}}
          Booknshelf
      </a>
      <a class="nav-item" href="/books">
        Books
      </a>
      <a class="nav-item" href="/bookshelves">
        Bookshelves
      </a>
  </div>

  <div class="nav-center">
      <a class="nav-item">
        <span class="icon">
          <i class="fa fa-facebook"></i>
        </span>
      </a>
      <a class="nav-item">
        <span class="icon">
          <i class="fa fa-twitter"></i>
        </span>
      </a>
  </div>

  <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
  <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
  <span class="nav-toggle">
    <span></span>
    <span></span>
    <span></span>
  </span>

  <!-- This "nav-menu" is hidden on mobile -->
  <!-- Add the modifier "is-active" to display it on mobile -->
  <div class="nav-right nav-menu">
      <a class="nav-item is-active">
        Home
      </a>
      <a class="nav-item">
        About
      </a>

    <span class="nav-item">
        <a class="button" href="/login">
                Login
        </a>
        <a class="button is-primary" href="/register">
            <span class="icon">
                <i class="fa fa-flash"></i>
            </span>
            <span>Join</span>
        </a>
    </span>
  </div>
</nav>

