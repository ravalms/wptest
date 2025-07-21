@extends('layouts.app')

@section('content')
  {{-- @while(have_posts()) 
    @php(the_post()) --}}
    @include('woocommerce.content-single-product')
    @include('partials.product.custom-stories')
    @include('partials.product.custom-morelearn')
  {{-- @endwhile --}}
@endsection
