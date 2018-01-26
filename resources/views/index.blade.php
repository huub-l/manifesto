@extends('layouts.app')

@section('content')
  @include('partials.mastheads.default-masthead')
  @include('partials.blog-filter')

    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      {!! get_search_form(false) !!}
    @endif
    <section class="featured-posts">
      <div class="container">
        <div class="row no-gutters">

        @while (have_posts()) @php(the_post())
          @include('partials.content-'.get_post_type())
        @endwhile

        </div>
      </div>
    </section>
  {!! get_the_posts_navigation() !!}
@endsection
