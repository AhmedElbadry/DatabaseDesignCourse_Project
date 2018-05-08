$(document).ready(function(){
    var open = true;
    $('#add-new-course-button').on('click', function(){
        if (open){
            $('#course-form').fadeIn();
        }
        open = false;
    });
});