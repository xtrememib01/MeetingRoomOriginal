@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">
    {{-- @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif --}}

    {{-- <section id="banner">
        <div class="inner">
            <h1>ONGC</h1>
            <p>Maharatna, ONGC is the largest crude oil and natural gas Company in India, contributing around 75 per cent to Indian domestic production. This largest natural gas company ranks 11th among global energy majors (Platts).</p> 
            <p>It is the only public sector Indian company to feature in Fortune’s ‘Most Admired Energy Companies’ list. ONGC ranks 18th in ‘Oil and Gas operations’ and 220 overall in Forbes Global 2000. Acclaimed for its Corporate Governance practices, Transparency International has ranked ONGC 26th among the biggest publicly traded global giants. It is most valued and largest E&P Company in the world, and one of the highest profit-making and dividend-paying enterprise.</p>
        </div>
        <video autoplay loop muted playsinline src="./images/banner.mp4"></video>
    </section> --}}


<!-- CTA -->
<div >
    <section id="cta" class="wrapper">
        <div class="inner text-bold text-left mt-5">
            <h1 class="font-size: 18em">Recent Achievments</h1>
            <h5>In yet another display of its organizational excellence as one the leading Public Sector Undertakings (PSUs) in the country, ONGC bagged four awards in the Governance Now 7th PSU Awards 2020. The annual awards ceremony was held on 19 February 2020 at New Delhi. The four awards conferred to ONGC, under the Maharatna category, are:</h5>
                <h5><ul >
                    
                    <li>Digital PSU</li> 
                    <li>Investment in Start-ups</li> 
                    {{-- <li>CSR & Environment and Sustainability</li> --}}
                </ul> </h5>   
            
        </div>
    </section>

    <!-- Highlights -->
    <section class="wrapper m-0 p-0">
        <div class="inner">
            <header class="special">
                <!--h2>Sem turpis amet semper</h2>
                <p>In arcu accumsan arcu adipiscing accumsan orci ac. Felis id enim aliquet. Accumsan ac integer lobortis commodo ornare aliquet accumsan erat tempus amet porttitor.</p-->
            </header>
            <div class="highlights">
                <section>
                    <div class="content">
                        <header>
                        <span style = "font-size: 6em"><a href="communication"><i class ="fas fa-american-sign-language-interpreting "></i></a></span>
                        </a>
                        </i>
                        <h3>Communication</h3>
                        </header>
                        <!--p></p-->
                    </div>
                </section>
                <section>
                    <div class="content ">
                        <header>
                            <span style="font-size:6em"><a href="#" class="isDisabled"><i class="fas fa-server"></i></a></span>
                            <h3>Information Technology</h3>
                        </header>
                        <p></p>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <header>
                        <span style="font-size:6em"><a href="#" class="isDisabled"><i class="fas fa-network-wired"></i></a></span>
                            <h3>Network</h3>
                        </header>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <header>
                        <span style="font-size: 6em"><a href="#" class="isDisabled"><i class="fas fa-tasks"></i></a></span>
                            <h3>Promise</h3>
                        </header>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <header>
                        <span style="font-size:6em"><a href="" class="isDisabled"><i class="fab fa-connectdevelop"></i></a></span>
                            <h3>Scada</h3>
                        </header>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <header>
                            <span style="font-size:6em"><a href="https://www.ongcindia.com/wps/wcm/connect/en/home/"><i class="fas fa-burn"></i></a></span>
                            <h3>ONGC India</h3>
                        </header>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
</div>

@endsection
