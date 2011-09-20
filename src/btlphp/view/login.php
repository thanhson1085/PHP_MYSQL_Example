
<div  id="login_container">
    <!--div  id="header">
   
		<div id="logo"><h1><a href="/">AdmintTheme</a></h1></div>
		
    </div><!-- end header -->
	   
	    <div id="login" class="section">
	    	<?php 
			if ($this->message()){?><div id="fail" class="info_div"><span class="ico_cancel">
				Username or Password incorrect.
			</span></div><?php } ?>
	    	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="blorg_form" id="loginform">
			
			<label><strong>Username</strong></label><input type="text" name="username" id="user_login"  size="28" class="input"/>
			<br />
			<label><strong>Password</strong></label><input type="password" name="password" id="user_pass"  size="28" class="input"/>
			<br />
			<strong>Remember Me</strong><input type="checkbox" id="remember" class="input noborder" /> 
			
			<br />
		
			<input id="save" class="loginbutton" name="save" type="submit" class="submit" value="Log In" />
				<input type="hidden" name="task" value="login" />
				<input type="hidden" name="session_token" value="<?php echo $this->create_session_token(); ?>" />
			</form>
			
			<a href="#" id="passwordrecoverylink">Forgot your username or password?</a>
	    </div>
	
	    
		    


</div><!-- end container -->

