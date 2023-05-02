@extends('site.master')

@section('title', 'contact | ' . env('APP_NAME'))

@section('content')

    @include('site.header', ['title' => 'Contact Us'])

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">API Posts</h6>
                <h1 class="mb-5">All Data</h1>
            </div>
            <div class="row g-4 posts-wrapper">
                {{-- @foreach ($posts as $post)
                <div class="col-md-12">
                    <h2>{{ $post['title'] }}</h2>
                    <p>{{ $post['body'] }}</p>
                    <hr>
                </div>
                @endforeach --}}
            </div>
        </div>
    </div>
    <!-- Contact End -->
@stop

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

<script>

axios.get('https://jsonplaceholder.typicode.com/posts')
  .then(function (response) {
    // handle success
    response.data.forEach(el => {
        document.querySelector('.posts-wrapper').innerHTML += `
            <div class="col-md-12">
                <h2>${el.title}</h2>
                <p>${el.body}</p>
                <hr>
            </div>
        `;
    })
  })
  .catch(function (error) {
    // handle error
    console.log(error);
  });

</script>

@stop
