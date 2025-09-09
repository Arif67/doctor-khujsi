@extends('layouts.app')

@section('title', 'Blog - Hospital Management')

@push('styles')

<style>

    .blog-hero {
        background: linear-gradient(90deg, #eaf8fa 0%, #fafdff 100%);
    }

    .blog-hero-img img {
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 6px 32px rgba(44, 140, 153, 0.13);
        background: #f3fafe;
        border: none;
    }

    .blog-tag {
        display: inline-block;
        background: #bbe0e4;
        color: #3a3939;
        font-weight: 600;
        font-size: 1em;
        border-radius: 20px;
        padding: 7px 22px;
        margin-bottom: 18px;
    }

    .blog-cards-section {
        padding: 60px 0px;
        background: #fff;
    }

    .blog-card {
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        padding: 0 0 18px 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .blog-card-img {
        width: 100%;
        border-radius: 12px 0px 0px;
        overflow: hidden;
        background: #fff;
    }

    .blog-card-img img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .blog-card-content {
        padding: 14px 16px 0 16px;
        flex: 1;
    }

    .blog-card-title {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 10px;
        color: #222;
    }

    .blog-card-readmore {
        color: #08c7df;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        margin-top: 8px;
    }

    .blog-card-readmore:hover {
        text-decoration: underline;
    }

</style>
@endpush

@section('content')


<section class="blog-hero py-5">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                 <div class="blog-hero-img">
                    <img src="{{asset('blogs/blog_1.png')}}" alt="Blog Hero">
                </div>
            </div>
            <div class="col-md-6">
                <div class="blog-hero-content">
                    <span class="blog-tag">News & Blog</span>
                    <h2 class="heading_title mb-4">Our Latest Insights & Updates</h2>
                    <p>World-class rehabilitation solutions and individualized recovery plans, from acute care to ongoing outpatient treatment and beyond.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-cards-section">
    <div class="container px-4 px-md-4">
        <div class="row row-gap-4">
            @foreach ($blogs as $blog)
                <div class="col-md-4 col-lg-3">
                    <a href="{{route('app.blog.info',['blog' => $blog->id, 'slug' => \Illuminate\Support\Str::slug($blog->title)])}}">
                        <div class="blog-card">
                            <div class="blog-card-img">
                                <img src="{{ $blog->thumbnail_image ? asset('storage/' . $blog->thumbnail_image) : 'https://lirp.cdn-website.com/83ac98e3/dms3rep/multi/opt/benefits-of-physiotherapy-01-1920w.jpg' }}" 
                                    alt="{{ $blog->title }}">
                            </div>
                            <div class="blog-card-content">
                                <div class="blog-card-title">Transitional Rehab: What to Expect</div>
                                <a href="{{route('app.blog.info',['blog' => $blog->id, 'slug' => \Illuminate\Support\Str::slug($blog->title)])}}" class="blog-card-readmore" href="">Read more &rarr;</a>
                            </div>
                        </div>
                    </a>
                </div>     
            @endforeach
        </div>
    </div>

</section>
@endsection