@extends('layouts.app')
@section('title')
Book Detail
@endsection
@section('meta')
    <meta name="title" content="{{ $book->meta_title }}">
    <meta name="description" content="{{ Str::limit($book->meta_description, 160) }}">
    <meta name="keywords" content="{{$book->meta_keyword }}">
@endsection

@section('main')
    <div class="container mt-3 ">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <a href="javascript:history.back()" class="text-decoration-none text-dark ">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; <strong>Go Back</strong>
                </a>
                @include('layouts.message')
                <div class="row mt-4">
                    <div class="col-md-4">
                        <img src="../{{$book->image}}" alt="" class="card-img-top">
                    </div>
                    <div class="col-md-8">
                        <h3 class="h2 mb-3">{{$book->title}}</h3>
                        <div class="h4 text-muted">{{$book->author}}</div>
                        <div class="star-rating d-inline-flex ml-2" title="">
                            <span class="rating-text theme-font theme-yellow">{{$book->reviews_avg_rating==0?'':number_format($book->reviews_avg_rating,1)}}</span>
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
                        <div class="content mt-3">
                            <p>
                                {{$book->description}}
                            </p>
                        </div>
                        <button id="toggleButton" class="btn btn-outline-warning">
                            <i class="fa fa-play" aria-hidden="true"></i> &nbsp; Start Reading
                        </button>                        
                        <div class="col-md-12 pt-2">
                            <hr>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h2 class="h3 mb-4">Readers also enjoyed</h2>
                            </div>
                            @foreach ($relatedBooks as $Rbook )
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                                <a  style="text-decoration: none" href="{{route('book.bookdetail',$Rbook->slug)}}">                                
                                <div class="card border-0 shadow-lg">
                                    <img src="../{{$Rbook->image}}" alt="" class="card-book-suggest">
                                    <div class="card-body">
                                        <h3 class="h4 heading">{{$Rbook->title}}</h3>
                                        <p>by {{$Rbook->author}}</p>
                                    </div>
                                </div>
                            </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-12 pt-2">
                            <hr>
                        </div>
                        <div class="row pb-5">
                            <div class="col-md-12  mt-4">
                                <div class="d-flex justify-content-between">
                                    <h3>Reviews</h3>
                                    @if (Auth::check())
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Add Review
                                        </button>
                                    </div>
                                    @else
                                    <div>
                                        <a class="btn btn-primary" href="{{route('account.login')}}">
                                            Add Review
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                @if($bookreview->isNotEmpty())                                    
                                @foreach($bookreview as $review)
                                <div class="card border-0 shadow-lg my-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-3">{{$review->user->name}}</h4>
                                            <span class="text-muted">{{ $review->created_at->format('M j, Y') }}</span>         
                                        </div>
                                       
                                        <div class="mb-3">
                                            <div class="star-rating d-inline-flex" title="">
                                                <div class="star-rating d-inline-flex " title="">
                                                    <span style="margin-right: 5px;padding-top: 1px;">{{$review->rating}}</span> 
                                                    <div class="back-stars ">
                                                        <i class="fa fa-star " aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                    
                                                        <div class="front-stars" style="width: {{ ($review->rating / 5) * 100 }}%;">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p>{{$review->review}}</p>
                                        </div>
                                    </div>
                                </div>  
                                @endforeach
                                @else
                                <div class="content">
                                    <p>No reviews found.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>   
    
    <!-- Modal -->
    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong>{{$book->title}}</strong></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="bookReviewForm" name="bookReviewForm">
                        @csrf
                        <input type="hidden" id="book_id" name="book_id" value="{{ $book->id }}">
                        <div class="mb-3">
                            <label for="" class="form-label">Review</label>
                            <textarea name="review" id="review" class="form-control" cols="5" rows="2" placeholder="Write here..."></textarea>
                            <p class="invalid-feedback" id="review-error"></p>
                        </div>
                        <div class="mb-3">
                            <label for=""  class="form-label">Rating</label>
                            <div class="rating-slider">
                                <input type="range" id="rating" name="rating" min="0" max="5" step="0.1" value="0">
                                <output id="ratingValue">0</output>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submitr" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection
