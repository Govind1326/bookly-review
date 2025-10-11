@extends('layouts.app')
@section('title')
Home 
@endsection
@section('main')
    <div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex">
            <div class="col-md-12">
                {{-- <div class="d-flex justify-content-between">
                    <h2 class="mb-3"> </h2>
                    <div class="mt-2 text-end">
                        <a href="" class="text-light btn btn-danger">Clear</a>
                    </div>
                </div> --}}
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-9 col-md-9 col">
                                    <form action="{{route('home.bookfind')}}" method="post">
                                    @csrf
                                    <input type="search" name="keyword" value="{{Request::post('keyword')}}" class="form-control form-control-lg" placeholder="Search by title">
                                </div>
                                <div class="col-lg-1 col-md-1 col">
                                    <button class="btn btn-primary" style="padding: 11px 18px !important;"><i class="fa-solid fa-magnifying-glass"></i></button>                                                                    
                                </form>
                            </div>                                                                                 
                            <div class="col-lg-1 col-md-1 col">
                                <a href="" class="btn btn-outline-dark" style="padding: 11px 18px !important;" title="refresh"><i class="fa-solid fa-refresh"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($books as $book )                        
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card card-book border-0 shadow-lg">
                            <a href="{{route('book.bookdetail',['id'=>$book->id])}}"><img src="{{$book->image}}" alt="" class="card-img-top"></a>
                            <div class="card-body card-body-book">
                                <h3 class="h4 heading"><a href="{{route('book.bookdetail',['id'=>$book->id])}}">{{$book->title}}</a></h3>
                                <p>by {{$book->author}}</p>
                                <div class="star-rating d-inline-flex ml-2" title="">
                                    <span class="rating-text theme-font theme-yellow">{{ number_format($book->reviews_avg_rating, 1)}}</span>
                                    <div class="star-rating d-inline-flex mx-2" title="">
                                        <div class="back-stars ">
                                            <i class="fa fa-star " aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            @php
                                             $width=($book->reviews_avg_rating/5)*100;   
                                            @endphp
                                            <div class="front-stars" style="width: {{$width}}%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="theme-font text-muted">({{$book->reviews_count}} Review)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <nav aria-label="Page navigation " >
                        {{$books->links()}}
                    </nav>    
                </div>
            </div>
        </div>
    </div>    
@endsection