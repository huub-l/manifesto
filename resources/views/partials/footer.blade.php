@php
  $address = get_field('contact', 'option');
  $hours = get_field('hours_of_opperation', 'option');
  $phone_link = preg_replace('/[^0-9]/', '', $address['phone_number']);
@endphp
<footer class="content-info">
  <div class="footer-overflow"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 content-left">
        <h2><strong>Stay</strong> in touch</h2>
        <address>
          <h5>Manifesto Coffee</h5>
          <span>{{$address['address_line_1']}}</span><br>
          <span>{{$address['address_line_2']}}</span><br>
          <a href="tel:+1{{$phone_link}}"<span>{{$address['phone_number']}}</span></a>
        </address>
        <div class="hours">
          <h5>Hours of Opperation</h5>
          <span>{{$hours['hours_line_1']}}</span><br>
          <span>{{$hours['hours_line_2']}}</span><br>
          @if($hours['hours_line_3'])
            <span>{{$hours['hours_line_3']}}</span>
          @endif
        </div>
        <div class="social-Footer social-menu">
          @if( have_rows('social_media', 'option') )
            @while( have_rows('social_media', 'option') )
              @php(the_row())
                <a href={{the_sub_field('social_url')}}></a>
            @endwhile
          @endif
        </div>
      </div>
      <div class="col-lg-5 content-right">
        <div class="insta-border">
          <div id="instafeed">
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
