@php
  $image_block = get_field( 'company_image_block');
  $company_text_block = get_field('company_text_block');
@endphp
<section class="section-team-intro">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 content-left mr-auto">
        @if($company_text_block)
          <div class="wholesale-text">
            {!!$company_text_block!!}
          </div>
        @endif
      </div>
      <div class="col-lg-6 content-right ml-auto">
        <div class="img-border">
          @if($image_block)
            <img src="{{$image_block}}">
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="team-intro-overflow"></div>
</section>
