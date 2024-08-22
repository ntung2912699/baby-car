// script.js
$(document).ready(function() {
    var $image = $('#zoom-image');
    var $lens = $('#zoom-lens');
    var $result = $('#zoom-result');

    // Set size for lens and result
    var lensSize = 100;
    var resultSize = 300;

    $lens.css({
        width: lensSize + 'px',
        height: lensSize + 'px',
        borderRadius: '50%'
    });

    $result.css({
        width: resultSize + 'px',
        height: resultSize + 'px',
        backgroundImage: 'url(' + $image.attr('src') + ')',
        backgroundSize: $image.width() * (resultSize / lensSize) + 'px ' + $image.height() * (resultSize / lensSize) + 'px'
    });

    // Mousemove event handler
    $image.mousemove(function(e) {
        var imageOffset = $image.offset();
        var x = e.pageX - imageOffset.left;
        var y = e.pageY - imageOffset.top;

        // Calculate lens position
        var lensX = x - $lens.width() / 2;
        var lensY = y - $lens.height() / 2;

        // Ensure lens is within image bounds
        if (lensX < 0) lensX = 0;
        if (lensY < 0) lensY = 0;
        if (lensX > $image.width() - $lens.width()) lensX = $image.width() - $lens.width();
        if (lensY > $image.height() - $lens.height()) lensY = $image.height() - $lens.height();

        $lens.css({
            left: lensX + 'px',
            top: lensY + 'px'
        });

        // Calculate result image position
        var resultX = lensX * (resultSize / lensSize);
        var resultY = lensY * (resultSize / lensSize);

        $result.css({
            backgroundPosition: '-' + resultX + 'px -' + resultY + 'px'
        });
    });

    // Hide lens and result on mouseleave
    $image.mouseleave(function() {
        $lens.hide();
        $result.hide();
    });

    // Show lens and result on mouseenter
    $image.mouseenter(function() {
        $lens.show();
        $result.show();
    });
});
