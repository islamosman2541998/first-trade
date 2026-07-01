@extends('site.layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h1>Contact Us</h1>
                    <p>
                        Send us your message and our team will get back to you as soon as possible.
                    </p>

                    <ul class="list-unstyled">
                        <li><strong>Email:</strong> info@first-trade.test</li>
                        <li><strong>Phone:</strong> +20 000 000 0000</li>
                        <li><strong>WhatsApp:</strong> +20 000 000 0000</li>
                    </ul>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <livewire:site.contact-form />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection