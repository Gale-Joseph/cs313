/*The following commented out code changes the color of
 * the paragraph with id=pColor to the color inputted by 
 * user in textarea if textarea text is a valid color */

//function changeColor() {
//    var color = document.getElementById("textarea").value;
//    document.getElementById("pColor").style.color = color;
//    console.log(color);
//}


/* The following function uses jQuery to change the color
 * of the textarea background to the color typed by the 
 * user, if the color is valid 
 * The seond function toggles div3 in and out using 
 * JQuery FadeToggle*/

$(document).ready(function () {

    $("button").click(function () {
        var color = $("textarea").val();
        console.log(color);
        $("textarea").css("background-color", color);
    });

   
    $("input.buttonToggle").click(function () {        
            console.log("Using FadeToggle");
            $("#div3").fadeToggle(3000);
                
    });
});