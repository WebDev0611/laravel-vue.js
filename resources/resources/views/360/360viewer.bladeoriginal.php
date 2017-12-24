@extends('360.layouts.360')
@section('page-name', '360Viewer')

@section('head-assets')
<script src="{{ asset('js/360Viewer.js') }}"></script>
@endsection

@section('content')

{{-- Flash Messages --}}
<div class="flash-message-box visible" data-flash-messages></div>

{{-- Header --}}
@include('components/header')

<script type="text/javascript">
    javascript:(function(){var script=document.createElement('script');script.onload=function(){var stats=new Stats();document.body.appendChild(stats.dom);requestAnimationFrame(function loop(){stats.update();requestAnimationFrame(loop)});};script.src='//rawgit.com/mrdoob/stats.js/master/build/stats.min.js';document.head.appendChild(script);})()

</script>
<main class="app-main">
<?php if($user->company) { ?> 
    <div class="hidden" data-image-base="{{ asset('upload/' . str_replace(' ','',$user->company) . '/tours/'. $tour->id .'/rooms') }}/"></div>
<?php } else { ?>
    <div class="hidden" data-image-base="{{ asset('upload/' . str_replace(' ','',$user->name) . $user->id . '/tours/'. $tour->id .'/rooms') }}/"></div>
<?php } ?>
    <div class="images hidden">
        @foreach ($rooms as $room)
            <?php if($user->company) { ?>       
            <div class="hidden"
                 data-image
                 data-image-src="{{ asset('upload/' . str_replace(' ','',$user->company) . '/tours/'. $tour->id .'/rooms/' . $room->name . '.jpg') }}"
            ></div>
            <?php } else { ?>
            <div class="hidden"
                 data-image
                 data-image-src="{{ asset('upload/' . str_replace(' ','',$user->name) . $user->id . '/tours/'. $tour->id .'/rooms/' . $room->name . '.jpg') }}"
            ></div>
            <?php } ?>
        @endforeach
    </div>

    <section class="canvas-container" data-360-space></section>

    <div class="app-loader">
        <div class="app-loader__spinner">Loading...</div>
    </div>

    <aside class="uploads-sidebar">

        <div class="uploads-sidebar__gradient"></div>

        <div class="uploads-sidebar__overflow">
            <div class="uploads-sidebar__scroll">
                <div class="uploads-sidebar__inner">
                    <ul data-uploads-navigation>
                    {{-- Thumbs Appended here via JS::UiController.js --}}
                    </ul>
                </div>

            </div>            
        </div>
    </aside>

    <footer class="uploads-toolbar">

        <div class="uploads-toolbar__controls">
            <ul>
               <!--  <li data-tool-toggle data-tool="newUpload">
                    <i class="material-icons">add_circle_outline</i>
                </li> -->
                <li id="location" data-tool-toggle data-tool="roomConnector">
                    <i class="material-icons">room</i>
                </li>
                

            </ul>

        </div>
       <!-- I got these buttons from simplesharebuttons.com -->
<div id="share-buttons">
 
    <!-- Facebook -->
    <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
    </a>
    
    <!-- Google+ -->
    <a href="https://plus.google.com/share?url={{ url()->current() }}" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
    </a>
    
    <!-- LinkedIn -->
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ url()->current() }}" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
    </a>
    
    <!-- Pinterest -->
    <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
        <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
    </a>

    <!-- Twitter -->
    <a href="https://twitter.com/share?url={{ url()->current() }}" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
    </a>
    
        <!-- Email -->
    <a href="mailto:?Subject=Viewplex tours&amp;Body= https://simplesharebuttons.com">
        <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
    </a>

</div>
        <?php if (empty(session('tourlikes_' . $tour->id))) { ?>
        <form method="POST" action="{{ url('/getmsg') }}">
         {{ csrf_field() }}
          <input type="hidden" name="tour_id" value="{{ $tour->id }}">
          <input type="submit" name="like" class="btn btn-primary cherry" value="Like">
        </form>
        <?php } else { ?>
        <form method="POST" action="{{ url('/getmsg') }}">
         {{ csrf_field() }}
          <input type="hidden" name="tour_id" value="{{ $tour->id }}">
          <input type="submit" name="like" class="btn btn-primary cherry" value="Liked" disabled="disabled">
        </form>
        <?php } ?>
        <span id='likes' style="color: white;margin-top: 67px;margin-left: -22px;">{{ $tour->likes }}</span>
                    <div class="icon"><img src="http://www.endlessicons.com/wp-content/uploads/2012/11/view-icon.png" height="50" width="50"><span style="color: white;margin-top: 67px;position: absolute;margin-left: -51px;">{{ $tour->views }}</span><img src="{{ asset('upload/' . str_replace(' ','',$user->company) .'/tours/'. $tour->id .'/thumbnail/icon.jpg') }}"></div>

    </footer>

    <div class="hidden" data-tour-data='{{ $tour->tour_data }}'></div>

    <div id="dialog" title="Tour Location">
  <p>{{ $tour->address_postcode }}</p>
</div>
</main>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.2.1.min.js
"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        $('.uploads-sidebar__upload').css('background-image', 'url(http://www.endlessicons.com/wp-content/uploads/2012/11/view-icon.png)');
        $('#location').click(function(){
           $( function() {
            $( "#dialog" ).dialog();
          } );
        });
        $(".uploads-sidebar__upload").click(function(e){
              $(this).addClass('active')
              $(this).find('.uploads-sidebar__upload-thumb').show();
              $(this).siblings().find('.uploads-sidebar__upload-thumb').hide();
        });   
        $(document).delegate(".cherry","click",function(e){ 
            e.preventDefault();
            var idval = this.id;
            console.log(idval);
            var toud_id = "{{$tour->id}}";    
            $.ajax({
              url: '/likes',
              type: "post",
                    beforeSend: function (xhr) {
                    var token = $('input[name="_token"]').attr('value');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }                
                }, 
                data: {'id': idval, 'tour_id': toud_id},
                success:function(data){
                
                console.log(data.msg);
                $('input[type="submit"]').attr('disabled','disabled');
                $('input[type="submit"]').attr('value','Liked');
                $('#likes').html(data.likes);
                  // $( "."+idval ).load('../home  .'+idval);    
                  
                },error:function(){ 
                    console.log("error!!!!");
                } 
        });      
 });  


});
</script>
<style type="text/css">
  .uploads-sidebar__upload {
    background-size: 200px,200px;
    background-position: center;
    background-repeat: no-repeat;
   }
   .uploads-sidebar__upload-thumb {
    display: none;
   }
   form .cherry {
      padding: 8px;
  }
   #dialog {
    display: none;  
   }
   .icon img{
    width: 100px;
    height: 100px;
   }
   #share-buttons img {
    width: 50px;
    height: 50px;
    float: left;
    margin-right: 8px;
}
</style>
{{-- Footer --}}
@include('components/footer')

@endsection
