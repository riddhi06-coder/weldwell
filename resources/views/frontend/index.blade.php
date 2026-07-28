<!doctype html>
<html lang="en">

<head>
    @include('components.frontend.head')
</head>

<body>
    @include('components.frontend.header')

    {{-- =========================== Banner =========================== --}}
    @if($banner)
        <section class="home-banner">
            <div class="banner-heading">{!! $banner->heading !!}</div>
            <div class="banner-title">{!! $banner->title !!}</div>
            @if($banner->video)
                <video src="{{ asset('home/banner/' . $banner->video) }}" autoplay muted loop playsinline></video>
            @endif
        </section>
    @endif

    {{-- =========================== Product Intro =========================== --}}
    @if($productIntro)
        <section class="product-intro">
            <h2>{{ $productIntro->heading }}</h2>
            <h3>{{ $productIntro->title }}</h3>
            <div class="desc">{!! $productIntro->description !!}</div>
            @if($productIntro->qualities->isNotEmpty())
                <ul class="qualities">
                    @foreach($productIntro->qualities as $quality)
                        <li>{{ $quality->quality }}</li>
                    @endforeach
                </ul>
            @endif
        </section>
    @endif

    {{-- =========================== Company Stats =========================== --}}
    @if($companyStats)
        <section class="company-stats">
            @if($companyStats->video)
                <video src="{{ asset('home/company-stats/' . $companyStats->video) }}" autoplay muted loop playsinline></video>
            @endif
            @if($companyStats->items->isNotEmpty())
                <div class="stats">
                    @foreach($companyStats->items as $stat)
                        <div class="stat">
                            <span class="stat-no">{{ $stat->stat_no }}</span>
                            <span class="stat-name">{{ $stat->stat_name }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    {{-- =========================== About =========================== --}}
    @if($about)
        <section class="home-about">
            <h2>{{ $about->heading }}</h2>
            <div class="title">{!! $about->title !!}</div>
            <div class="images">
                @foreach(['image1','image2','image3'] as $img)
                    @if($about->{$img})
                        <img src="{{ asset('home/about/' . $about->{$img}) }}" alt="{{ $about->heading }}">
                    @endif
                @endforeach
            </div>
            <div class="small-intro">{!! $about->small_intro !!}</div>
            <div class="description">{!! $about->description !!}</div>
            @if($about->experience)
                <div class="experience">
                    <span class="experience-no">{{ $about->experience }}</span>
                    <span class="experience-title">{{ $about->experience_title }}</span>
                </div>
            @endif
        </section>
    @endif

    {{-- =========================== Clients =========================== --}}
    @if($clients)
        <section class="home-clients">
            @if($clients->image)
                <img class="section-image" src="{{ asset('home/clients/' . $clients->image) }}" alt="Clients">
            @endif
            @if($clients->photos->isNotEmpty())
                <div class="client-photos">
                    @foreach($clients->photos as $photo)
                        <img src="{{ asset('home/clients/' . $photo->photo) }}" alt="Client">
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    {{-- =========================== Testimony Intro =========================== --}}
    @if($testimony)
        <section class="testimony-intro">
            <h2>{{ $testimony->heading }}</h2>
            <div class="title">{!! $testimony->title !!}</div>
            @if($testimony->sliders->isNotEmpty())
                <div class="slider-info">
                    @foreach($testimony->sliders as $slider)
                        <div class="slide">{{ $slider->title }}</div>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    {{-- =========================== Knowledge Spectrum =========================== --}}
    @if($knowledge)
        <section class="knowledge-spectrum"
            @if($knowledge->background_image) style="background-image:url('{{ asset('home/knowledge/' . $knowledge->background_image) }}');" @endif>
            <h2>{{ $knowledge->title }}</h2>
            <div class="heading">{!! $knowledge->heading !!}</div>
        </section>
    @endif

    {{-- =========================== Event Intro =========================== --}}
    @if($event)
        <section class="event-intro">
            <h2>{{ $event->heading }}</h2>
            <div class="title">{!! $event->title !!}</div>
        </section>
    @endif

    {{-- =========================== Connection =========================== --}}
    @if($connection)
        <section class="home-connection">
            <h2>{{ $connection->title }}</h2>
            <div class="heading">{!! $connection->heading !!}</div>
            @if($connection->email)
                <a class="email" href="mailto:{{ $connection->email }}">{{ $connection->email }}</a>
            @endif
        </section>
    @endif

    @include('components.frontend.footer')
    @include('components.frontend.main-js')

</body>

</html>
