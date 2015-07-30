function init() {
    window.addEventListener('scroll', function(e){
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 300,
            h2r = document.querySelector("h2r");
        if (distanceY > shrinkOn) {
            classie.add(h2r,"smaller");
        } else {
            if (classie.has(h2r,"smaller")) {
                classie.remove(h2r,"smaller");
            }
        }
    });
}
window.onload = init();