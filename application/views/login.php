<!DOCTYPE html>
<html>
<head>
   <title>Login</title>
   <style>

   fieldset {
   	width: 300px;
   }

   </style>
   </head>

 <body>
	  <div id="wrapper">

<?php 
  if($this->session->flashdata("errors")) {
    echo $this->session->flashdata("errors");
  }
?>

		 <form action='NinjaGold/register' method='post'>
		  	<fieldset>
		  	<legend><h2> Register! </h2></legend>
			    	<p> First Name:<input type='text' name='first_name'> </p>
			    	<p> Last Name:<input type='text' name='last_name'></p>
			    	<p> Email:<input type='email' name='email'></p> 
			     	<p> Password:<input type='password' name='password'></p>
			     	<p> Confirm Password: <input type='password' name=confirm></p>
			 		<p> <input type='submit' id = 'blue' value='Register!'> </p>
			</fieldset>
		 </form>

		<form action='NinjaGold/login' method='post'>
		  	<fieldset>
		  	<legend><h2> Login! </h2></legend>
				    <p> Email:<input type='email2' name='email2'></p> 
				    <p> Password:<input type='password' name='password2'></p> 
				   	<p> <input type='submit' value='Login!'> </p>
			</fieldset>
		</form>
	</div>
</body>
</html>