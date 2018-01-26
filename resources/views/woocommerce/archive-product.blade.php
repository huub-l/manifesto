@extends('layouts.app')

@section('content')
  @include('partials.mastheads.default-masthead')
  @include('partials.products-filter')
  <section class="products-wrapper">
    <div class="container">
      <div class="row">
        @while(have_posts()) @php(the_post())

          {{ App\wc_get_template_part('content', 'product', null, get_defined_vars()) }}

        @endwhile
      </div>
    </div>
  </section>
  @include('partials.section-wholesale')
@endsection
