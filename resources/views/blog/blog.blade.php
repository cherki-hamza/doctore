@extends('layouts.master')

@section('styles')
@stop

@section("content")
    <section id="doctors" class="doctors">
      <div class="container my-5">

        <div class="section-title">
          <h2>Blog Posts</h2>
        </div>

        <div class="row">

         @foreach ($posts as $post)
         <div class="col-lg-6">
            <div class="member d-flex align-items-start">
              <div class="image"><img src="{{ Voyager::image( $post->image ) }}" style="width: 850px;height: 200px;" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>{{ $post->title }}</h4>
                <span>Chief Medical Officer</span>
                <p>
                    {{ $post->excerpt  }}
                </p>
                <div class="my-4">
                    <a href="{{ $post->slug }}" style="padding: 12px 35px;margin-top: 30px 30px;background: #1977cc; color: #fff;transition: 0.4s;border-radius: 50px;width: 60px"  class="my_btn">Read More ..</a>
                </div>
              </div>
            </div>
          </div>
         @endforeach


        </div>



            <div  class="d-flex justify-content-center my-5">
                {!! $posts->links() !!}
            </div>


      </div>
    </section>
@endsection
