@extends('layouts.app')

@section('content')
  @include('partials.mastheads.default-masthead')
  <div class="page-content">
    <div class="container">
      @while(have_posts()) @php(the_post())
        @include('partials.content-page')
      @endwhile
    </div>
  </div>
@endsection
