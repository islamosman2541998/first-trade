@extends('site.layouts.app')

@section('title', 'Request Quote')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="mb-4 text-center">
                        <h1>Request Quote</h1>
                        <p>
                            Fill the form below and our team will contact you with more details.
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <livewire:site.quote-request-form :product="request('product')" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection