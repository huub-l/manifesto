<section class="featured-posts">
  <div class="container">
    <h2><strong>We specialize</strong> in all things coffee</h2>
    <div class="row no-gutters">
      @php
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 3,
        );

        $latest_posts = new WP_Query($args);

      @endphp
      @if($latest_posts->have_posts())
        @while($latest_posts->have_posts())
          @php
            $latest_posts->the_post();
            $category = get_the_category();
            $category = $category[0]->name;
          @endphp
          <a class="blog-post col-lg-4" href="{{get_permalink()}}">
            <div class="post-img" style="background: url({{the_post_thumbnail_url()}}) no-repeat center center; background-size: cover; padding-top: 100%;">
            </div>
            <div class="post-info">
              <h5>{{the_date('M d, y')}} | {{$category}}</h5>
              <h3>{{the_title()}}</h3>
            </div>
          </a>
        @endwhile
        @php(wp_reset_postdata())
      @endif
    </div>
  </div>
  <a class="btn" href="/blog">View All</a>
</section>
