@extends('layouts.app')

@section('title', ($blog->meta_title ?: $blog->title) . ' - ' . __('Doctor Finder'))
@section('meta_description', $blog->meta_description ?: \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($blog->short_description ?: $blog->content ?: 'Doctor Finder health article.')), 155, ''))
@section('meta_keywords', $blog->meta_keywords ?: (($blog->category?->name ? $blog->category->name . ', ' : '') . 'doctor finder, health blog, medical article'))
@section('og_title', $blog->meta_title ?: $blog->title)
@section('og_description', $blog->meta_description ?: \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($blog->short_description ?: $blog->content ?: 'Doctor Finder health article.')), 155, ''))
@section('og_type', 'article')
@section('og_image', $blog->featured_image ? asset('storage/' . $blog->featured_image) : ($blog->thumbnail_image ? asset('storage/' . $blog->thumbnail_image) : asset('assets/img/register.jpg')))

@push('styles')
<style>
    .blog-detail-page {
        padding: 42px 0 56px;
    }

    .blog-detail-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.5fr) minmax(300px, 0.82fr);
        gap: 28px;
        align-items: start;
    }

    .blog-detail-hero,
    .blog-article-card,
    .blog-side-card,
    .blog-related-card {
        padding: 30px;
    }

    .blog-detail-hero {
        background:
            radial-gradient(circle at top right, rgba(244, 162, 97, 0.16), transparent 28%),
            linear-gradient(145deg, #f3fbfb 0%, #ffffff 66%);
    }

    .blog-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
        font-size: 0.95rem;
        color: var(--brand-muted);
    }

    .blog-breadcrumb a {
        color: var(--brand-primary-dark);
        text-decoration: none;
    }

    .blog-detail-title {
        font-family: "Sora", sans-serif;
        font-size: clamp(2.2rem, 4vw, 4rem);
        line-height: 1;
        letter-spacing: -0.05em;
        margin: 0;
    }

    .blog-detail-summary {
        color: var(--brand-muted);
        font-size: 1.1rem;
        line-height: 1.9;
        max-width: 760px;
    }

    .blog-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 20px;
        color: var(--brand-muted);
    }

    .blog-detail-cover {
        border-radius: 30px;
        overflow: hidden;
        background: #deeff0;
        margin-top: 28px;
    }

    .blog-detail-cover img {
        width: 100%;
        max-height: 560px;
        object-fit: cover;
        display: block;
    }

    .blog-article-card {
        overflow: hidden;
    }

    .blog-article-body {
        color: #264548;
        font-size: 1.03rem;
        line-height: 1.95;
    }

    .blog-article-body h1,
    .blog-article-body h2,
    .blog-article-body h3,
    .blog-article-body h4 {
        font-family: "Sora", sans-serif;
        color: var(--brand-ink);
        line-height: 1.12;
        margin-top: 1.8em;
        margin-bottom: 0.65em;
    }

    .blog-article-body p,
    .blog-article-body ul,
    .blog-article-body ol,
    .blog-article-body blockquote {
        margin-bottom: 1.2rem;
    }

    .blog-article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 24px;
        margin: 18px 0;
    }

    .blog-article-body blockquote {
        padding: 18px 22px;
        border-left: 4px solid var(--brand-primary);
        background: rgba(18, 124, 138, 0.06);
        border-radius: 0 18px 18px 0;
        color: var(--brand-primary-dark);
    }

    .blog-side-stack {
        display: flex;
        flex-direction: column;
        gap: 24px;
        position: sticky;
        top: 118px;
    }

    .blog-side-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .blog-side-link {
        display: flex;
        gap: 14px;
        text-decoration: none;
        color: var(--brand-ink);
        padding: 14px;
        border: 1px solid rgba(21, 58, 63, 0.08);
        border-radius: 18px;
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .blog-side-link:hover,
    .blog-category-filter:hover {
        transform: translateY(-2px);
        border-color: rgba(18, 124, 138, 0.26);
        box-shadow: 0 18px 34px rgba(15, 55, 60, 0.08);
    }

    .blog-side-thumb {
        width: 86px;
        height: 86px;
        border-radius: 18px;
        object-fit: cover;
        flex-shrink: 0;
        background: #dfeff1;
    }

    .blog-category-filter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 18px;
        border: 1px solid rgba(21, 58, 63, 0.08);
        text-decoration: none;
        color: var(--brand-ink);
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .blog-related-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .blog-related-card {
        height: 100%;
    }

    .blog-related-media {
        aspect-ratio: 16 / 10;
        border-radius: 22px;
        overflow: hidden;
        background: #e2f0f1;
        margin-bottom: 20px;
    }

    .blog-related-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 1199.98px) {
        .blog-detail-shell,
        .blog-related-grid {
            grid-template-columns: 1fr;
        }

        .blog-side-stack {
            position: static;
        }
    }

    @media (max-width: 991.98px) {
        .blog-detail-page {
            padding-top: 28px;
        }

        .blog-detail-hero,
        .blog-article-card,
        .blog-side-card,
        .blog-related-card {
            padding: 22px;
        }
    }
</style>
@endpush

