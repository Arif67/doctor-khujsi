@extends('layouts.app')

@push('styles')
<style>
    .signle_blog_section{
        font-family: "Inter", sans-serif;
    }
    .blog_short_descritpion h2 {
        color: #000000;
        font-size: 48px;
        font-weight: 500;
        line-height: 100%;
    }

    .blog_short_descritpion p {
        color: #7F7F7F;
        font-size: 20px;
        font-weight: 500;
    }
    img.recent_blog_img {
        width: 100px;
        border-radius: 5px;
    }
    .recent_blog_item{
         border-top: 1px solid #f1f1f1;
        padding-top: 6px;
    }
    @media only screen and (max-width: 992px){
        .blog_short_descritpion h2{
            font-size: 25px;
        }
    }
</style>
@endpush

@section('content')
   <section class="signle_blog_section py-5">
    <div class="container px-4 px-md-0">
        <div class="row row-gap-4">
            <div class="col-lg-8 pe-md-5">
               <div class="">
                    <div class="blog_short_descritpion">
                        <h2>{{$blog->title}}</h2>
                        <p>{{ $blog->short_description }}</p>
                    </div>
                    <div class="">
                        <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'fallback-image.jpg' }}" 
                        alt="{{ $blog->title }}" class="img-fluid mb-4 mx-auto">
                    </div>
                    <div>
                        <span class="ttm-meta-line comments-link">
                            Published : 
                            <i class="fa fa-calendar"></i>
                            <span class="ml-2"> {{ \Carbon\Carbon::parse($blog->created_at)->format('d-M-Y') }}
                        </span>
                    </div>
                    <div>
                        {!! $blog->content !!}
                    </div>
               </div>
            </div>
            <div class="col-lg-4">
                <div class="recent_blog">
                    <h4>Recent Blog</h4>
                    <div class="row mt-4">
                        @foreach($recentBlogs as $recent)
                            <div class="col-12 mb-3 ">
                                <a href="{{ route('app.blog.info', ['blog' => $recent->id, 'slug' => \Illuminate\Support\Str::slug($recent->title)]) }}" class="text-decoration-none text-dark">
                                    <div class="d-flex flex-row gap-2 align-items-center recent_blog_item">
                                        <img class="recent_blog_img" 
                                            src="{{ $recent->thumbnail_image ? asset('storage/' . $recent->thumbnail_image) : 'https://interiorbangladesh.com/images/blog/content/1712213553.jpg' }}" 
                                            alt="{{ $recent->title }}" width="80" height="60" style="object-fit: cover;">
                                        <div>
                                            <p class="mb-0 text-muted">{{ $recent->created_at->format('d/M/Y') }}</p>
                                            <h6 class="mb-0">{{ $recent->title }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="category_items mt-5">
                    <h4>Categories</h4>
                    <hr>
                    <div class="">
                        @foreach($categories as $category)
                            <a href="" 
                                class="list-group-item list-group-item-action">
                                <i class="fas fa-angle-double-right"></i>
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
   </section>
@endsection