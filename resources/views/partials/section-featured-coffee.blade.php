<section class="featured-coffee">
  <div class="container">
    <h2><strong>Our Featured</strong> coffees</h2>
    <div class="row">
      @php
        $args = array(
          'post_type'      => 'product',
          'posts_per_page' => 10,
          'product_cat'    => 'roasts'
        );

        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();
          global $product;
          @endphp

          <a href="{{get_permalink()}}" class="col-lg-4 d-flex coffee-product">
            {!!woocommerce_get_product_thumbnail()!!}
            <h3>{{get_the_title()}}</h3>
            <h5>{{$product->get_short_description()}}</h5>
          </a>

          @php
        endwhile;
        wp_reset_query();
      @endphp
    </div>
  </div>
</section>
