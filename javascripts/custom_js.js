 
$(document).ready(function() {
  if(login){
       $('.btn-login').trigger('click');  
    } 
  if(registration_success){
      $('.btn-registration_success').trigger('click');
      //setTimeout(function(){//nothing},10000);  
      //window.location= "index.php";
  }   
  if(error_flag){
       $('#error_box_message').html(error_msg);  
      $('.btn-error_box').trigger('click');

    } 
}); 

$('#login_btn').live("click", function(){
    $('#error_div_1').hide();
    $("input[name=username]").removeClass('red_border');
    $('input[name=password]').removeClass('red_border'); 
    $('.btn-login').trigger('click'); 
});

$('#register_btn').live("click", function(){
    $('#error_div_2').hide();
    $("input[name=username]").removeClass('red_border');
    $('input[name=password]').removeClass('red_border'); 
    $('input[name=firstname]').removeClass('red_border'); 
    $('input[name=lastname]').removeClass('red_border'); 
    $('input[name=email]').removeClass('red_border'); 
    $('#login_close').trigger('click');
    $('.btn-register').trigger('click'); 
}); 
     $('#course_payment').live({
        submit: function() {
            var full_name = jQuery.trim($('input[name=full_name]').val());
            var email_id = jQuery.trim($('input[name=email_id]').val());
            var city = jQuery.trim($('input[name=city]').val());
            var pincode = jQuery.trim($('input[name=pincode]').val());
            var contact_no = jQuery.trim($('input[name=contact_no]').val());
            var state = jQuery.trim($('input[name=state]').val());
            var address = jQuery.trim($('input[name=address]').val()); 
            var atpos = email_id.indexOf("@");
            var dotpos = email_id.lastIndexOf(".");
            var characterReg =(/\d{10}/i);
            var valid = true;
            $("input[name=state]").removeClass('red_border');
            $('input[name=full_name]').removeClass('red_border');
            $('input[name=email_id]').removeClass('red_border');
            $('input[name=city]').removeClass('red_border');
            $('input[name=contact_no]').removeClass('red_border');
            $('input[name=address]').removeClass('red_border');
            $('input[name=pincode]').removeClass('red_border');

            var englishName = /^[A-Za-z ]*$/;
            var NumberOnly = /^[0-9]*$/;


            if(full_name=='' ||  !englishName.test(full_name) ){
                $('input[name=full_name]').focus();
                $('input[name=full_name]').addClass('red_border');
                valid = false;
            }            

            if (email_id == '' || (atpos<1) || (dotpos<atpos+2) || (dotpos+2>=email_id.length)){
                $('input[name=email_id]').focus();
                $('input[name=email_id]').addClass('red_border');
                valid = false;
            }

            if(state==''){
                $('input[name=state]').focus();
                $('input[name=state]').addClass('red_border');                	
                valid = false;
            }
            if(city==''){
                $('input[name=city]').focus();
                $('input[name=city]').addClass('red_border');
                valid = false;
            }

            if(pincode=='' || !NumberOnly.test(pincode)){
                $('input[name=pincode]').focus();
                $('input[name=pincode]').addClass('red_border');
                valid = false;
            }
            
            if(contact_no=='' || !NumberOnly.test(contact_no) || contact_no.length!=10){
                $('input[name=contact_no]').focus();
                $('input[name=contact_no]').addClass('red_border');
                valid = false;
            }

            if(address==''){
                $('input[name=address]').focus();
                $('input[name=address]').addClass('red_border');
                valid = false;
            }    

            if(!valid){
                $('#error_div').show();
                return false;                
            }

        }

    });


  $('#contact_form').live({
        submit: function() {
            var full_name = jQuery.trim($('input[name=name]').val());
            var email_id = jQuery.trim($('input[name=email]').val());
            var message = jQuery.trim($('textarea[name=message]').val()); 
            var atpos = email_id.indexOf("@");
            var dotpos = email_id.lastIndexOf(".");
            var characterReg =(/\d{10}/i);
            var valid = true;
            $("input[name=name]").removeClass('red_border');
            $('input[name=email]').removeClass('red_border');
            $('textarea[name=message]').removeClass('red_border'); 

            var englishName = /^[A-Za-z ]*$/;
            var NumberOnly = /^[0-9]*$/;


            if(full_name=='' ||  !englishName.test(full_name) ){
                $('input[name=name]').focus();
                $('input[name=name]').addClass('red_border');
                valid = false;
            }            

            if (email_id == '' || (atpos<1) || (dotpos<atpos+2) || (dotpos+2>=email_id.length)){
                $('input[name=email]').focus();
                $('input[name=email]').addClass('red_border');
                valid = false;
            }

            if(message==''){
                $('textarea[name=message]').focus();
                $('textarea[name=message]').addClass('red_border');
                valid = false;
            }    

            if(!valid){
                $('#error_div').show();
                return false;                
            }

        }

    });


  $('#login_form').live({
        submit: function() {
            var username = jQuery.trim($('input[name=username]').val());
            var password = jQuery.trim($('input[name=password]').val()); 
            var valid = true;
            $("input[name=username]").removeClass('red_border');
            $('input[name=password]').removeClass('red_border'); 

            var englishName = /^[A-Za-z0-9]*$/;
            var NumberOnly = /^[0-9]*$/;


            if(username=='' ||  !englishName.test(username) ){
                $('input[name=username]').focus();
                $('input[name=username]').addClass('red_border');
                valid = false;
            }            
            if(password=='' || !englishName.test(password) ){
                $('input[name=password]').focus();
                $('input[name=password]').addClass('red_border');
                valid = false;
            }  
            
            if(!valid){
                $('#error_div_1').show();
                return false;                
            }

        }

    });

