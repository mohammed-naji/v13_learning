@extends('site.master')

@section('title', 'contact | ' . env('APP_NAME'))

@section('content')

    @include('site.header', ['title' => 'Contact Us'])

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Weather App</h6>
                <h1 class="mb-5">Search About Any Country's Weather</h1>
            </div>
            <div class="row justify-content-center g-4 weather-wrapper">
                <div class="col-md-8">
                    <input type="text" id="country" class="form-control mb-3">

                    <div class="result">
                        <h3>Country weather: <span id="weather"></span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@stop

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

<script>

    document.querySelector('#country').onkeyup = (e) => {

        if(e.keyCode == 13) {
            const country = document.querySelector('#country').value;
            axios.get('https://api.openweathermap.org/data/2.5/weather?q='+country+'&appid=dccab945679f3bb9019537a309e05e47&units=metric')
            .then(res => {
                if(res.data.main.temp) {
                    document.querySelector('#weather').innerHTML = res.data.main.temp + '°C';
                }
                // console.log(res.data.main.temp);
            })
            .catch(err => {
                document.querySelector('#weather').innerHTML = 'not found';
            })
        }


    }

</script>

@stop
