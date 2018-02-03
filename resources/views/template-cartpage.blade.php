{{--
  Template Name: Cart Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.mastheads.breadcrumb-only')
    @include('partials.content-wysiwyg')
    @include('partials.cart')
    @include('partials.section-wholesale')
  @endwhile
@endsection
