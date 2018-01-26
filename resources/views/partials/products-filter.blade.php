@php
  $product_categories = get_terms('product_cat');
@endphp

<section class="product-filter">
  <div class="container">
    <div class="filter-wrap">
      <a href="/shop/" class="product-cat">All</a>
      @foreach( $product_categories as $category )
        <a href="/shop/{{$category->slug}}/" class="product-cat">{{$category->name}}</a>
      @endforeach
    </div>
  </div>
</section>
