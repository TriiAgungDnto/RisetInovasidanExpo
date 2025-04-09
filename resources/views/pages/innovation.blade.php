@extends('layouts.app')

@section('content')
<section class="single">
    <div class="single-header">
        <h1 class="single-header-title">Produk Inovasi</h1>
    </div>
    <div class="container my-3">
        @forelse ($innovations as $innovation)
        <article class="postcard light red mx-2 mx-md-0">
            <a class="postcard__img_link" href="https://www.youtube.com/watch?v={{ $innovation->video }}"
                target="_blank">
                <img class="postcard__img" src="{{ asset('file/innovation/'.$innovation->image) }}"
                    alt="{{ $innovation->name }}" />
            </a>
            <div class="postcard__text t-dark">
                <h1 class="postcard__title blue text-uppercase"><a
                        href="https://www.youtube.com/watch?v={{ $innovation->video }}" target="_blank">{{
                        $innovation->name }}</a></h1>
                <div class="postcard__subtitle small">
                    <time datetime="2020-05-25 12:00:00">
                        <i class="fas fa-calendar-alt mr-2"></i>{{ $innovation->created_at->isoFormat('dddd, D MMMM
                        Y') }}
                    </time>
                </div>
                <div class="postcard__bar"></div>
                <div class="postcard__preview-txt">
                    {{ $innovation->description }}
                    <div class="dropdown-divider"></div>
                    Instruktur: <b>{{ $innovation->member->name }}</b>
                    <div class="dropdown-divider"></div>
                    Anggota:
                    @foreach (json_decode($innovation->team) as $item)
                    <small class="bg-secondary text-white rounded-lg p-1 my-1">{{ $item->value }}</small>
                    @endforeach
                </div>
                <ul class="postcard__tagbox">
                    <li class="tag__item">
                        <a href="https://www.youtube.com/watch?v={{ $innovation->video }}" target="_blank">
                            <i class="fab fa-youtube mr-2"></i>Video
                        </a>
                    </li>
                </ul>
            </div>
        </article>
        @empty
        <div class="text-center my-4">Tidak ada data</div>
        @endforelse
    </div>
</section>
@endsection