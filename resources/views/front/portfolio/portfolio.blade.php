@extends('front.front_layout')

@section('front-css')

<link rel="stylesheet" href="{{ asset('front/styles/portfolio.css') }}">

<style>
     .project-div:hover {
            border-radius: 20px !important;
            box-shadow: 5px 5px 5px 5px #888888;
        }
    .project-div:hover img {
        /* border-top-left-radius: 20px;
    border-top-right-radius:20px; */
        border-radius: 20px 20px 0px 0px !important;
    }

    
    
</style>



@endsection

@section('content')

<section class="container-fluid">
    <div class="container py-3 card-body">
        <h1 class="text-start portfolio-header">Portfolio</h1>
        <div class="xs-3">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis fugit a, consequatur mollitia
                perferendis sapiente modi dignissimos itaque velit ab, quae vel quas eius? Ipsum repudiandae
                provident vitae nesciunt voluptate!\</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui quis nesciunt harum, quibusdam animi sit
                eum nam repellat doloremque facere, praesentium earum, saepe quo delectus ratione consequuntur
                blanditiis aliquid omnis?</p>
        </div>

        @isset($portfolios)
        <div class="row">
            <div class="col-md-3">
                <div class="client-type-container ">

                    <div class="client-type-inner all" id="all">
                        <div class="d-flex bg-success">
                            <div class="portfolio-icon-container p-2 bg-warning">
                                <img style="width: 40px;height: 40px;" src="{{ asset('front/Images/gov-icon.png') }}"
                                    class="img-fluid portfolio-icons" alt="" srcset="">
                            </div>
                            <div >
                                <a href="javascript:;" class="sector_id" data-sector="all"><p class="p-1 pt-3">All</p></a>
                            </div>
                        </div>
                    </div>
                    @foreach($portfolios as $portfolio)
                        <div class="mt-2 client-type-inner government" id="government">
                            <div class="d-flex bg-success">
                                <div class="portfolio-icon-container p-2 bg-warning">
                                    <img style="width: 40px;height: 40px;" src="{{ asset('uploads/sectors/thumbnail/'.$portfolio->image) }}"
                                        class="img-fluid portfolio-icons" alt="" srcset="">
                                </div>
                                <div>
                                    <a href="javascript:;" class="sector_id" data-sector="{{ $portfolio->id }}"><p>{{ ucfirst($portfolio->title)}}</p></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- list of organizations -->
            <div style="overflow-y: scroll; " class="col-md-9 list0f-organizations">

                <div style="max-height: 450px; " class="recomendation">

                    <div class="row org-header">
                        <div class="col-7">Name of organization</div>
                        <div class="col-5">Recomendation</div>
                    </div>
                    
                   <div  class="" style="" id="sector-field" >
                    @foreach($all_sector as $sector)
                        <div class="row list-odd">
                            <div class="col-7">{{ ucfirst($sector->title)}}</div>
                            <a href="{{ asset('uploads/file/'.$sector->pdf) }}" class="col-5 " target="_blank"> <div >Something.pdf</div></a>
                        </div>
                    @endforeach
                   </div>
                </div>

            </div>
        </div>
        @endisset

     
    </div>
</section>

<div class="container-fluid bg-success footer-break"></div>

@include('front.customers.customers')
@endsection


@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
<script src="{{asset('front/javascript/portfolio.js') }}"></script>

<script>
    $('.sector_id').on('click',function(e){
        e.preventDefault();
        var id=$(this).data('sector');

        $.ajax({
            url:"{{ route('get-sector')}}",
            type:"get",
            data:{
                sector_id:id
            },
            success:function(response)
            {
                if(typeof(response) !='object')
                    {
                        response=JSON.parse(response);
                    }
                    var sector_html="";
                    if(response.error)
                    {
                        alert(response.error);
                    }
                    else
                    {
                        if(response.data.length >0)
                        {
                            $.each(response.data,function(index,value){
                                sector_html+="<div class='row list-odd'>";
                                sector_html+="<div class='col-7'>"+value.title+"</div>";
                                sector_html+="<a href='"+response.path+"/"+value.pdf+"' target='_blank' class='col-5'> <div >Something.pdf</div></a>";
                                sector_html+="</div>";                                
                            });
                        }
                    }
                    $('#sector-field').html(sector_html);

                   
            }
        })
    })
</script>         
                        
@endsection