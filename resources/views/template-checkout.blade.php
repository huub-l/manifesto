{{--
  Template Name: Checkout Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.mastheads.breadcrumb-only')
    @include('partials.checkout')
  @endwhile
@endsection
