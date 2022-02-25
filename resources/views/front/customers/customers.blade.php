
<style>
  .customerimg-div:hover{
    text-decoration: none!important;
    border-bottom:none;
    transform: scale(1.1);
  }
</style>
{{-- <section id="custo" class="container py-3">
  <div>
    <div class=" text-center text-success py-5">
      <h2 class="mb-3">International Partners</h2>
      <div>
        <div class="logos-customers">
          @foreach($client as $data)
         <img class="customer-anchor" href="#" style="width:10%;" src="{{ asset('uploads/clients/thumbnail/'.$data->image) }}" alt="">
          @endforeach
        </div>
        
      </div>
    </div>
  </div>
</section> --}}

<section id="custo" class="py-3">
  <div class="pb-3 text-center" >
  <h1>International Partners</h1>
  </div> 
  <div class="responsive slider">
    @foreach($client as $data)
    <a class="customerimg-div" style="text-decoration: none!important;" href="#" target="_blank" rel="noopener noreferrer">
      <div style="padding: 4%;">
        <img src="{{ asset('uploads/clients/thumbnail/'.$data->image) }}">
      </div>
     </a>
     @endforeach
  </div>
</section> 
<section class="py-3">
  <div class="pb-3 text-center" >
  <h1>National Partners</h1>
  </div>
 
  <div class="responsive slider">
    @foreach($client as $data)
    <a class="customerimg-div" style="text-decoration: none!important;" href="#" target="_blank" rel="noopener noreferrer">
      <div style="padding: 4%;">
        <img src="{{ asset('uploads/clients/thumbnail/'.$data->image) }}">
      </div>
     </a>
     @endforeach
  </div>
</section> 
<section class="py-3">
  <div class="pb-3 text-center" >
  <h1>Technical Partners</h1>
  </div>
 
  <div class="responsive slider">
    @foreach($client as $data)
    <a class="customerimg-div" style="text-decoration: none!important;" href="#" target="_blank" rel="noopener noreferrer">
      <div style="padding: 4%;">
        <img src="{{ asset('uploads/clients/thumbnail/'.$data->image) }}">
      </div>
     </a>
     @endforeach
  </div>
</section> 


