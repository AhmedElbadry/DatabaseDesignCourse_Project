/*global $, document*/
"use strict";
$(document).ready(function () {
    
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
        emailInput = $('#email'),
        passInput = $('#pass'),
        validationResult = "",
        resultElement = $('.form-result'),
        emailValidation = true,
        passwordValidation = true;
    
    function loginValidation(event) {
        emailValidation = true;
        passwordValidation = true;
        
        emailValidation = emailReg.test(emailInput.val());
        if (emailInput.val() === "") {
            emailValidation = false;
        }
        if (passInput.val() === "" || passInput.val().length > 15) {
            passwordValidation = false;
        }
        
        if (emailValidation === false) {
            validationResult = "Incorrect Email";
            resultElement.text(validationResult);
            event.preventDefault();
        } else if (passwordValidation === false) {
            validationResult = "Incorrect Password";
            resultElement.text(validationResult);
            event.preventDefault();
        } else {
            validationResult = " ";
            resultElement.text(validationResult);
            return true;
        }
    }
    
    $('#login-form').on("submit", loginValidation);
});