@extends('layouts.app')

@push('styles')

<style>

    .bloginfo-section {
        padding:80px 0px;
    }

    .bloginfo-subtitle {
        color: #444;
        font-size: 14px;
        margin-bottom: 32px;
    }


    .bloginfo-hero-img img {
        width: 100%;
        max-width: 600px;
        border-radius: 16px;
        object-fit: cover;
    }

    .bloginfo-text {
        color: #444;
        font-size: 13px;
        margin-bottom: 24px;
    }


</style>

@endpush

@section('content')
    <section class="bloginfo-section">
       <div class="container">
            <div class="row">
                <div class="col-8">
                     <div class="heading_title mb-2">10 essential benefits of regular physiotherapy</div>
                        <div class="bloginfo-subtitle">When a serious injury, illness, or accident occurs a hospital stay is likely required and often involves acute or intensive medical care.</div>
                        <div class="bloginfo-hero-img mb-4">
                            <img src="https://i.postimg.cc/RCHJmZLM/image.png" alt="Hero">
                        </div>
                        <div class="bloginfo-text">
                            The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc. Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.
                        </div>
                </div>
                <div class="col-4"></div>
            </div>
       </div>
    </section>
@endsection