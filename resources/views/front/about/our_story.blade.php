@extends('front.front_layout')

@section('content')



  <!-- About us section -->
  <div class="container py-1">
    <div class="card mb-3">
        <div class="row justify-content-between g-0">

            <div class="col-md-9">
                <div class="card-body">
                    <h1 class="card-title">OUR STORY</h1>
                    <p class="paragraph">{!! $about->about_description !!}</p>
                        <!-- <span class="bg-secondary p-1" id="abtreadmore" >Read More</span> -->
                </div>
            </div>
            <div class="col-md-3">
                <img src="{{ asset('uploads/abouts/thumbnail/'.$about->image) }}" class="img-fluid rounded-start" alt="...">
                <img src="{{ asset('uploads/abouts/thumbnail/'.$about->image) }}" class="img-fluid rounded-start mt-1" alt="...">
            </div>
            {{-- <div class="col-md-12 px-3">
                
            </div> --}}
        </div>
    </div>
</div>
<div class="container-fluid break"></div>




@endsection

@section('customer')
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
        <a href="#" class="btn btn-lg mt-4 ">LEARN MORE</a>
      </div>
    </div>
  </div>
</section>
@include('front.customers.customers')
@endsection


@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
@endsection