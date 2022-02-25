@extends('front.front_layout')


@section('content')

  <div style="padding: 0% !important;" class="container-fluid position-relative">
    <div class="row">
      <div class="col">
        <video width="100%" autoplay muted loop class="myvideo" src="{{ asset('front/Images/topsunvideo .mp4') }}"></video>
       
      </div>
      <div style="background: #3a3b41;height: 100%; opacity: 0.7;" class="text-white col  p-3 text-start absolute">
       
        <div class="absolute">
          <h3>WHY CHOOSE US??</h3>
         <div class="row">
            @isset($Features)
                @foreach($Features as $feature)
                    <div class="col-md-3 p-1">
                        <div class="frame">
                        <div class="lines"></div>
                        <div class="angles"></div>
                        
                        <div class="p-1 banner-why">
                            <div class="d-flex">
                            <div class="pt-1"><img src="{{ asset('uploads/feature/thumbnail/'.$feature->image) }}" alt=""></div>
                                <div class=" ms-2  banner-header"><h5>{{ strtoupper($feature->title)}}</h5></div>
                            </div>
                            <div class="mt-3">
                                <p class="paragraph">
                                    {{ ucfirst($feature->summary) }}
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            @endisset
         </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid break"></div>

<!-- About us -->
@isset($about)
  <div  class="container py-5">
    <div class="card mb-3">
      <div class="row justify-content-between  g-0">

        <div class="col-md-6">
          <div class="card-body">

            <h1 class="section-header text-start">{{ strtoupper($about->title)}}</h1>
            <p class="card-text text-success">{!! Str::limit($about->about_description, 250)  !!}</p>
            <a href="{{ route('our-story')}}" class="btn btn-warning">READ MORE</a>
          </div>
        </div>
        <div class="col-md-6">
          <iframe width="100%" height="300px" src="{{ $about->video_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" widget_referrer allowfullscreen></iframe>
          <!-- <img src="{{ asset('front/Images/aboutus.jpg') }}" class="img-fluid rounded-start" alt="..."> -->
        </div>
      </div>
    </div>
  </div>
@endisset
{{-- services --}}
@isset($products)
  <section style="background: rgb(108,165,126);background: linear-gradient(0deg, rgba(108,165,126,1) 40%, rgb(253, 253, 253) 60%);"class="container-fluid">
    <div class="container py-5">
      <div style=" background: transparent;" class="card mb-3">
        <div class="row justify-content-between g-0">
          <div class="col-md-6 justify-content-around">
           
            @foreach($products as $product)
            <img src="{{ asset('uploads/products/thumbnail/'.$product->image) }}" class="img-fluid p-2 col-sm-5 img-1 " alt="...">
              @endforeach
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <h1 class="card-title">OUR PRODUCTS</h1>
              <p class="card-text text-success">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sint
                laborum voluptatum, iure architecto rerum consequatur quo tempora tenetur vitae a ipsam aut
                necessitatibus alias mollitia cupiditate quia ab? Quasi. Some quick example text to build on the card
                title and make up the bulk of the card's content. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsa, aliquid! Ad dolore, accusantium asperiores officia ipsam incidunt, aliquid nesciunt sint, minus rerum aliquam doloribus consectetur inventore illum? Quo, praesentium dolores.</p>
              <a href="{{ route('product','all')}}" class="btn btn-warning">View Products</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endisset

  <div class="container-fluid break"></div>
<!-- Services we provide -->
@isset($services)
  <section class="container-fluid services">
    <div class="container py-5">
      <div style="background: transparent;" class="card mb-3">
        <h1 class="card-title text-center">Services We Provide</h1>
        <div class="row justify-content-between g-0 mt-3">
          <div class="col-md-8 row justify-content-around">
            @foreach($services as $service)
            <div  class=" col-sm-4 col-6 p-2 text-center">
              <div style="background: transparent; background: #d6d6d6a6; " class="p-2">
                <p><img class="img-fluid" height="50px" width="50px" src="{{ asset('front/Images/development-ideas1544511247.png') }}" alt="" srcset=""></p>
              <p>{{ ucfirst($service->title) }}</p>
              </div>
            </div>
            @endforeach
          </div>
          <div class="col-md-4">
            <div class="card-body">
              <p class="text-white paragraph">Contact us for the services you required. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Itaque in quos, voluptatibus illum tempore at quisquam aperiam facere optio! Maiores illo reprehenderit cum accusantium nisi et incidunt obcaecati hic nam.</p>
              <a href="{{ route('contact')}}" class="btn btn-warning">Contact us</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endisset

  <div class="container-fluid break"></div>
  <!-- our projects -->
  
