@extends('layouts.app')
@section('content')

    
{{-- <div class="container">
<div class="row">
        <div class="col-12 col-sm-12 col-md-6 mol-lg-6 col-xl-4 mt-4">
            <div class="card text-center bg-primary">
              <img class="card-img-top" src="holder.js/100px180/" alt="">
              <i class="fas fa-camera-retro"></i>
              <a href="/bookroom">
                <div class="card-body">
                        <h4 class="card-title text-white">Video conferencing</h4>
                </div>
            </a>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 mol-lg-6 col-xl-4 mt-4">
            <div class="card text-center">
              <img class="card-img-top" src="holder.js/100px180/" alt="">
              <a href="#" class="isDisabled">
                <div class="card-body bg-secondary">
                        <h4 class="card-title text-white">Satcom</h4>
                </div>
            </a>  
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 mol-lg-6 col-xl-4 mt-4">
            <div class="card text-center">
              <img class="card-img-top" src="holder.js/100px180/" alt="">
              <a href="#" class="isDisabled">
                <div class="card-body bg-success">
                        <h4 class="card-title text-white">Microwave Backbone</h4>                    
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-4">
            <div class="card text-left">
                <img class="card-img-top" src="holder.js/100px180/" alt="">
                <a href="#" class="isDisabled">
                    <div class="card-body bg-dark">
                            <h4 class="card-title text-white">spectrum</h4>                        
                    </div>
                </a>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-4">
            <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <a href="#" class="isDisabled">
                <div class="card-body bg-danger">
                        <h4 class="card-title text-white">BWA</h4>                        
                    </div>
                </a>
            </div>
    </div>

    </div>
    
    <ul>
  </ul>   
</div>   --}}



<div class="container">
<div class="highlights">
    <section>
        <div class="content ml-3 ">
            <header>
            <span style = "font-size: 6em">
                    <a href="/bookroom"><i class="fas fa-camera-retro"></i></a>
                </span>
            <h3>Video conference booking</h3>
            </header>
        </div>
    </section>

    <section>
        <div class="content">
            <header>
                <span style="font-size:6em">
                    <a href="#" class="isDisabled"><i class="fas fa-satellite"></i></a>
                </span>
            </header>
            <h3>Satcom</h3>
        </div>
    </section>

    <section>
        <div class="content mr-3">
            <header>
                <span style="font-size:6em">
                    <a href="#" class="isDisabled"><i class="fas fa-broadcast-tower"></i></a>
                </span>
            </header>
            <h3>Microwave backbone</h3>
        </div>
    </section>

    <section>
        <div class="content ml-3">
            <header>
                <span style="font-size:6em">
                    <a href="#" class="isDisabled"><i class="fas fa-copy"></i></a>
                </span>
            </header>
            <h3>Spectrum</h3>
        </div>
    </section>

    <section>
        <div class="content">
            <header>
                <span style="font-size:6em">
                    <a href="#" class="isDisabled"><i class="fas fa-broadcast-tower"></i></a>
                </span>
            </header>
            <h3>BWA</h3>
        </div>
    </section>

    <section>
        <div class="content mr-3">
            <header>
                <span style="font-size:6em">
                    <a href="#" class="isDisabled"><i class="fas fa-paperclip"></i></i></a>
                </span>
            </header>
            <h3>Miscellaneous</h3>
        </div>
    </section>
</div>
</div>



@endsection
