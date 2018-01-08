@php
  $img_1 = get_field('image_1');
  $img_2 = get_field('image_2');
  $img_3 = get_field('image_3');
@endphp

<section class="photo-collage">
  <div class="filler-top"></div>
  <div class="container">
    <div class="row">
      <div class="photo-1 col-5">
        @if($img_1)
          <img src="{{$img_1['url']}}" alt="@if($img_1['alt']){{$img_1['alt']}}@else{{$img_1['title']}}@endif">
        @endif
      </div>
      <div class="photo-2 img-border col-9">
        @if($img_2)
          <img class="img-up" src="{{$img_2['url']}}" alt="@if($img_2['alt']){{$img_2['alt']}}@else{{$img_2['title']}}@endif">
        @endif
      </div>
      <div class="photo-3 col-4 offset-md-2">
        @if($img_3)
          <img src="{{$img_3['url']}}" alt="@if($img_3['alt']){{$img_3['alt']}}@else{{$img_3['title']}}@endif">
        @endif
      </div>
    </div>
  </div>
</section>
