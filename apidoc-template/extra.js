/**
 * Put this into public/doc/index.html like this:
 *   <script src="jquery-3.3.1.min.js"></script>
 *   <script src="extra.js"></script>
 */
$(".container-fluid").ready(function() {
    setTimeout(function(){
        var param = 'form-horizontal';
        var myObj = $('[class ="' + param + '"]');

        myObj.prev().css("background-color", "#eee");
        myObj.prev().css("color", "#337ab7");
        myObj.prev().css("cursor", "pointer");
        myObj.prev().css("border-color", "#e5e5e5");
        myObj.prev().css("border-width", "1px 1px 4px 5px");
        myObj.prev().css("border-style", "solid");
        myObj.prev().css("width", "250px");
        myObj.css("display", "none");

        myObj.prev().addClass(function( index ) {
            return "button-example-" + index;
        });

        myObj.addClass(function( index ) {
            return "example-" + index;
        });


        for(var i=0; i < myObj.length; i++) {
            $(".button-example-" + i).on("click", function () {
                var forma = $(this).attr("class").replace("button-", "");
                if ($("." + forma).css("display") == "none") {
                    $("." + forma).css("display", "block");
                } else {
                    $("." + forma).css("display", "none");
                }
            });
        }

    },3000);
});

/*
 myObj.prev().on("click", function () {
                if (myObj.css("display") == "none") {
                    myObj.css("display", "block");
                } else {
                    myObj.css("display", "none");
                }
            });
 */
