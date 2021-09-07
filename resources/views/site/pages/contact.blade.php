@extends('site.main')

@section('content')
    <main>

        @include('site.layout.breadcrumbs')

        <section class="contact-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 pl-45">
                        <div class="section-title title-style-three mb-20">
                            <h2>CONTACT US ABOUT <span>PRESS</span></h2>
                        </div>
                        <div class="contact-info-list mb-40">
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i>Walking Park, Los Angeles, Brockland, USA</li>
                                <li><i class="fas fa-envelope"></i>info@cloux.com</li>
                            </ul>
                        </div>
                        <div class="contact-form">
                            <form action="{{ route('site.send-message') }}" method="post">
                                @csrf
                                <textarea name="message" id="message" placeholder="Write Message" required></textarea>
                                <input type="text" name="subject" id="subject" placeholder="Subject" required>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="Your Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <button type="submit">SUBMIT MESSAGE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
