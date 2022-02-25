@extends('front.front_layout')

@section('front-css')

<link rel="stylesheet" href="{{ asset('front/styles/team.css') }}">
@endsection

@section('content')


<section class="container-fluid team-banner" style="background-image: url({{asset('uploads/teams/thumbnail/'.$team->image)}}")>

</section>

    <section class="container-fluid">
        <div class="container p-3">
            <h1 class="text-center">Our Team</h1>
        </div>
        {{-- <div class="container p-3">
           <p class="paragraph">{!! $team->description !!}
           </p>
        </div> --}}

<!-- fist level -->
@isset($first)
      <div class="container">
        <div class="row ">
            <div style="margin-left:50%; transform:translate(-50%)" class="col-md-6 col-lg-4 col-12 ">
                <div class="flip-card flip-card-first">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="{{ asset('uploads/teams/thumbnail/'.$first->image) }}" alt="Avatar" class="img-fluid team-image">
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <div class="post">
                                        <h3>{{ strtoupper($first->designation)}}</h3>
                                    </div>
                                    <p class="name">{{ ucfirst($first->name)}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flip-card-back bg-light p-2">
                                <div class=" p-2 personal-information">personal info</div>
                           
                            <div class="personal-details">
                                <p><span class="info-title">Name:</span></p>
                                <p class="info-detail">{{ ucfirst($first->name)}}</p>
                                <p><span class="info-title"> Address:</span></p>
                                <p><span class="info-detail">{{ ucfirst($first->address)}}</span></p>
                                <p><span class="info-title">Contact No:</span> </p>
                                <p><span class="info-detail">{{ ucfirst($first->contact_num)}}</span></p>
                                <p class="info-detail-para">{{ ucfirst($first->detail)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endisset
<!-- first level-end -->

<!-- second level -->
@isset($second)
       <div class="container">
            <div class="row second-padding py-4 gy-4">
            @foreach($second as $data)
                <div class=" col-lg-6 col-md-6 col-12 ">
                    <div class="flip-card-second flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img  src="{{ asset('uploads/teams/thumbnail/'.$data->image) }}"
                                    alt="Avatar" class="img-fluid team-image">
                                <div class="overlay">
                                    <div class="overlay-inner">
                                        <div class="post">
                                            <h3>{{ strtoupper($data->designation)}}</h3>
                                        </div>
                                        <p class="name">{{ ucfirst($data->name)}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-card-back bg-light p-2">
                                    <div class="p-2 personal-information">
                                        personal info
                                    </div>
                                <div class="personal-details">
                                    <p><span class="info-title">Name:</span></p>
                                    <p class="info-detail">{{ ucfirst($data->name)}}</p>
                                    <p><span class="info-title"> Address:</span></p>
                                    <p><span class="info-detail">{{ ucfirst($data->address)}}</span></p>
                                    <p><span class="info-title">Contact No:</span> </p>
                                    <p><span class="info-detail">{{ ucfirst($data->contact_num)}}</span></p>
                                    <p class="info-detail-para">{{ ucfirst($data->detail)}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
              
            </div>
     
       </div>
@endisset
<!-- third level -->
@isset($third)
<div class="container">
<div class="row py-4 g-3">
    @foreach($third as $data)
        <div class=" col-lg-4 col-md-4 col-12 ">
            <div class="flip-card flip-card-third">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="{{ asset('uploads/teams/thumbnail/'.$data->image) }}" alt="Avatar" class="img-fluid team-image">
                        <div class="overlay">
                            <div class="overlay-inner">
                                <div class="post">
                                    <h3>{{ strtoupper($data->designation)}}</h3>
                                </div>
                                <p class="name">{{ ucfirst($data->name)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card-back bg-light p-2">
                    
                            <div class=" p-2 personal-information">
                                personal info
                            </div>
                        <div class="personal-details">
                            <p><span class="info-title">Name:</span></p>
                            <p class="info-detail">{{ ucfirst($data->name)}}a</p>
                            <p><span class="info-title"> Address:</span></p>
                            <p><span class="info-detail">{{ ucfirst($data->address)}}</span></p>
                            <p><span class="info-title">Contact No:</span> </p>
                            <p><span class="info-detail">{{ ucfirst($data->contact_num)}}</span></p>
                            <p class="info-detail-para " >{{ ucfirst($data->detail)}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
</div>
@endisset
   
</section>

<div class="container-fluid break"></div>
@include('front.customers.customers')
@endsection


