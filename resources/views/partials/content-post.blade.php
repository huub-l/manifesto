@php
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
