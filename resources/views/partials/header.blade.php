<header class="banner">
  <div class="header-container">
    <a class="brand" href="{{ home_url('/') }}>"><img src="{{ get_theme_mod( 'upload_logo') }}" class="header-logo" alt="{{ get_bloginfo('name', 'display') }}"</a>
    <nav id="mobile-header-menu">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
    <button id="mobile-menu-button">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>
