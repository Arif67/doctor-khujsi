@extends('layouts.app')

@section('title', __('Health Blog - Doctor Finder'))
@section('meta_description', __('Read patient-friendly health articles, doctor booking tips, hospital guidance, and practical medical insights on the Doctor Finder blog.'))
@section('meta_keywords', 'health blog, doctor finder blog, hospital guidance, doctor booking tips, patient articles')
@section('og_title', __('Health Blog - Doctor Finder'))
@section('og_description', __('Read patient-friendly health articles, doctor booking tips, hospital guidance, and practical medical insights on the Doctor Finder blog.'))
@section('og_image', asset('assets/img/register.jpg'))

@push('styles')
<style>
    .blog-page {
        padding: 42px 0 56px;
    }

    .blog-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(280px, 0.9fr);
        gap: 28px;
        align-items: start;
    }

    .blog-hero-card {
        padding: 36px;
        background:
            radial-gradient(circle at top right, rgba(244, 162, 97, 0.18), transparent 26%),
            linear-gradient(145deg, #f2fbfb 0%, #ffffff 62%);
        overflow: hidden;
        position: relative;
    }

    .blog-hero-card::after {
        content: "";
        position: absolute;
        inset: auto -90px -90px auto;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(18, 124, 138, 0.08);
    }

    .blog-hero-copy {
        position: relative;
        z-index: 1;
        max-width: 680px;
    }

    .blog-hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 28px;
    }

    .blog-hero-stat {
        min-width: 150px;
        padding: 16px 18px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid rgba(21, 58, 63, 0.08);
        backdrop-filter: blur(8px);
    }

    .blog-hero-stat strong {
        display: block;
        font-family: "Sora", sans-serif;
        font-size: 1.45rem;
        color: var(--brand-ink);
    }

    .blog-toolbar,
    .blog-sidebar-card,
    .blog-featured-card,
    .blog-card {
        padding: 26px;
    }

    .blog-toolbar-form {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(220px, 0.8fr) auto;
        gap: 14px;
    }

    .blog-input,
    .blog-select {
        width: 100%;
        border-radius: 16px;
        border: 1px solid rgba(18, 124, 138, 0.16);
        padding: 14px 16px;
        background: #fff;
        color: var(--brand-ink);
        outline: none;
    }

    .blog-input:focus,
    .blog-select:focus {
        border-color: rgba(18, 124, 138, 0.55);
        box-shadow: 0 0 0 4px rgba(18, 124, 138, 0.08);
    }

    .blog-featured-card {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(320px, 0.95fr);
        gap: 26px;
        align-items: stretch;
        overflow: hidden;
    }

    .blog-featured-media img,
    .blog-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .blog-featured-media {
        min-height: 320px;
        border-radius: 24px;
        overflow: hidden;
        background: #dceff0;
    }

    .blog-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 18px;
        color: var(--brand-muted);
        font-size: 0.92rem;
    }

    .blog-category-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(18, 124, 138, 0.08);
        color: var(--brand-primary-dark);
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
    }

    .blog-featured-title,
    .blog-card-title {
        font-family: "Sora", sans-serif;
        color: var(--brand-ink);
        text-decoration: none;
    }

    .blog-featured-title {
        font-size: clamp(2rem, 3vw, 2.9rem);
        line-height: 1.02;
        letter-spacing: -0.04em;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .blog-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .blog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 28px 60px rgba(15, 55, 60, 0.11);
    }

    .blog-card-media {
        aspect-ratio: 16 / 10;
        border-radius: 22px;
        overflow: hidden;
        background: #e5f2f4;
        margin-bottom: 22px;
    }

    .blog-card-title {
        font-size: 1.3rem;
        line-height: 1.18;
    }

    .blog-card-copy,
    .blog-featured-copy {
        color: var(--brand-muted);
        font-size: 1rem;
        line-height: 1.8;
    }

    .blog-link-arrow {
        color: var(--brand-primary-dark);
        font-weight: 700;
        text-decoration: none;
    }

    .blog-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
        position: sticky;
        top: 118px;
    }

    .blog-category-list,
    .blog-mini-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .blog-category-link,
    .blog-mini-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        text-decoration: none;
        color: var(--brand-ink);
        padding: 14px 16px;
        border-radius: 18px;
        border: 1px solid rgba(21, 58, 63, 0.08);
        background: #fff;
        transition: border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .blog-category-link:hover,
    .blog-category-link.is-active,
    .blog-mini-link:hover {
        border-color: rgba(18, 124, 138, 0.28);
        transform: translateY(-2px);
        box-shadow: 0 18px 34px rgba(15, 55, 60, 0.08);
    }

    .blog-category-count {
        color: var(--brand-muted);
        font-size: 0.85rem;
        font-weight: 700;
    }

    .blog-mini-link {
        align-items: flex-start;
    }

    .blog-mini-thumb {
        width: 78px;
        height: 78px;
        border-radius: 18px;
        object-fit: cover;
        flex-shrink: 0;
        background: #e3f1f2;
    }

    .blog-empty-state {
        padding: 56px 28px;
        text-align: center;
    }

    @media (max-width: 1199.98px) {
        .blog-shell,
        .blog-featured-card {
            grid-template-columns: 1fr;
        }

        .blog-sidebar {
            position: static;
        }
    }

    @media (max-width: 991.98px) {
        .blog-page {
            padding-top: 28px;
        }

        .blog-grid,
        .blog-toolbar-form {
            grid-template-columns: 1fr;
        }

        .blog-hero-card,
        .blog-toolbar,
        .blog-sidebar-card,
        .blog-featured-card,
        .blog-card {
            padding: 22px;
        }
    }

    @media (max-width: 575.98px) {
        .blog-hero-stats {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
@php
    $featuredBlog = $blogs->first();
    $secondaryBlogs = $blogs->skip(1);
    $selectedCategory = $categories->firstWhere('id', $selectedCategoryId);
@endphp

<section class="blog-page">
    <div class="container px-4 px-md-0">
        <div class="surface-card blog-hero-card mb-4 mb-lg-5">
            <div class="blog-hero-copy">
                <span class="section-eyebrow mb-3">{{ __('Health stories') }}</span>
                <h1 class="section-title mb-3">{{ __('Premium reading experience for practical medical insight.') }}</h1>
                <p class="muted-copy fs-5 mb-0">{{ __('Doctor Finder blog-e patient-friendly guidance, hospital awareness, booking tips, and healthcare updates ek jaygay paben.') }}</p>

                <div class="blog-hero-stats">
                    <div class="blog-hero-stat">
                        <strong>{{ $blogs->count() }}</strong>
                        <span class="muted-copy">{{ __('Published articles') }}</span>
                    </div>
                    <div class="blog-hero-stat">
                        <strong>{{ $categories->count() }}</strong>
                        <span class="muted-copy">{{ __('Topics covered') }}</span>
                    </div>
                    <div class="blog-hero-stat">
                        <strong>{{ $selectedCategory?->name ?? 'All' }}</strong>
                        <span class="muted-copy">{{ __('Current view') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="blog-shell">
            <div class="blog-main">
                <div class="surface-card blog-toolbar mb-4">
                    <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-end justify-content-between gap-3 mb-4">
                        <div>
                            <span class="section-eyebrow mb-3">{{ __('Browse articles') }}</span>
                            <h2 class="h3 mb-2">{{ __('Find the right topic faster.') }}</h2>
                            <p class="muted-copy mb-0">{{ __('Search by keyword or narrow the list by category.') }}</p>
                        </div>
                        <a href="{{ route('app.blog') }}" class="btn-brand-secondary">{{ __('Reset View') }}</a>
                    </div>

                    <form action="{{ route('app.blog') }}" method="GET" class="blog-toolbar-form">
                        <input type="text" name="search" class="blog-input" value="{{ $search }}" placeholder="{{ __('Search title, summary, or topic') }}">
                        <select name="category" class="blog-select">
                            <option value="">{{ __('All categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($selectedCategoryId === $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-brand-primary">{{ __('Apply Filter') }}</button>
                    </form>
                </div>

                @if ($featuredBlog)
                    <article class="surface-card blog-featured-card mb-4">
                        <div class="blog-featured-copy-wrap d-flex flex-column justify-content-between gap-4">
                            <div>
                                <a href="{{ route('app.blog', ['category' => $featuredBlog->category_id]) }}" class="blog-category-pill">
                                    <i class="fas fa-layer-group"></i>
                                    {{ $featuredBlog->category?->name ?? __('Health article') }}
                                </a>
                                <h2 class="blog-featured-title mt-4 mb-3">
                                    <a href="{{ route('app.blog.info', ['blog' => $featuredBlog->id, 'slug' => \Illuminate\Support\Str::slug($featuredBlog->title)]) }}" class="blog-featured-title">
                                        {{ $featuredBlog->title }}
                                    </a>
                                </h2>
                                <div class="blog-meta-row mb-3">
                                    <span><i class="fas fa-calendar-alt me-2"></i>{{ $featuredBlog->created_at->format('d M Y') }}</span>
                                    <span><i class="fas fa-book-open me-2"></i>{{ __('Featured story') }}</span>
                                </div>
                                <p class="blog-featured-copy mb-0">
                                    {{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($featuredBlog->short_description ?: $featuredBlog->content ?: 'Patient-first practical guidance and hospital discovery insight.')), 220) }}
                                </p>
                            </div>

                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('app.blog.info', ['blog' => $featuredBlog->id, 'slug' => \Illuminate\Support\Str::slug($featuredBlog->title)]) }}" class="btn-brand-primary">{{ __('Read Article') }}</a>
                                <a href="{{ route('app.booking') }}" class="btn-brand-secondary">{{ __('Book a Doctor') }}</a>
                            </div>
                        </div>

                        <div class="blog-featured-media">
                            <img src="{{ $featuredBlog->featured_image ? asset('storage/' . $featuredBlog->featured_image) : ($featuredBlog->thumbnail_image ? asset('storage/' . $featuredBlog->thumbnail_image) : asset('assets/img/register.jpg')) }}" alt="{{ $featuredBlog->title }}">
                        </div>
                    </article>
                @endif

                @if ($secondaryBlogs->isNotEmpty())
                    <div class="blog-grid">
                        @foreach ($secondaryBlogs as $blog)
                            <article class="surface-card blog-card">
                                <a href="{{ route('app.blog.info', ['blog' => $blog->id, 'slug' => \Illuminate\Support\Str::slug($blog->title)]) }}" class="blog-card-media">
                                    <img src="{{ $blog->thumbnail_image ? asset('storage/' . $blog->thumbnail_image) : ($blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('assets/img/register.jpg')) }}" alt="{{ $blog->title }}">
                                </a>

                                <div class="blog-meta-row mb-3">
                                    <span>{{ $blog->created_at->format('d M Y') }}</span>
                                    <span>{{ $blog->category?->name ?? 'General' }}</span>
                                </div>

                                <h3 class="blog-card-title mb-3">
                                    <a href="{{ route('app.blog.info', ['blog' => $blog->id, 'slug' => \Illuminate\Support\Str::slug($blog->title)]) }}" class="blog-card-title">
                                        {{ $blog->title }}
                                    </a>
                                </h3>

                                <p class="blog-card-copy mb-4">
                                    {{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($blog->short_description ?: $blog->content ?: 'Helpful article summary will appear here.')), 120) }}
                                </p>

                                <div class="mt-auto d-flex justify-content-between align-items-center gap-3">
                                    <a href="{{ route('app.blog', ['category' => $blog->category_id]) }}" class="blog-category-pill">
                                        {{ $blog->category?->name ?? __('General') }}
                                    </a>
                                    <a href="{{ route('app.blog.info', ['blog' => $blog->id, 'slug' => \Illuminate\Support\Str::slug($blog->title)]) }}" class="blog-link-arrow">
                                        {{ __('Read more') }} <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @elseif (! $featuredBlog)
                    <div class="surface-card blog-empty-state">
                        <span class="section-eyebrow mb-3">{{ __('No articles') }}</span>
                        <h2 class="h3 mb-2">{{ __('No blog matched this filter.') }}</h2>
                        <p class="muted-copy mb-4">{{ __('Search keyword ba category change kore abar try korun.') }}</p>
                        <a href="{{ route('app.blog') }}" class="btn-brand-primary">{{ __('View All Articles') }}</a>
                    </div>
                @endif
            </div>

            <aside class="blog-sidebar">
                <div class="surface-card blog-sidebar-card">
                    <span class="section-eyebrow mb-3">{{ __('Categories') }}</span>
                    <h3 class="h4 mb-3">{{ __('Explore by topic') }}</h3>
                    <div class="blog-category-list">
                        <a href="{{ route('app.blog') }}" class="blog-category-link {{ $selectedCategoryId ? '' : 'is-active' }}">
                            <span>{{ __('All Articles') }}</span>
                            <span class="blog-category-count">{{ $categories->sum('blogs_count') }}</span>
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('app.blog', ['category' => $category->id]) }}" class="blog-category-link {{ $selectedCategoryId === $category->id ? 'is-active' : '' }}">
                                <span>{{ $category->name }}</span>
                                <span class="blog-category-count">{{ $category->blogs_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="surface-card blog-sidebar-card">
                    <span class="section-eyebrow mb-3">{{ __('Quick actions') }}</span>
                    <h3 class="h4 mb-2">{{ __('Need a doctor now?') }}</h3>
                    <p class="muted-copy mb-4">{{ __('Blog porar por doctor lagle direct booking flow-te chole jan.') }}</p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('app.booking') }}" class="btn-brand-primary">{{ __('Book Appointment') }}</a>
                        <a href="{{ route('app.specialists') }}" class="btn-brand-secondary">{{ __('Browse Doctors') }}</a>
                    </div>
                </div>

                @if ($featuredBlog)
                    <div class="surface-card blog-sidebar-card">
                        <span class="section-eyebrow mb-3">{{ __('Latest read') }}</span>
                        <h3 class="h4 mb-3">{{ __('Fresh from the desk') }}</h3>
                        <div class="blog-mini-list">
                            @foreach ($blogs->take(4) as $miniBlog)
                                <a href="{{ route('app.blog.info', ['blog' => $miniBlog->id, 'slug' => \Illuminate\Support\Str::slug($miniBlog->title)]) }}" class="blog-mini-link">
                                    <img class="blog-mini-thumb" src="{{ $miniBlog->thumbnail_image ? asset('storage/' . $miniBlog->thumbnail_image) : ($miniBlog->featured_image ? asset('storage/' . $miniBlog->featured_image) : asset('assets/img/register.jpg')) }}" alt="{{ $miniBlog->title }}">
                                    <span class="min-w-0">
                                        <span class="d-block small muted-copy mb-2">{{ $miniBlog->created_at->format('d M Y') }}</span>
                                        <span class="d-block fw-semibold text-dark">{{ \Illuminate\Support\Str::limit($miniBlog->title, 60) }}</span>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</section>
@endsection
