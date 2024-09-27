@extends('layouts.simple.master')
@section('title', 'Product Page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Room Types </li>
<li class="breadcrumb-item active">{{$roomtype->name}}</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 box-col-4">
         <div class="card">
            <div class="card-header">
               <h5>{{$roomtype->name}}</h5>
            </div>
            @if($roomtype->id==1)
            <div class="card-body photoswipe-pb-responsive">
               <div class="my-gallery row grid gallery" id="aniimated-thumbnials" itemscope="">
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/1/1.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/1/1.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/1/2.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/1/2.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/1/3.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/1/3.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/1/4.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/1/4.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/1/5.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/1/5.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
               </div>
            </div>
            @elseif($roomtype->id==2)
            <div class="card-body photoswipe-pb-responsive">
               <div class="my-gallery row grid gallery" id="aniimated-thumbnials" itemscope="">
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/2/1.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/2/1.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/2/2.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/2/2.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/2/3.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/2/3.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/2/4.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/2/4.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/2/5.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/2/5.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
               </div>
            </div>
            @elseif($roomtype->id==3)
            <div class="card-body photoswipe-pb-responsive">
               <div class="my-gallery row grid gallery" id="aniimated-thumbnials" itemscope="">
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/3/1.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/3/1.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/3/2.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/3/2.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/3/3.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/3/3.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/3/4.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/3/4.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/3/5.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/3/5.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
               </div>
            </div>
            @elseif($roomtype->id==4)
            <div class="card-body photoswipe-pb-responsive">
               <div class="my-gallery row grid gallery" id="aniimated-thumbnials" itemscope="">
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/4/1.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/4/1.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/4/2.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/4/2.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/4/3.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/4/3.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/4/4.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/4/4.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/4/5.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/4/5.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
               </div>
            </div>
            @elseif($roomtype->id==5)
            <div class="card-body photoswipe-pb-responsive">
               <div class="my-gallery row grid gallery" id="aniimated-thumbnials" itemscope="">
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/5/1.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/5/1.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/5/2.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/5/2.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/5/3.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/5/3.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/5/4.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/5/4.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
                  <figure class="col-md-3 col-sm-6 grid-item" itemprop="associatedMedia" itemscope="">
                     <a href="{{asset('assets/images/5/5.jpg')}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('assets/images/5/5.jpg')}}" itemprop="thumbnail"></a>
                     </figure>
               </div>
            </div>
            @endif
            <!-- Root element of PhotoSwipe. Must have class pswp.-->
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
               <!--
                  Background of PhotoSwipe.
                  It's a separate element, as animating opacity is faster than rgba().
                  -->
               <div class="pswp__bg"></div>
               <!-- Slides wrapper with overflow:hidden.-->
               <div class="pswp__scroll-wrap">
                  <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
                  <!-- don't modify these 3 pswp__item elements, data is added later on.-->
                  <div class="pswp__container">
                     <div class="pswp__item"></div>
                     <div class="pswp__item"></div>
                     <div class="pswp__item"></div>
                  </div>
                  <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
                  <div class="pswp__ui pswp__ui--hidden">
                     <div class="pswp__top-bar">
                        <!-- Controls are self-explanatory. Order can be changed.-->
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
                        <!-- element will get class pswp__preloader--active when preloader is running-->
                        <div class="pswp__preloader">
                           <div class="pswp__preloader__icn">
                              <div class="pswp__preloader__cut">
                                 <div class="pswp__preloader__donut"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                     </div>
                     <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                     <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                     <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="product-page-details">
                  <h3>Rate.</h3>
               </div>
               <div class="product-price f-28">N{{number_format($roomtype->rate)}}  
               </div>
               <hr>
               <p>{{$roomtype->description}}</p>
               <hr>
               <div>
                  <table class="product-page-width">
                     <tbody>
                        <tr>
                           <td> <b>Facilities :</b></td>
                           <td>{{$roomtype->facilities}}</td>
                        </tr>

                     </tbody>
                  </table>
               </div>
               <hr>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/isotope.pkgd.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
<script src="{{asset('assets/js/masonry-gallery.js')}}"></script>
@endsection

         
        
