@php
  if(is_woocommerce()){
    $masthead_image = get_the_post_thumbnail_url(57, 'full');
    $masthead_text = '<strong>Shop</strong> Our Products';
  } else {
    $masthead_text = get_the_title();
    $masthead_image = get_the_post_thumbnail_url();
  }
@endphp
<section class="default masthead" style="background: url({{$masthead_image}})no-repeat center center; background-size: cover;">
  <div class="filter">
    <div class="container">
      <h1>{!!$masthead_text!!}</h1>
      <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
          @if(function_exists('bcn_display'))
            @php(bcn_display())
          @endif
      </div>
    </div>
  </div>
</section>
