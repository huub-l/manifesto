{{--
    This is a single product being rendered for the main page overview
    Here we actually load product related content like images etc.
    This is still just a overview of a single product.
    for example the main page of the shop (archive.product.blade.php)

    With the global $product we are able to access all it's contents
    Use Woocommerce/includes/abstracts/abastract-wc-product.php for reference
--}}

@php
    global $product;
@endphp

<a href="{{get_permalink()}}" class="col-lg-4 d-flex product-card">
  {!!woocommerce_get_product_thumbnail()!!}
  <h3>{{get_the_title()}}</h3>
  <h5>{!!$product->get_short_description()!!}</h5>
  <p>{!! $product->get_price_html() !!}</p>
</a>
