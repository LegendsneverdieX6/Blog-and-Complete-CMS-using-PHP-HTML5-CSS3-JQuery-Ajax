/**
 * Created by Tamal on 12/16/15.
 */
tinymce.init({ selector:'textarea' });

$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
            $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    // admin loader cms jquery

    var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    $("body").prepend(div_box);

    $('#load-screen').delay(700).fadeOut(600, function(){
        $(this).remove();
    });

});

function loadUserOnline(){
    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);
    });
}

setInterval(function(){
    loadUserOnline();
},500);


