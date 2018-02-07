@php
  $images = get_field('photo_gallery');
  $size = 'large';
  $lower_content = get_field('lower_content')
@endphp
<section class="blog-content">
  <article @php(post_class('container')) >
    <div class="entry-content">
      @php(the_content())
    </div>
    @if( $images )
      <div class="blog-slider @if(!$lower_content)alt-bg @endif">
        @foreach( $images as $image )
          {!! wp_get_attachment_image( $image['ID'], $size ) !!}
        @endforeach
      </div>
    @endif
    @if($lower_content)
      <div class="lower-content">
        {!! $lower_content !!}
      </div>
    @endif
  </article>
</section>
