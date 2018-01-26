@php
  if(is_woocommerce() || is_page( 58 )){
    $image_block = get_field( 'wholesale_image_block', 57 );
    $wholesale_text_block = get_field('wholesale_text_block', 57);
  }
@endphp
<section class="section-wholesale">
  <div class="wholesale-overflow"></div>
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
        @if($wholesale_text_block['text_content'])
          <div class="wholesale-text">
            {!!$wholesale_text_block['text_content']!!}
          </div>
        @endif
        @if($wholesale_text_block['button_link'])
          <div>
            <a class="btn" href="{{$wholesale_text_block['button_link']}}">{{$wholesale_text_block['button_text']}}</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
