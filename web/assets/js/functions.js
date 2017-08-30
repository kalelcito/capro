$(document).ready(function(){
    //hamburger effect
    $('.openbtn').click(function(){
        $('body').addClass('open');
        var width = $(window).width();
        if(width<400){
            $('.sidenav').css('width',width);
            $('.sidenav ul.main-menu li').css('transform','translate(-400px, 0px)');
            $('.sidenav .menu-footer ul').css('transform','translate(-480px,0px)');
            $('.sidenav .menu-footer div a').css('transform','translate(-370px,0px)');
        }else{
            $('.sidenav').css('width',400);
            $('.sidenav ul.main-menu li').css('transform','translate(-400px, 0px)');
            $('.sidenav .menu-footer ul').css('padding-left','20px');
            $('.sidenav .menu-footer div a').css('padding-left','30px');
            var i=1;
            $('.sidenav ul.main-menu li').map(function(){
                $(this).css('transition',(.5*i)+'s');
                i++;
            });
        }
    });
    $('.closebtn').click(function(){
        $('body').removeClass('open');
        $('.sidenav').css('width',0);
        $('.sidenav ul.main-menu li').css('transform','translate(400px, 0px)');
    });
    //carousel height
    var height = $(window).height();
    var img = $('#myCarousel img').height();
    var h3 = $('#myCarousel h3').height();
    var p = $('#myCarousel p').height();
    var space = h3 +p;
    $('#myCarousel').height(height);
    $('#myCarousel h3').css('margin-bottom',(height/2)-space);
    $('#myCarousel img').css('margin-bottom',(height/2)-img);
    $(window).resize(function(){
        height = $(window).height();
        img = $('#myCarousel img').height();
        $('#myCarousel').height(height);
        $('#myCarousel h3').css('margin-bottom',(height/2)-space);
        $('#myCarousel img').css('margin-bottom',(height/2)-img);
    });
    //carousel
    $('#myCarousel').carousel({
      interval: false,
        wrap: false
    });
    $(document).bind('keyup', function(e) {
        if(e.which == 40){
            $('#myCarousel').carousel('next');
        }
        else if(e.which == 38){
            $('#myCarousel').carousel('prev');
        }
    });
    $('.vertical .item').click(function(){
        $('#myCarousel').carousel('next');
    });
    $('.carousel-inner.vertical div.item:last-of-type').click(function(){
        $('#myCarousel').carousel(0);
    });
    $('#myCarousel').bind('mousewheel DOMMouseScroll', function(e){
        if(e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
            $(this).carousel('prev');
        }
        else{
            $(this).carousel('next');
        }
    });
    $(".carousel").swipe({
      swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
        if (direction == 'up') 
            $(this).carousel('next');
        if (direction == 'down') 
            $(this).carousel('prev');
      }
    });
    //animated carousel
    var $myCarousel = $('#myCarousel');
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
});