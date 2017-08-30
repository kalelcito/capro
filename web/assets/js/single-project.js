$(document).ready(function(){
    var height = $(window).height();
    var width = $(window).width();
    $('#single-carousel').height(height);    
    var logo = $('.brand1 .logo-single').width();
    $('.brand1 .logo-single').css('margin-left',(width-logo)/2);
    var img = $('#single-carousel').height();
    var h3 = $('#single-carousel h3').height();
    $('#single-carousel h3').css('margin-bottom',(img/2)-h3);    
    var initial = $('#single-carousel .active').index('#single-carousel .item');
    var t = $('#single-carousel .item').length;
    var init= initial+1;
    $(".progress-line").width((width/t)*init);
    $(window).resize(function(){
        height = $(window).height();
        width = $(window).width();
        $('#single-carousel').height(height);
        $('.brand1 .logo-single').css('margin-left',(width-logo)/2);
        var img = $('#single-carousel').height();
        var h3 = $('#single-carousel h3').height();
        $('#single-carousel h3').css('margin-bottom',(img/2)-h3);    
    });
    
    //carousel
    $('#single-carousel').carousel({
      interval: 4000,
        wrap: true,
        pause: "hover"
    });
    $(document).bind('keyup', function(e) {
        if(e.which == 39){
            $('#single-carousel').carousel('next');
        }
        else if(e.which == 37){
            $('#single-carousel').carousel('prev');
        }
    });
    $("#single-carousel").swipe({
      swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
        if (direction == 'left') 
            $(this).carousel('next');
        if (direction == 'right') 
            $(this).carousel('prev');
      }
    });
    
    $('.carousel').on('slid.bs.carousel', function () {
        var carouselData = $(this).data('bs.carousel');
        var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
        var current = (currentIndex + 1);
        var total = carouselData.$items.length;
        var width = $(window).width();
        $(".progress-line").width((width/total)*current);
    });
    
    //animated carousel
    var $myCarousel = $('#single-carousel');
    function doAnimations(elems) {
      var animEndEv = 'webkitAnimationEnd animationend';

      elems.each(function () {
        var $this = $(this),
            $animationType = $this.data('animation');
        $this.addClass($animationType).one(animEndEv, function () {
          $this.removeClass($animationType);
        });
      });
    }

    var $firstAnimatingElems = $myCarousel.find('.item:first')
                               .find('[data-animation ^= "animated"]');

    doAnimations($firstAnimatingElems);
    $myCarousel.carousel('pause');

    $myCarousel.on('slide.bs.carousel', function (e) { 
      var $animatingElems = $(e.relatedTarget)
                            .find("[data-animation ^= 'animated']");
      doAnimations($animatingElems);
    });

    //menu
    $('.openbtn, .single .brand1').hover(function(){
        $('.single .brand1').css('background','white');
    });
    $('.openbtn, .single .brand1').mouseleave(function(){
        $('.single .brand1').css('background','transparent');
    });
    
    //mouse
    var timeout;
    document.onmousemove = function(){
        clearTimeout(timeout);
        timeout = setTimeout(
            function(){
                $('.single .options').addClass('hide');
            }
            , 4000);
    }
    document.getElementById("move").addEventListener("mousemove", function(event) {
        myFunction(event);
    });

    function myFunction(e) {
        $('.single .options').removeClass('hide');
    }
    $('.middle').click(function(){
        if($('.middle').hasClass('op')){
            $('.middle').html('INFO');
            $('.middle').removeClass('op');
            $('.single .options').css('bottom','0px');
            $('.content').css('display','none');
        }else{
            $('.middle').html('CERRAR');
            $('.middle').addClass('op');
            $('.content').css('display','block');
            var space = $('.content').height();
            $('.single .options').css('bottom',(space-5)+'px');
        }
    })
});