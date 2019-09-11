function login_validate() {
   $('#email').css('border','1px solid #d2d6de;');
   $('#password').css('border','1px solid #d2d6de;');
   var email = $('#email').val();
   var password = $('#password').val();
   
   if (email=="") {
	   $('#email').css('border','1px solid #ff0000');
	   return false;
   }
   
   if (password =="") {
	   $('#password').css('border','1px solid #ff0000');
	   return false;
   }
   
   return true;	
	
}


