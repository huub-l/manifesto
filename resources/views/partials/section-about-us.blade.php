@php
  $image_block = get_field( 'about_image_block' );
  $about_text_block = get_field('about_text_block');
@endphp

<section class="section-about-us">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 content-left mr-auto">
        <div class="img-border">
          @if($image_block)
            <img src="{{$image_block}}">
          @endif
        </div>
      </div>
      <div class="col-lg-5 content-right ml-auto">
        @if($about_text_block['text_content'])
          <div class="about-us-text">
            {!!$about_text_block['text_content']!!}
          </div>
        @endif
        @if($about_text_block['button_link'])
          <div>
            <a class="btn" href="{{$about_text_block['button_link']}}">{{$about_text_block['button_text']}}</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
