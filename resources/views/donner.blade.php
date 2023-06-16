@extends('layouts.master')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('public/css/donner.css')}}" rel="stylesheet">
</head>
@section("content")
    <section id="donner" class="d-flex align-items-center">
        <div class="left">
          <h1>Exigences pour le don <br>
               de sang<br></h1>
          <h2>Voici quelques-unes des exigences que les donneurs<br>
              doivent respecter pour être éligibles au don de sang<br>
              en fonction de leur type de don. </h2>
          <h3>Don de sang</h3>
          <h4><i class="fa-solid fa-angle-right fa-xs" style="color: #1e3050;"></i> Fréquence de don : Tous les 56 jours.</h4>
          <h4><i class="fa-solid fa-angle-right fa-xs" style="color: #1e3050;"></i> Vous devez être en bonne santé et vous sentir bien.</h4>
          <h4><i class="fa-solid fa-angle-right fa-xs" style="color: #1e3050;"></i> Vous devez avoir au moins 16 ans.</h4>
          <h4><i class="fa-solid fa-angle-right fa-xs" style="color: #1e3050;"></i> Vous devez peser au moins 50kg.</h4>

          <h2>Si vous avez des questions concernant votre éligibilité,<br>
             veuillez nous appeler au +212 537 77 33 24 </h2>
    
          <a href="#about" class="btn-get-started scrollto"> Learn more </a>
          <a href="{{ route('register') }}" class="btn-get-started1 scrollto">Donner </a>
        </div>

        <div class="right">
            <img class="image" src="{{asset('public/img/donner.jpg')}}" alt="Image">
        </div>
      </section>
@endsection