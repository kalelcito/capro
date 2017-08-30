$(document).ready(function(){
    var height = $(window).height();
    var width = $('.brand1').width();
    var brand1 = $('.brand1').height();
    var brand2 = $('.brand2').height();
    var logo = $('.brand1 .logo').width();
    $('.brand1 .logo').css('margin-left',(width-logo)/2);
    $('#carousel-projects').height(height-(brand1+brand2+10));
    var img = $('#carousel-projects').height();
    var h3 = $('#carousel-projects h3').height();
    $('#carousel-projects h3').css('margin-bottom',(img/2)-h3);    
    if(width<=400){
            $('.brand1 .logo').css('margin-left',(width-logo)/3);
        }
    $(window).resize(function(){
        height = $(window).height();
        width = $(window).width();
        $('.brand1 .logo').css('margin-left',(width-logo)/2);
        $('#carousel-projects').height(height-(brand1+brand2+10));
        var img = $('#carousel-projects').height();
        var h3 = $('#carousel-projects h3').height();
        $('#carousel-projects h3').css('margin-bottom',(img/2)-h3);    
        if(width<=400){
            $('.brand1 .logo').css('margin-left',(width-logo)/3);
        }
    });
    
    //carousel

    $('#carousel-projects').carousel({
      interval: false,
        wrap: false
    });
    $(document).bind('keyup', function(e) {
        if(e.which == 40){
            $('#carousel-projects').carousel('next');
        }
        else if(e.which == 38){
            $('#carousel-projects').carousel('prev');
        }
    });
    $('#carousel-projects').bind('mousewheel DOMMouseScroll', function(e){
        if(e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
            $(this).carousel('prev');
        }
        else{
            $(this).carousel('next');
        }
    });
    $('.brand2 .ion-ios-arrow-thin-down').click(function(){
        var data = $('.brand2 i').attr('data');
        if(data=='end'){
            $('#carousel-projects').carousel(0);
        }else if(data=='next'){
            $('#carousel-projects').carousel('next');
        }
    });
    $('.carousel').on('slid.bs.carousel', function () {
      var carouselData = $(this).data('bs.carousel');
      var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
      var total = carouselData.$items.length;
      var current = (currentIndex + 1);
        if(current==total){
            $('.brand2 i').removeClass('ion-ios-arrow-thin-down');
            $('.brand2 i').addClass('ion-ios-arrow-thin-up');
            $('.brand2 i').attr('data','end');
        }else{
            $('.brand2 i').addClass('ion-ios-arrow-thin-down');
            $('.brand2 i').removeClass('ion-ios-arrow-thin-up');
            $('.brand2 i').attr('data','next');
        }
    });
    //animated carousel

    var $myCarousel = $('#carousel-projects');
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