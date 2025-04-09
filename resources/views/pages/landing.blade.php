@extends('layouts.app')

@section('t-script')
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
@endsection

@section('content')
<section class="hero d-flex align-items-center">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-7">
                <div class="home-text text-center">
                    <h1 class="text-uppercase">The Next Golden Generation</h1>
                    <p>Dengan komitmen, Universitas Bina Darma mengembangkan diri menjadi pusat <span>Riset</span>
                        dan <span>Inovasi</span>
                        sebagai wujud pengabdian masyarakat.</p>
                    <a data-scroll-goto="2" href="#" class="btn btn-home">Info Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="innovation" class="innovation section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="section-title text-center">
                    <h2>Inovasi <span>Startup</span></h2>
                </div>
                <div class="section-description text-center">
                    <p>Inovator yang membangun startup</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="owl-carousel innovation-carousel">
                <div class="innovation-item">
                    <div class="icon">
                        <img src="./assets/logo/inovator/jamas.jpg" alt="Kape">
                    </div>
                    <h3>Jamas</h3>
                    <p>
                        Platform delivery yang menghubungkan antara konsumen dengan penyedia bahan dapur
                        atau pasar dengan aman.
                    </p>
                </div>
                <div class="innovation-item">
                    <div class="icon">
                        <img src="./assets/logo/inovator/Kape.png" alt="Kape">
                    </div>
                    <h3>Kape</h3>
                    <p>
                        Kampung pempek merupakan platform pemesanan pempek berbasis digital yang murah, mudah, dan
                        lengkap.
                    </p>
                </div>
                <div class="innovation-item">
                    <div class="icon">
                        <img src="./assets/logo/inovator/Return.png" alt="Kape">
                    </div>
                    <h3>Return</h3>
                    <p>
                        Sebuah platform yang bergerak dibidang lingkungan dengan fokus untuk manajemen
                        permasalahan sampah.
                    </p>
                </div>
                <div class="innovation-item">
                    <div class="icon">
                        <img src="./assets/logo/inovator/Sidespin.png" alt="Kape">
                    </div>
                    <h3>Sedespin</h3>
                    <p>
                        Sistem Informasi Desa Pintar, platform untuk membantu masyarakat setempat untuk memasarkan
                        produk desa.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5 d-flex justify-content-center align-items-center order-1 order-md-0">
                <div class="about-img">
                    @if (!is_null($poster))
                    <img src="{{ asset('file/poster/'.$poster->poster) }}" alt="{{ $poster->name }}">
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-7 order-0 order-md-1">
                <div class="section-title">
                    <h2>Tentang <span>RIE</span></h2>
                </div>
                <div class="about-text">
                    @if (!is_null($poster))
                    <p>{{ $poster->about }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section id="activity" class="activity section-padding" style="background-image: url('assets/images/activity.jpg');">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="section-title text-center">
                    <h2>Aktivitas <span>Riset</span> Inovasi</h2>
                </div>
            </div>
        </div>
        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach ($activities as $activity)
            <div class="col-md-3 mb-3">
                <a href="https://www.youtube.com/watch?v={{ $activity->video }}" target="_blank">
                    <div class="card">
                        <img src="http://img.youtube.com/vi/{{ $activity->video }}/0.jpg" class="card-img-top image"
                            alt="{{ $activity->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $activity->title }}</h5>
                            <p class="card-text">{{ $activity->description }}</p>
                            <span class="badge info">By {{ $activity->user_author->name }} -
                                {{ $activity->created_at->isoFormat('D MMMM Y') }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="row my-3">
            <div class="col-12 d-flex align-items-center justify-content-center">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</section>

<section class="partner section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="section-title text-center">
                    <h2>Mitra <span>Kami</span></h2>
                </div>
                <div class="section-description text-center">
                    <p>Mereka yang telah percaya bersama kami</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            @foreach ($partners as $partner)
            <div class="col-sm-6 col-md-2 text-center mb-3">
                <img class="partner-img" src="{{ asset('file/partner/'.$partner->logo) }}" alt="{{ $partner->name }}">
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('b-script')
<script src="{{ asset('js/particles.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

<script>
    $(document).ready(function () {
        particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#c43333"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "img/github.svg",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 6,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            }

        );

        $('.innovation-carousel').owlCarousel({
            loop: false,
            margin: 0,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 3,
                }
            }
        });
    });

</script>
@endpush