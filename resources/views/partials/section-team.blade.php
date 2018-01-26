<section class="team">
  <div class="container">
    <h2><strong>Meet the</strong> Manifesto Team</h2>
    <div class="row no-gutters">
      @php
        $args = array(
          'post_type' => 'team'
        );
        $team = new WP_Query( $args );
      @endphp

        @if( $team->have_posts() )
          @while( $team->have_posts() )
            @php($team->the_post())
            <div class="team-member col-md-4">
              <div class="team-photo" style="background: url({{get_the_post_thumbnail_url()}})no-repeat center center; background-size: cover;">
              </div>
              <div class="team-info">
                <h3>{{the_title()}}</h3>
                {{the_content()}}
              </div>
            </div>
          @endwhile
          @php(wp_reset_postdata())
        @endif
    </div>
  </div>
</section>
