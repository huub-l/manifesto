{{--
  Template Name: Team Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.mastheads.default-masthead')
    @include('partials.section-team-intro')
    @include('partials.section-team')
  @endwhile
@endsection
