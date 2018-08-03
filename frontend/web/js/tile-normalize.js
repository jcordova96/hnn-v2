/**
 * Created by juddbundy on 8/28/15.
 */
$(window).load(function(){
    var maxHeight = 0;
    var elements = $(".news-tile");
    elements.each(function () {
        var currentHeight = $(this).height()
        if (maxHeight < currentHeight) {
            maxHeight = currentHeight;
        }
    });
    elements.css("height", maxHeight);
});