function validateCode(text){
    if( /[^a-zA-Z0-9]/.test( text ) ) { 
       return false;
    }
    return true;     
 }

 $('#register_form').live({
        submit: function() {
            var username = jQuery.trim($('#register_form').find('input[name=username]').val());
            var firstname = jQuery.trim($('input[name=firstname]').val());
            var lastname = jQuery.trim($('input[name=lastname]').val());
            var password = $('#register_form').find('input[name=password]').val(); 
            var email_id = jQuery.trim($('input[name=email]').val());
            var valid = true;
            $('#register_form').find('input[name=username]').removeClass('red_border');
            $('#register_form').find('input[name=password]').removeClass('red_border'); 
            $('input[name=firstname]').removeClass('red_border'); 
            $('input[name=lastname]').removeClass('red_border'); 
            $('input[name=email]').removeClass('red_border'); 

            var englishName = /^[A-Za-z0-9]*$/;
            var englishName1 = /^[A-Za-z ]*$/;
            var NumberOnly = /^[0-9]*$/;
            var atpos = email_id.indexOf("@");
            var dotpos = email_id.lastIndexOf(".");
            var characterReg =(/\d{10}/i);


            if(username=='' || username.length <6 || !validateCode(username) ){
               $('#register_form').find('input[name=username]').focus();
               $('#register_form').find('input[name=username]').addClass('red_border');
                valid = false;
            }            
            if(password=='' || password.length <6 || !validateCode(password)){
               $('#register_form').find('input[name=password]').focus();
               $('#register_form').find('input[name=password]').addClass('red_border');
                valid = false;
            }  

             if(firstname=='' || !englishName1.test(firstname) ){
                $('input[name=firstname]').focus();
                $('input[name=firstname]').addClass('red_border');
                valid = false;
            } 
             if(lastname=='' || !englishName1.test(lastname) ){
                $('input[name=lastname]').focus();
                $('input[name=lastname]').addClass('red_border');
                valid = false;
            } 
            if (email_id == '' || (atpos<1) || (dotpos<atpos+2) || (dotpos+2>=email_id.length)){
                $('input[name=email]').focus();
                $('input[name=email]').addClass('red_border');
                valid = false;
            }
            
            if(!valid){
                $('#error_div_2').show();
                return false;                
            }

        }

    });

 