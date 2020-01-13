//function changeColor() {
//    var color = document.getElementById("textarea").value;
//    document.getElementById("pColor").style.color = color;
//    console.log(color);
//}



$(document).ready(function () {

    $("button").click(function () {
        var color = $("textarea").val();
        console.log(color);
        $("textarea").css("background-color", color);
    });

    //use class 
    $("input.buttonToggle").click(function () {        
            console.log("Using FadeToggle");
            $("#div3").fadeToggle(3000);
                
    });
});