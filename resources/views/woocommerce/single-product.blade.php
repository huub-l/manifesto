{{--
    This file is used to render a Single product.
    So if you clicked on a product from the main page it will send you to this file.
    Here we look for a product template, named content-single-product.blade.php
    and then render this file while posts have posts
--}}

@extends('layouts.app')

@section('content')
  @include('partials.mastheads.breadcrumb-only')
  <section class="single-product">
    <div class="container">
      <div class="row">
        @while(have_posts()) @php(the_post())

        {{ App\wc_get_template_part('content', 'single-product', null, get_defined_vars()) }}

        @endwhile
      </div>
    </div>
  </section>
  @include('partials.section-featured-coffee')
  @include('partials.section-wholesale')
@endsection
