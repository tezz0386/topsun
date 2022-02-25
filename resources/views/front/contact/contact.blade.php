@extends('front.front_layout')

@section('front-css')

<link rel="stylesheet" href="{{ asset('front/styles/gallery.css') }}">
@endsection

@section('content')
@include('front.message')
 <!-- contact us -->

 <div class="  contact-us">
    <div class="contact-us-input-area ">
     <div  class="container  py-3">
         <h1 class="mt-3 text-center">Get in Touch</h1>
         <div class="row">
             <div class="col-md-4">
               <div class="mt-2 p-2">
                 <div class="contact-info m-1">
                     <div class="contact-info-item">
                         <div class="contact-info-icon">
                             
                         </div>
                         <div class="contact-info-text">
                             <h2 style="color: #f26f1f;">  <i class="bi bi-map-fill"></i> Address</h2>
                             <span style="color: chartreuse;">Sanobharyang,Nagarjun-02, </span>
                             <span style="color: chartreuse;"> Kathmandu,Nepal</span>
                         </div>
                     </div>
                 </div>
                 <div class="contact-info m-1">
                     <div class="contact-info-item">
                         <div class="contact-info-icon">
                           
                         </div>
                         <div class="contact-info-text">
                             <h2 style="color: #f26f1f;"><i class="bi bi-envelope-open-fill"></i> E-mail</h2>
                             <a style="color: chartreuse;" class=" ms-2" href="mailto:topsun@ntc.net.np">topsun@ntc.net.np</a> 
                             
                         </div>
                     </div>
                 </div>
                 <div class="contact-info m-1">
                     <div class="contact-info-item">
                         <div class="contact-info-icon">
                            
                         </div>
                         <div class="contact-info-text">
                             <h2 style="color: #f26f1f;"><i class="bi bi-telephone-fill"></i> Phone</h2>
                             <span><a style="color: chartreuse;" href="tel:+977-1-4891268">+977-1-4891268</a></span> <br>
                             <span><a style="color: chartreuse;" href="tel:+977-1-4891268">+977-1-4891808 </a></span>
 
                         </div>
                     </div>
                 </div>
               </div>
 
             </div>
             <div class="col-md-8">
                 <div class="contact-page-form" method="post">
                    {{ Form::open(['url'=>route('post-message')])}}
                    @method('put')
                         <div class="row ">
                             <div class=" col-sm-6 col-xs-12 mt-2 p-2">
                                {{ Form::text('customer_name','',['class'=>'form-control '.($errors->has('customer_name') ?'is-invalid':''),'required'=>true,'placeholder'=>'Customer Name'])}}
                                    @error('customer_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                             </div>
                             <div class="col-sm-6 col-xs-12 mt-2 p-2">
                                {{ Form::email('email','',['class'=>'form-control '.($errors->has('email') ?'is-invalid':''),'required'=>true,'placeholder'=>'Customer Email'])}}
                                @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                             </div>
                             <div class=" col-sm-6 col-xs-12 mt-2 p-2">
                                {{ Form::text('phone','',['class'=>'form-control '.($errors->has('phone') ?'is-invalid':''),'required'=>false,'placeholder'=>'Customer Phone'])}}
                                @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                             </div>
                             <div class=" col-sm-6 col-xs-12 mt-2 p-2">
                                {{ Form::text('subject','',['class'=>'form-control '.($errors->has('subject') ?'is-invalid':''),'required'=>false,'placeholder'=>'Subject'])}}
                                @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                             </div>
                               <div class="mt-2 p-2">
                                
                                {{ Form::textarea('customer_message','',['class'=>'form-control '.($errors->has('customer_message') ?'is-invalid':''),'required'=>true,'placeholder'=>'Message','rows'=>7])}}
                                @error('customer_message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                               </div>
                               {{ Form::button('Submit',['class'=>'btn btn-lg col-md-4 mt-2 p-2','type'=>'submit'])}}
                         </div>
                    {{ Form::close()}}
                 </div>
             </div>
         </div>
     </div>
    </div>
   </div>
   <div class="container-fluid bg-success footer-break"></div>
   
   <!-- map -->
     
   <div id="map" class="container-fluid">
     <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3430.70892610487!2d85.32714672111676!3d27.740855264914686!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19f82fb3fd73%3A0x989586b29a39a2e6!2sOnviro%20Tech%20P.%20Ltd!5e0!3m2!1sen!2snp!4v1641727754000!5m2!1sen!2snp" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
 </div>
     <div class="container-fluid break"></div>
@include('front.customers.customers')

@endsection



@section('front-js')
<script>

    setTimeout(function(){
        $('.alert').slideUp();
    },3000);
</script>
@endsection