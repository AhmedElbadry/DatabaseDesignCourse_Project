/*global document, $*/
$(document).ready(function () {
    
    var studentFName = $('#student-fname'),
        studentLName = $('#student-lname'),
        studentEmail = $('#student-email'),
        studentPass = $('#student-pass'),
        studentPhone = $('#student-phone'),
        studentResult = $('#student-result'),
        teacherFName = $('#teacher-fname'),
        teacherLName = $('#teacher-lname'),
        teacherEmail = $('#teacher-email'),
        teacherPass = $('#teacher-pass'),
        teacherPhone = $('#teacher-phone'),
        teacherResult = $('#teacher-result');
    
    function isEmpty(input) {
        if (input.val() === "") {
            return true;
        } else {
            return false;
        }
    }
    
    function studentValidation(event) {
        if(isEmpty(studentFName)){
            event.preventDefault();
            studentResult.text('please enter your first name');
            return false;
        }
        if(isEmpty(studentLName)){
            event.preventDefault();
            studentResult.text('please enter your last name');
            return false;
        }
        if(isEmpty(studentEmail)){
            event.preventDefault();
            studentResult.text('please enter your email');
            return false;
        }
        if(isEmpty(studentPass)){
            event.preventDefault();
            studentResult.text('please enter your password');
            return false;
        }
        if(isEmpty(studentPhone)){
            event.preventDefault();
            studentResult.text('please enter your phone');
            return false;
        }
        
        return true;
    }
    
    function teacherValidation(event) {
        if(isEmpty(teacherFName)){
            event.preventDefault();
            teacherResult.text('please enter your first name');
            return false;
        }
        if(isEmpty(teacherLName)){
            event.preventDefault();
            teacherResult.text('please enter your last name');
            return false;
        }
        if(isEmpty(teacherEmail)){
            event.preventDefault();
            teacherResult.text('please enter your email');
            return false;
        }
        if(isEmpty(teacherPass)){
            event.preventDefault();
            teacherResult.text('please enter your password');
            return false;
        }
        if(isEmpty(teacherPhone)){
            event.preventDefault();
            teacherResult.text('please enter your phone');
            return false;
        }
        
        return true;
    }
    $('#student-signup-form').on('submit', studentValidation);
    $('#teacher-signup-form').on('submit', teacherValidation);
    
    $('#show-student-form').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('#teacher-signup-form').fadeOut(200);
        setTimeout(function () {
            $('#student-signup-form').fadeIn(200);
        }, 300);
    });

    $('#show-teacher-form').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('#student-signup-form').fadeOut(200);
        setTimeout(function () {
            $('#teacher-signup-form').fadeIn(200);
        }, 300);
    });
});