@section('content')
<section class="blog-detail-page">
    <div class="container px-4 px-md-0">
        <div class="surface-card blog-detail-hero mb-4 mb-lg-5">
            <div class="blog-breadcrumb mb-4">
                <a href="{{ route('app.home') }}">{{ __('Home') }}</a>
                <span>/</span>
                <a href="{{ route('app.blog') }}">{{ __('Blog') }}</a>
                @if ($blog->category)
                    <span>/</span>
                    <a href="{{ route('app.blog', ['category' => $blog->category_id]) }}">{{ $blog->category->name }}</a>
                @endif
            </div>

            <a href="{{ route('app.blog', ['category' => $blog->category_id]) }}" class="blog-category-pill">
                <i class="fas fa-book-medical"></i>
                {{ $blog->category?->name ?? __('Health article') }}
            </a>

            <h1 class="blog-detail-title mt-4 mb-3">{{ $blog->title }}</h1>
            <p class="blog-detail-summary mb-4">
                {{ $blog->short_description ?: \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($blog->content ?: 'Patient-first medical guidance and doctor discovery content.')), 220) }}
            </p>

            <div class="blog-detail-meta">
                <span><i class="fas fa-calendar-alt me-2"></i>{{ $blog->created_at->format('d M Y') }}</span>
                <span><i class="fas fa-folder-open me-2"></i>{{ $blog->category?->name ?? __('General') }}</span>
                <span><i class="fas fa-stethoscope me-2"></i>{{ __('Doctor Finder Editorial') }}</span>
            </div>

            <div class="blog-detail-cover">
                <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : ($blog->thumbnail_image ? asset('storage/' . $blog->thumbnail_image) : asset('assets/img/register.jpg')) }}" alt="{{ $blog->title }}">
            </div>
        </div>

        <div class="blog-detail-shell">
            <div class="blog-content-column">
                <article class="surface-card blog-article-card">
                    <div class="blog-article-body">
                        {!! $blog->content !!}
                    </div>
                </article>

                @if ($relatedBlogs->isNotEmpty())
                    <div class="mt-4 mt-lg-5">
                        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-end justify-content-between gap-3 mb-4">
                            <div>
                                <span class="section-eyebrow mb-3">{{ __('Related reads') }}</span>
                                <h2 class="h3 mb-2">{{ __('Continue with similar topics.') }}</h2>
                                <p class="muted-copy mb-0">{{ __('Same category-r aro kichu useful article.') }}</p>
                            </div>
                            <a href="{{ route('app.blog') }}" class="btn-brand-secondary">{{ __('View All Articles') }}</a>
                        </div>

                        <div class="blog-related-grid">
                            @foreach ($relatedBlogs as $relatedBlog)
                                <article class="surface-card blog-related-card">
                                    <a href="{{ route('app.blog.info', ['blog' => $relatedBlog->id, 'slug' => \Illuminate\Support\Str::slug($relatedBlog->title)]) }}" class="blog-related-media d-block">
                                        <img src="{{ $relatedBlog->thumbnail_image ? asset('storage/' . $relatedBlog->thumbnail_image) : ($relatedBlog->featured_image ? asset('storage/' . $relatedBlog->featured_image) : asset('assets/img/register.jpg')) }}" alt="{{ $relatedBlog->title }}">
                                    </a>
                                    <div class="small muted-copy mb-2">{{ $relatedBlog->created_at->format('d M Y') }}</div>
                                    <h3 class="h5 mb-3">{{ $relatedBlog->title }}</h3>
                                    <p class="muted-copy mb-4">{{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($relatedBlog->short_description ?: $relatedBlog->content ?: '')), 110) }}</p>
                                    <a href="{{ route('app.blog.info', ['blog' => $relatedBlog->id, 'slug' => \Illuminate\Support\Str::slug($relatedBlog->title)]) }}" class="blog-link-arrow">{{ __('Read article') }} <i class="fas fa-arrow-right ms-1"></i></a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <aside class="blog-side-stack">
                <div class="surface-card blog-side-card">
                    <span class="section-eyebrow mb-3">{{ __('Recent posts') }}</span>
                    <h3 class="h4 mb-3">{{ __('Freshly published') }}</h3>
                    <div class="blog-side-list">
                        @foreach($recentBlogs as $recent)
                            <a href="{{ route('app.blog.info', ['blog' => $recent->id, 'slug' => \Illuminate\Support\Str::slug($recent->title)]) }}" class="blog-side-link">
                                <img class="blog-side-thumb" src="{{ $recent->thumbnail_image ? asset('storage/' . $recent->thumbnail_image) : ($recent->featured_image ? asset('storage/' . $recent->featured_image) : asset('assets/img/register.jpg')) }}" alt="{{ $recent->title }}">
                                <span class="min-w-0">
                                    <span class="d-block small muted-copy mb-2">{{ $recent->created_at->format('d M Y') }}</span>
                                    <span class="d-block fw-semibold text-dark mb-2">{{ \Illuminate\Support\Str::limit($recent->title, 64) }}</span>
                                    <span class="d-block muted-copy small">{{ $recent->category?->name ?? __('General') }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="surface-card blog-side-card">
                    <span class="section-eyebrow mb-3">{{ __('Topics') }}</span>
                    <h3 class="h4 mb-3">{{ __('Browse categories') }}</h3>
                    <div class="blog-side-list">
                        @foreach($categories as $category)
                            <a href="{{ route('app.blog', ['category' => $category->id]) }}" class="blog-category-filter">
                                <span>{{ $category->name }}</span>
                                <span class="small muted-copy">{{ $category->blogs_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="surface-card blog-side-card">
                    <span class="section-eyebrow mb-3">{{ __('Need care?') }}</span>
                    <h3 class="h4 mb-2">{{ __('Turn insight into action.') }}</h3>
                    <p class="muted-copy mb-4">{{ __('Article pore relevant doctor khujte chaile niche theke direct next step nin.') }}</p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('app.booking') }}" class="btn-brand-primary">{{ __('Book Appointment') }}</a>
                        <a href="{{ route('app.specialists') }}" class="btn-brand-secondary">{{ __('Find Doctors') }}</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
