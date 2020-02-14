// $("#sub").click(function(){
//     var data = $("#myForm: input").serializeArray();
//     $.post($("#myForm").attr("action"),data,"success");
// });

// $("#myForm").submit(function(){
//     return false;
// });
jQuery(document).ready(function(){
    $('#myForm').submit(function(e){
        e.preventDefault();
        var inputs = $(this).serialize();
        $.post("insert.php",inputs,function(){
            $('.content').load('refresh.php');
        })
    })
})