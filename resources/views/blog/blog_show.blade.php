@extends('layouts.master')

@section('title')
  {{ $post->title }}
@stop

@section('styles')
@stop

@section("content")
    <section id="doctors" class="doctors">
      <div class="container my-5">

        <div class="section-title">
          <h2>{{ $post->title }}</h2>
        </div>

        <div class="row">
         <div class="col-lg-12">
            <div class="member">
              <div class="d-flex justify-content-center"><img src="{{ Voyager::image( $post->image ) }}" style="width: 80%;height: 500px"  class="image" alt="{{ $post->title }}"></div>
              <div class="my-5 d-flex justify-content-center">
                <h1>{{ $post->title }}</h1><br>

              </div>
              <p>
                    {!! $post->body  !!}
                </p>
            </div>
          </div>

          <div class="member my-5">
            <h6>Comments</h6>
          </div>


        </div>



      </div>
    </section>
@endsection
