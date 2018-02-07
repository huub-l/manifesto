@php
  $categories = get_categories();
@endphp

<section class="blog-filter">
  <div class="container d-flex">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="blog-cat dropdown-item" href="/blog/">All</a>
        @foreach( $categories as $category )
          <a class="blog-cat dropdown-item" href="/blog/category/{{$category->slug}}/">{{$category->name}}</a>
        @endforeach
      </div>
    </div>
  </div>
</section>
