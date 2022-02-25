

$(document).ready(function() {
    var counter = function(){
        var currentPage = this.pageCount,
            itemCount = this.itemCount,
            scrollItems = this.options.scroll;
        $('#counter').html(currentPage+' / '+(itemCount / scrollItems));
    }
    
    $('#carousel').waltzer({
                        scroll:1,
                        auto: true,
                        autoPause: 10000,
                        onCreate: counter,
                        onComplete: counter
                    });
    
});

