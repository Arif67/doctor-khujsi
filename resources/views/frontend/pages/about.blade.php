@extends('layouts.app')

@section('title', 'About Us - Hospital Management')

@section('content')
<section class="services-section">
    <div class="container px-4 px-md-4">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="services-img">
                    <img class="" src="https://i.postimg.cc/YSb49tfX/image.png" alt="Exercise Services">
                </div>
            </div>
            <div class="col-md-6">
                 <div class="services-content">
                    <span class="services-pill">Our Services</span>
                    <div class="heading_title mb-4">We Provide The Best <br> Services</div>
                    <div class="services-desc">
                        World-class rehabilitation solutions and individualized recovery plans,
                        from acute care to ongoing outpatient treatment and beyond.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="row row-gap-5 align-items-center">
            <div class="col-md-6">
                <div class="about-conent">
                    <h1 class="heading_title">How We Get You Better</h1>
                    <p class="description">
                        Lorem ipsum dolor sit amet consectetur. Duis mattis penatibus tellus urna et eget. Nec ornare enim
                        ornare ligula elit a nibh laoreet diam. Auctor at nisl fermentum tellus morbi sed pretium quam
                        neque.
                        Volutpat volutpat vitae pretium suscipit eros ultrices massa nam. Ut cursus sed massa faucibus quam
                        eget vulputate. Morbi lorem libero porttitor posuere arcu mauris vulputate lacus blandit.
                        Felis nunc lectus mattis arcu a. Auctor consequat at nibh sit tortor. Viverra eu sed habitant morbi
                        libero neque et penatibus dignissim.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-image">
                    <img src="https://i.postimg.cc/44FzPQc8/image.png" alt="About Us Image">
                </div>
            </div>
        </div>
        
        
    </div>
</section>

@includeIf('components.app.doctors')
@endsection