@isset($projects)
  <section class="container text-center p-3">
    <div style="margin:auto;" class="container-fluid align-items-center py-3">
      <div class=" text-center ">
        <h1>OUR PROJECTS</h1>
      </div>
    </div>
    
    <div class="container p-3">
     <div class="row ">
         @foreach($projects as $project)
         <div class="col-md-3">
            <a href="{{ route('project',$project->slug)}}">
                <div class="project-div p-1">
             <img style="width: 300px ; height: 200px;" class="img-fluid" src="{{ asset('uploads/projects/thumbnail/'.$project->image) }}" alt="">
             <p>{{ ucfirst($project->title)}}</p>
            </div>
            </a>
         </div>
         @endforeach
     </div> 
</div>
    <div style="padding:0 10% 0 10%; margin:auto;" class="container p-3 text-center">
      <a href="{{ route('project-list')}}" class="btn btn-warning align-self-center">SEE MORE</a>
    </div>
    </div>
  </section>
@endisset

  <div class="container-fluid break"></div>

  <!-- upcoming events -->
@isset($upcomming_project)
  <div id="events" style="margin:auto;" class="container-fluid align-items-center py-3 events">
    <div class="events-header text-center ">
      <h1 style="width: auto;" >UPCOMING EVENTS</h1>
    </div>
    <div>
      <div class="container  px-3">
        <div class="row gx-0 upcoming-projects text-center">
            @foreach($upcomming_project as $project)
            <div class="col-sm p-3 m-3">
                <div class="text-white p-3 event-card-header">
                  <h1>{{ date('d',strtotime($project->started_at))}}</h1>
                  <h3>{{ date('M',strtotime($project->started_at))}}</h3>
                  <h3>{{ date('D',strtotime($project->started_at))}}</h3>
                </div>
                <div style="width: 100%; " class="p-3 bg-success text-white">
                  <h3 style="font-size: 20px;">{{ ucfirst($project->title)}}
                  </h3>
                  <a style="font-size: 20px ; color: chartreuse;" href="{{ route('event',$project->slug)}}">Explore >></a>
                 
                </div>
              </div>
            @endforeach

        </div>
      </div>
    </div>

  </div>
@endisset
  <div class="container-fluid break"></div>

@endsection


{{-- @section('customer')
<section id="custo" class="container py-3">
  <div>
    <div class=" text-center text-success">
      <h1 class="">Our Valuable Customers</h1>

      <div>
        <div class="logos-customers">
          @foreach($client as $data)
          <img style="width:10%;" src="{{ asset('uploads/clients/thumbnail/'.$data->image) }}" alt="">
          @endforeach
         
          
        </div>
        <a href="{{ route('portfolio')}}" class="btn btn-lg mt-4 ">LEARN MORE</a>
      </div>
    </div>
  </div>
</section>
@endsection --}}

@section('container')

 <!-- counter -->
 <section id="counter" style="width: 100%; border-top: 1.5px solid rgb(87, 85, 85);" class="container-fluid bg-success">
  <div class="container-fluid p-4 bg-success text-center">
    <div class="row">
      <div style="color: #f1cf5c;" class="d-flex col-sm-4 flex-column">
        <h1 style="color: #f1cf5c;"><span class="count" counter-lim="200"></span> +</h1>
        <h3>Total Energy Produced (kW)</h3>
      </div>
      <div style="color: #f1cf5c;" class="d-flex col-sm-4 flex-column">
        <h1 style="color: #f1cf5c;"><span class="count" counter-lim="200"></span> +</h1>
        <h3>Total Plants Installed</h3>
      </div>
      <div style="color: #f1cf5c;" class="d-flex col-sm-4 flex-column">
        <h1 style="color: #f1cf5c;"><span class="count" counter-lim="200"></span> +</h1>
        <h3>Total Energy Used (KV)</h3>
      </div>

    </div>
  </div>
</section>


@if(isset($popup))
<div  class="modal" id="myModal">
  <div style="position:absolute;left:0px;margin-top:0px" class="modal-dialog">
    <div style="width:90vw !important;"   class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class=" text-center">{{ ucfirst($popup->title) }}</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      {{-- <div class="modal-body modal-image" style="background-image: url({{asset('uploads/news/thumbnail/'.$popup->image)}}")> --}}
       <a href="{{ @$popup->url}}" target="_blank"><img style="width: 100%;"class="img-fluid" src="{{asset('uploads/news/thumbnail/'.$popup->image)}}" alt="" srcset=""></a>
       
      </div>
    </div>
  </div>
</div>
@endif

@include('front.customers.customers')
@endsection






@section('front-js')
<script type="text/javascript">
  $(window).on('load',function(){
   var delayMs = 500; // delay in milliseconds
   
   setTimeout(function(){
       $('#myModal').modal('show');
   }, delayMs);
 }); 
 </script>

@endsection