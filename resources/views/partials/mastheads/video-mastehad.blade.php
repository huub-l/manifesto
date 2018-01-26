@php
  $video_url = get_field( 'video_url' );
  $fallback_image = get_field('fallback_image');
  $mast_text_line_1 = get_field('mast_text_line_1');
  $mast_text_line_2 = get_field('mast_text_line_2');
  $mast_text_line_3 = get_field('mast_text_line_3');
  $masthead_button_text = get_field('masthead_button_text');
  $masthead_button_url = get_field('masthead_button_url');
@endphp

<section class="masthead video" style="background: url({{$fallback_image}}) no-repeat center center; background-size: cover;">
    <video id="video-background" class="video-masthead" autoplay loop muted plays-inline>
      <source src="{{$video_url}}" type="video/mp4">
    </video>
    <div class="mastehad-text">
      <h5>{{$mast_text_line_1}}</h5>
      <h1><strong>{{$mast_text_line_2}}</strong><br>{{$mast_text_line_3}}</h1>
      @if($masthead_button_url)
        <a href="{{$masthead_button_url}}" class="btn">{{$masthead_button_text}}</a>
      @endif
    </div>
    <a href="javascript:void(0)" id="page-down"><img src="@asset('images/page-down.png')"></a>
</section>
<div id="top-content"></div>
