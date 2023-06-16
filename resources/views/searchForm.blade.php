@extends('layouts.master')

@section('styles')
 {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
@stop

@section('content')

     <!-- start searsh form -->
     <section>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-10 rounded-3 shadow p-5 position-relative bg-white searchBox">
                    <h3 class="text-center mb-4">Trouver des donneurs de sang près de chez vous vous.</h3>
                    <form id="donorsSearchForm" method="POST" action="{{ route('donorsSearch') }}"
                        class="d-flex flex-column flex-xl-row gap-3" novalidate>
                        @csrf
                        <div class="w-100">
                            <select name="blood_group_id" id="bloodGroup" class="form-select form-select-lg" required>
                                @if (Route::is('donorsSearch') && $searchedBloodGroup !== null)

                                   <option selected  value="{{ $searchedBloodGroup->id }}">{{ $searchedBloodGroup->BloodGroup }}</option>
                                    @foreach ($bloodGroups as $bloodGroup)
                                        <option value="{{ $bloodGroup['id'] }}">{{ $bloodGroup['BloodGroup'] }} </option>
                                    @endforeach

                                @else

                                  <option selected hidden style="display:none" value=""> -- Type de sang --</option>
                                    @foreach ($bloodGroups as $bloodGroup)
                                        <option value="{{ $bloodGroup['id'] }}">{{ $bloodGroup['BloodGroup'] }} </option>
                                    @endforeach

                                @endif

                            </select>
                            <div class="invalid-feedback">
                                Ville
                            </div>
                        </div>
                        <div class="w-100">
                            <select name="city_id" id="villeSelect" class="form-select form-select-lg">
                                 @if (Route::is('donorsSearch') && $searchedCity !== null)

                                    <option selected  value="{{ $searchedCity->id }}">{{ $searchedCity->name }}</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['id'] }}">{{ $city['name'] }} </option>
                                    @endforeach

                                @else

                                   <option selected hidden style="display:none" value="">--Choisir une ville--</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['id'] }}">{{ $city['name'] }} </option>
                                    @endforeach

                                @endif


                            </select>
                            <div class="invalid-feedback">
                                ddddddddddddddddddddddd
                            </div>
                        </div>
                        <button class="btn btn-danger px-5 searchDonorsBtn" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end searsh form -->

<section>
  <div class="searchResult container d-flex flex-wrap gap-4 justify-content-center">

          <!-- start errors -->
           @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-center" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <!-- end errors -->

        <!-- start card -->
        @if ($allReadyToGiveDonors->isEmpty())
                <div class="alert alert-danger text-center" role="alert">
                    No donors found.
                </div>
        @else
        @foreach ($allReadyToGiveDonors as $donor)
             <div class="container shadow-lg donorCard d-flex flex-column">
                                <div class="donorInfo px-3 py-3 row">
                                    <div class="infos col-9">
                                        <span class="text-danger fs-4"><strong class="text-dark">Nom:</strong>
                                            {{ $donor->name }}</span>
                                        <br>
                                        <span class="text-danger fs-4"><strong class="text-dark">Prenom:</strong>
                                            {{ $donor->prenom }}</span>
                                        <br>
                                        <span class="text-danger fs-4"><strong class="text-dark">Ville:</strong>
                                            {{ $donor->city->name }}</span>
                                    </div>

                                    <div class="bloodGroup col-3 d-flex align-items-center">
                                        <span class="text-danger">{{ $donor->BloodGroup->bloodGroup }}</span>
                                    </div>
                                </div>

                                <div class="donorPhone bg-danger p-3 bg-light row">
                                    <a class="col-4 d-lg-none" href="tel:{{ $donor['phone_number'] }}">
                                        <button class="btn btn-success w-100" type="button">
                                            <svg class="d-lg-inline bg-success rounded-circle phoneIcon"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">

                                            </svg>
                                        </button>
                                    </a>
                                    <strong
                                        class="align-items-center justify-content-center d-flex col-8 col-lg-12 text-lg-center text-success fs-4"
                                        style="user-select: all;">
                                        <span><i class="fa-solid fa-phone"></i>&ensp;{{ $donor['phone_number'] }}</span>
                                    </strong>
                                </div>
                            </div>

             @endforeach

                 {{-- {{ $donors->links() }} --}}

        @endif
        <!-- end card -->


 </div>


</section>




@endsection
