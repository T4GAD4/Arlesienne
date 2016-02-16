$(document).ready(function(){    
    
    cheet('o p p a', function () {
        $('.konami').removeClass('hidden');
        var img = "<img src='assets/images/konami/hoppa.gif'/>";
        $('.konami').html(img);
    });
    
    cheet('h a p p y', function () {
        $('.konami').removeClass('hidden');
        var img = "<img src='assets/images/konami/happy.gif'/>";
        $('.konami').html(img);
    });
    
    cheet('c l o w n', function () {
        $('.konami').removeClass('hidden');
        var img = "<img src='assets/images/konami/clown.gif'/>";
        $('.konami').html(img);
    });
    
    cheet('f x', function () {
        $('.konami').removeClass('hidden');
        var img = "<img src='assets/images/konami/fx.jpg'/>";
        $('.konami').html(img);
    });
    
    cheet('j o k e r', function () {
        $('.konami').removeClass('hidden');
        var img = '<iframe width="640" height="360" src="https://www.youtube.com/embed/ElOEwtx7wjA?autoplay=1" frameborder="0" allowfullscreen></iframe>';
        $('.konami').html(img);
    });
    
    
    cheet('h o t', function () {
        $('.konami').removeClass('hidden');
        var img = "<img src='assets/images/konami/hot.gif'/>";
        $('.konami').html(img);
    });
    
    
});

function konami(){
    $('.konami').empty();
    $('.konami').addClass('hidden');
}