@section('script')
<script>
   $(document).ready(function () {
    var synth = window.speechSynthesis;
    var voices = [];
    var currentUtterance = null;
    var isReading = false;  // To track whether it's currently reading
    var chunks = [];
    var chunkIndex = 0;
    var $toggleButton = $('#toggleButton'); // Save the button reference

    // Fetch voices
    function populateVoices() {
        voices = synth.getVoices();
    }

    synth.onvoiceschanged = populateVoices;
    populateVoices();

    // Split the text into chunks
    function splitTextIntoChunks(text, maxLength = 500) {
        const chunks = [];
        while (text.length > maxLength) {
            let lastSpaceIndex = text.lastIndexOf(' ', maxLength);
            if (lastSpaceIndex === -1) lastSpaceIndex = maxLength;
            chunks.push(text.substring(0, lastSpaceIndex));
            text = text.substring(lastSpaceIndex).trim();
        }
        if (text.length > 0) chunks.push(text);
        return chunks;
    }

    // Start/Stop toggle button
    $toggleButton.click(function () {
        if (isReading) {
            // Stop the speech synthesis if it's currently reading
            synth.cancel();
            $toggleButton.html('<i class="fa fa-play" aria-hidden="true"></i> &nbsp; Start Reading');  // Change to "Start Reading"
            isReading = false;
        } else {
            var descriptionText = @json($book->description);
            chunks = splitTextIntoChunks(descriptionText);
            chunkIndex = 0;

            // Function to speak the next chunk and highlight it
            function speakNextChunk() {
                if (chunkIndex < chunks.length) {
                    var chunk = chunks[chunkIndex];
                    currentUtterance = new SpeechSynthesisUtterance(chunk);

                    // Set properties for the utterance
                    currentUtterance.lang = 'en-US';
                    currentUtterance.volume = 1;
                    currentUtterance.rate = 1;
                    currentUtterance.pitch = 1;

                    // Start speaking the current chunk
                    synth.speak(currentUtterance);

                    // Once the current chunk finishes, move to the next
                    currentUtterance.onend = function () {
                        chunkIndex++;
                        speakNextChunk();  // Continue to the next chunk
                    };
                } else {
                    // After finishing all chunks, change button text and icon
                    $toggleButton.html('<i class="fa fa-play" aria-hidden="true"></i> &nbsp; Start Reading');  // Reset to "Start Reading"
                    isReading = false;
                }
            }

            // Start reading from the first chunk
            $toggleButton.html('<i class="fa fa-stop" aria-hidden="true"></i> &nbsp; Stop Reading');  // Change to "Stop Reading"
            isReading = true;
            speakNextChunk();
        }
    });
    $(window).on('beforeunload', function() {
        if (isReading) {
            synth.cancel();
            $toggleButton.html('<i class="fa fa-play" aria-hidden="true"></i> &nbsp; Start Reading');
            isReading = false;
        }
    });
});


$(document).ready(function() {
    var $slider = $('#rating');
    var $output = $('#ratingValue');
    var maxRating = 5;

    function updateSlider() {
        var value = $slider.val();
        $output.text(value + ' out of ' + maxRating);
        var percentage = (value / maxRating) * 100;
        $slider.css('background', 'linear-gradient(to right, rgb(63 94 251) ' + percentage + '%, #ccc ' + percentage + '%)');
    }

    $slider.on('input', updateSlider);

    // Initialize on page load
    updateSlider();
    $('#bookReviewForm').submit(function(e){
       e.preventDefault();
       var rating = parseFloat($slider.val()).toFixed(1);
       $.ajax({
            url:'{{route("books.saveReview")}}',
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data:$('#bookReviewForm').serializeArray().concat({ name: 'rating', value: rating }),
            success: function(response) {
                if(response.status==false){
                    let error=response.error;
                    if(error.review){
                        $('#review').addClass('is-invalid');
                        $('#review-error').html(error.review);
                    }else{
                        $('#review').removeClass('is-invalid');
                        $('#review-error').html('');
                    }
                }else{
                    window.location.href = '{{ route("book.bookdetail",$book->id) }}';
                }
            },
       }) 
    });
    
});   
</script>
@endsection
