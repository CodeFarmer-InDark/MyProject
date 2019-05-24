function postars(canvas) {
    var _this = this, ctx = canvas.getContext('2d');
    _this.config = {
        star: {color: '#fff'},
        line: {color: '#fff', width: 0.1},
        position: {x: canvas.width * 0.5, y: canvas.height * 0.5},
        velocity: 0.1, length: 100, distance: 120, radius: 150, stars: []
    };
    function Star() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.vx = (_this.config.velocity - (Math.random() * 0.5));
        this.vy = (_this.config.velocity - (Math.random() * 0.5));
        this.radius = Math.random();
    }

    Star.prototype = {
        create: function () {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
            ctx.fill();
        }, animate: function () {
            var i;
            for (i = 0; i < _this.config.length; i++) {
                var star = _this.config.stars[i];
                if (star.y < 0 || star.y > canvas.height) {
                    star.vx = star.vx;
                    star.vy = -star.vy;
                }
                else if (star.x < 0 || star.x > canvas.width) {
                    star.vx = -star.vx;
                    star.vy = star.vy;
                }
                star.x += star.vx;
                star.y += star.vy;
            }
        }, line: function () {
            var length = _this.config.length, iStar, jStar, i, j;
            for (i = 0; i < length; i++) {
                for (j = 0; j < length; j++) {
                    iStar = _this.config.stars[i];
                    jStar = _this.config.stars[j];
                    if ((iStar.x - jStar.x) < _this.config.distance && (iStar.y - jStar.y) < _this.config.distance && (iStar.x - jStar.x) > -_this.config.distance && (iStar.y - jStar.y) > -_this.config.distance) {
                        if ((iStar.x - _this.config.position.x) < _this.config.radius && (iStar.y - _this.config.position.y) < _this.config.radius && (iStar.x - _this.config.position.x) > -_this.config.radius && (iStar.y - _this.config.position.y) > -_this.config.radius) {
                            ctx.beginPath();
                            ctx.moveTo(iStar.x, iStar.y);
                            ctx.lineTo(jStar.x, jStar.y);
                            ctx.stroke();
                            ctx.closePath();
                        }
                    }
                }
            }
        }
    };
    _this.createStars = function () {
        var length = _this.config.length, star, i;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (i = 0; i < length; i++) {
            _this.config.stars.push(new Star());
            star = _this.config.stars[i];
            star.create();
        }
        star.line();
        star.animate();
    };
    _this.setCanvas = function () {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    };
    _this.setContext = function () {
        ctx.fillStyle = _this.config.star.color;
        ctx.strokeStyle = _this.config.line.color;
        ctx.lineWidth = _this.config.line.width;
    };
    _this.loop = function (callback) {
        callback();
        reqAnimFrame(function () {
            _this.loop(function () {
                callback();
            });
        });
    };
    _this.bind = function () {
        jQuery(window).on('mousemove', function (e) {
            _this.config.position.x = e.pageX;
            _this.config.position.y = e.pageY;
        });
    };
    _this.init = function () {
        _this.setCanvas();
        _this.setContext();
        _this.loop(function () {
            _this.createStars();
        });
        _this.bind();
    };
    return _this;
}
var reqAnimFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
        window.setTimeout(callback, 1000 / 60);
    };

jQuery(document).ready(function () {

    //postars(jQuery('#main-nav .cover').get(0)).init();
    $('#slider').masterslider({
        controls: {
            circletimer: {autohide: false},
            'arrows': {autohide: true, overVideo: true},
            'bullets': {autohide: false, overVideo: true, dir: 'h', align: 'bottom', space: 6, margin: 10},
            //'timebar': {autohide: false, overVideo: true, align: 'top', color: '#FFFFFF', width: 4},
        },
        width: 1400,
        height: 450,
        minHeight: 0,
        space: 0,
        start: 1,
        grabCursor: true,
        swipe: true,
        mouse: true,
        keyboard: false,
        layout: "fullwidth",
        //fullwidth:true,
        //autoHeight:true,
        wheel: false,
        autoplay: true,
        instantStartLayers: true,
        loop: true,
        shuffle: false,
        preload: 0,
        heightLimit: true,
        autoHeight: false,
        smoothHeight: true,
        endPause: false,
        overPause: true,
        fillMode: "fill",
        centerControls: false,
        startOnAppear: false,
        layersMode: "center",
        filters1: {
            grayscale: 1,
            opacity: 0.5,
            brightness: 2
        },
        autofillTarget: "",
        hideLayers: false,
        fullscreenMargin: 0,
        speed: 10,
        dir: "h",
        parallaxMode: 'swipe',
        view: "basic" //fade , mask
    });




    //postars(jQuery('#main-nav .cover').get(0)).init();
    $('#videoslider').masterslider({
        controls: {
            //circletimer: {autohide: false},
            //'arrows': {autohide: true, overVideo: true},
            //'bullets': {autohide: false, overVideo: true, dir: 'h', align: 'bottom', space: 6, margin: 10},
            //'timebar': {autohide: false, overVideo: true, align: 'top', color: '#ffcc00', width: 4},
        },
        width: 1400,
        height: 450,
        minHeight: 0,
        space: 0,
        start: 1,
        grabCursor: true,
        swipe: true,
        mouse: true,
        keyboard: false,
        layout: "fullwidth",
        //fullwidth:true,
        //autoHeight:true,
        wheel: false,
        autoplay: true,
        instantStartLayers: true,
        loop: true,
        shuffle: false,
        preload: 0,
        heightLimit: true,
        autoHeight: false,
        smoothHeight: true,
        endPause: false,
        overPause: true,
        fillMode: "fill",
        centerControls: false,
        startOnAppear: false,
        layersMode: "center",
        filters1: {
            grayscale: 1,
            opacity: 0.5,
            brightness: 2
        },
        autofillTarget: "",
        hideLayers: false,
        fullscreenMargin: 0,
        speed: 10,
        dir: "h",
        parallaxMode: 'swipe',
        view: "basic" //fade , mask
    });

    /*
     var owl = $("#picturecarousel");

     owl.owlCarousel({
     navigation: true ,
     navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
     autoPlay: true ,
     items : 2, //10 items above 1000px browser width
     //itemsDesktop : [1000,5], //5 items between 1000px and 901px
     //itemsDesktopSmall : [900,3], // betweem 900px and 601px
     //itemsTablet: [600,2], //2 items between 600 and 0
     //itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
     });
     */
    if (jQuery('.colorbox-grid').length) {
        jQuery('.colorbox-grid').colorbox({
            rel:'group1' ,  width:"90%", height:"90%" , scrolling:false , slideshow:true ,
            //inline: true,
            href1: function () {
                if (jQuery(this).data('isgallery')) {
                    return jQuery(this).data('content') + ' .popup-data-gallery';
                } else {
                    return jQuery(this).data('content') + ' .popup-data:not(.popup-data-gallery)';
                }
            },
            //top: 110,
            //width: 690,
            //responsive: true,
            onOpen: function () {
                //jQuery('body').addClass('popup-active');
            },
            onClosed: function () {
                //jQuery('body').removeClass('popup-active');
            },
            previous: '<i class="fa fa-chevron-left"></i>',
            next: '<i class="fa fa-chevron-right"></i>',
            close: '<i class="fa fa-times"></i>',
        });
    }


    $("img.lazy").lazyload();

    /*
     $(".play-btn").click(function(){
     var modalId = $(this).attr("href");
     $(modalId).modal();
     })
     */
});
//jQuery(".star").each(function() {
//});