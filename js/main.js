$(document).ready(function () {
    //All website script here


    $('form').validate({
        rules: {
            inputfirstname: {
                required: true
                
            },
			inputlasttname: {
                required: true
                
            },
            inputdob: {
                required: true,
                digits: true
                
            },
            inputemail: {
                required: true,
                email: true
            },
            inputtele: {
                required: true,
            }
        },
        highlight: function (element, errorClass) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element, errorClass) {
            $(element).closest('.form-group').removeClass('has-error');
        }
       
       
        //For next update, use ajax to submit form
        /*
        submitHandler: function (form) {
            //alert('I told you it was going to work!!')
            request = $.ajax({
                url: "contactengine.php",
                type: "post",
                data: serializedData
            });
        }*/
    });
   
    
   

});





// JavaScript Document