@extends('layouts.app')
@section('title')
    Home
@endsection
@section('meta')
    {{-- SEO Meta Tags --}}
    <meta name="title" content="BookHive – Discover and Review Your Favorite Books">
    <meta name="description" content="Explore thousands of book reviews, ratings, and recommendations from readers around the world. Find your next great read on BookHive.">
    <meta name="keywords" content="book reviews, book ratings, book recommendations, new books, fiction, non-fiction, bestsellers">

    {{-- Open Graph / Facebook --}}
    <meta property="og:title" content="BookHive – Discover and Review Your Favorite Books">
    <meta property="og:description" content="Explore thousands of book reviews, ratings, and recommendations from readers around the world.">
    {{-- <meta property="og:image" content="{{ asset('images/bookhive-og.jpg') }}"> --}}
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Twitter Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="BookHive – Discover and Review Your Favorite Books">
    <meta name="twitter:description" content="Find your next great read. Read reviews and share your thoughts on the latest books.">
    {{-- <meta name="twitter:image" content="{{ asset('images/bookhive-og.jpg') }}"> --}}
@endsection

@section('main')
    <div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex">
            <div class="col-md-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-9 col-md-9 col">
                                <form action="{{ route('home.bookfind') }}" method="post">
                                    @csrf
                                    <input type="search" name="keyword" value="{{ Request::post('keyword') }}"
                                        class="form-control form-control-lg" placeholder="Search by title">
                            </div>
                            <div class="col-lg-1 col-md-1 col">
                                <button class="btn btn-primary" style="padding: 11px 18px !important;"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                            <div class="col-lg-1 col-md-1 col">
                                <a href="" class="btn btn-outline-dark" style="padding: 11px 18px !important;"
                                    title="refresh"><i class="fa-solid fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($books as $book)
                        @if (isset($book) && !empty($book->slug))
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card card-book border-0 shadow-lg">
                                    <a href="{{ route('book.bookdetail', ['slug' => $book->slug]) }}"><img
                                            src="{{ $book->image }}" alt="" class="card-img-top"></a>
                                    <div class="card-body card-body-book">
                                        <h3 class="h4 heading"><a
                                                href="{{ route('book.bookdetail', ['slug' => $book->slug]) }}">{{ $book->title }}</a>
                                        </h3>
                                        <p>by {{ $book->author }}</p>
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span
                                                class="rating-text theme-font theme-yellow">{{ number_format($book->reviews_avg_rating, 1) }}</span>
                                            <div class="star-rating d-inline-flex mx-2" title="">
                                                <div class="back-stars ">
                                                    <i class="fa fa-star " aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    @php
                                                        $width = ($book->reviews_avg_rating / 5) * 100;
                                                    @endphp
                                                    <div class="front-stars" style="width: {{ $width }}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="theme-font text-muted">({{ $book->reviews_count }} Review)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <nav aria-label="Page navigation ">
                        {{ $books->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
