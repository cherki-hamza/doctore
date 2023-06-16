@extends('layouts.master')

@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to DONORNATION</h1>
            <h2>Be the reason for someone's heartbeat</h2>
            <h3>One pint of blood can save the live </h3>

            <a href="{{ route('donner_sang') }}" class="btn-get-started scrollto">Donner du sang </a>
            <a href="{{ url('/blood-donation-process') }}" class="btn-get-started1 scrollto">S'informer </a>
        </div>
    </section><!-- End Hero -->

    <section class="RRR">

        <div style="align-content: center" class="flex-container flex text-center">

            <div class="flex-box1">
                <div>
                    <h1> Lieu de don </h1>
                </div>

                <div> <button> SAVOIR PLUS</button></div>
            </div>

            <div class="flex-box2">
                <div>
                    <h1> Critere de don </h1>
                </div>
                <div> <button> SAVOIR PLUS</button> </div>
            </div>

            <div class="flex-box3">
                <div>
                    <h1> Processus de don </h1>
                </div>
                <div><button> SAVOIR PLUS</button></div>
            </div>

        </div>
    </section>

    <!-- ======= CONTACT US Section ======= -->


    <section id="contact-us" class="contact-us section-bg">
        <div class="container">
            @if (session('success'))
                <div class="row">
                    <div class="col-md-6 mx-auto text-center">
                        <div class="alert alert-success">{{ session('success') }}</div>
                    </div>
                </div>
            @endif
            <div class="section-title">
                <h2>Contactez-Nous</h2>
                <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
            </div>

            <form role="form" class="php-email-form" action="{{ url('/contact') }}" method="POST">
                @csrf
                <div class="row" style="margin-bottom: 13px;">
                    <div class="col-md-5 form-group" style="margin-right: 87px;margin-left: 11px; ">
                        <input type="text" name="Name" class="form-control" id="Name" placeholder="Votre Nom"
                            data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                        <!-- <div class="validate"></div> -->
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control" name="Email" id="Email" placeholder="Votre Email"
                            data-rule="email" data-msg="Please enter a valid email">
                        <!-- <div class="validate"></div> -->
                    </div>
                </div>

                <div class="col-md-12 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="Object" id="Object" placeholder="Objet"
                        data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                    <!-- <div class="validate"></div> -->
                </div>

                <div class="form-group mt-3">
                    <textarea class="form-control" name="Message" rows="5" placeholder="Message"></textarea>
                    <div class="validate"></div>
                </div>
                <!-- <div class="mb-3">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your Message has been sent successfully. Thank you!</div>
                    </div> -->
                <div class="text-center"><button type="submit">Envoyer Message</button></div>
            </form>

        </div>
    </section>
    <!-- End CONTACT US Section -->
@endsection

