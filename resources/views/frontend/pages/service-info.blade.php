@extends('layouts.app')

@section('title', 'Service History - Hospital Management')

@push('styles')
<style>
    /* --- Custom Styles --- */
    .service-sidebar {
        background: var(--sidebar-bg);
        border-radius: 14px;
        border: 1.5px solid var(--sidebar-border);
        padding: 18px 0;
    }

    .service-sidebar h4 {
        text-align: center;
        font-size: 1.12em;
        font-weight: 600;
        margin-bottom: 18px;
        color: #444;
    }

    .service-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .service-list li {
        padding: 9px 24px;
        color: #222;
        border-left: 3px solid transparent;
        font-size: 15px;
        transition: all 0.2s;
    }

    .service-list li.active,
    .service-list li:hover {
        background: #eaf7fa;
        border-left: 3px solid var(--sidebar-active);
        color: var(--sidebar-active);
        font-weight: 600;
    }

    .service-list li i {
        float: right;
        font-size: 13px;
        margin-top: 3px;
    }

    .service-content {
        background: var(--main-bg);
        border-radius: 18px;
        padding: 32px;
        box-shadow: 0 2px 18px rgba(44, 140, 153, 0.07);
        margin-bottom: 34px;
    }

    .service-title {
        font-size: 1.5em;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .service-section-header {
        font-size: 1.1em;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .service-desc {
        margin-bottom: 18px;
        line-height: 1.6;
        color: #444;
    }
</style>
@endpush

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container my-4">
    <div class="row">
        <!-- Sidebar -->
        <aside class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
            <div class="service-sidebar">
                <h4>Our Services</h4>
                <ul class="service-list">
                    @foreach($services as $s)
                        <li class="my-1 {{ $service->id == $s->id ? 'active' : '' }}">
                            <a href="{{ route('app.service.history', ['service' => $s->id, 'title' => Str::slug($s->title)]) }}" class="text-decoration-none d-block">
                                {{ Str::limit($s->title, 25) }} <i class="fa fa-chevron-right"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Service Content -->
        <section class="col-12 col-md-8 col-lg-9">
            <div class="service-content">
                <div class="service-title">{{ $service->title }}</div>

                <div class="service-section-header">About {{ $service->title }} Services</div>

                <div class="service-desc">
                    {!! $service->description ?? 'No description available.' !!}
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
