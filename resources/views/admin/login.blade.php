
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
        <base href="{{asset('')}}" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>BookStore - Administration</title>
    <link rel="stylesheet" type="text/css" href="joomla/css/template.css"/>
    <link rel="stylesheet" type="text/css" href="joomla/css/system.css"/>
      <script src="Joomla/js/jquery-3.3.1.min.js"></script>
         <script src="Joomla/js/submit.js">
        
                 
        
        </script>

</head>
<body>
	<div id="border-top" class="h_blue">
		<span class="title"><a href="index.php">Administration</a></span>
	</div>

	<div id="content-box">
		<div id="element-box" class="login">
			<div class="m wbg">
				<h1>Administration Đăng Nhập</h1>
                <!-- ERROR -->
				<div id="system-message-container">
                    <dl id="system-message">
                        <dt class="error">Error</dt>
                        <dd class="error message">
                            <ul>
                                <li>Tài khoản hoặc mật khẩu không đúng</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
				
                <div id="section-box">
					<div class="m">
						<form action="check" method="post" id="form-login">
                            {!! Form::open(['url'=>'check','method'=>'post','id'=>'form-login'])!!}
							<fieldset class="loginform">
                                <label>Tài Khoản</label>
                                <input name="username" id="mod-login-username" type="text" class="inputbox" size="15" />
                                <label id="mod-login-password-lbl" for="mod-login-password">Mật khẩu</label>
                                 <input name="passwordd" id="mod-login-password" type="password" class="inputbox" size="15" />
                                <div class="button-holder">
                                    <div class="button1">
                                        <div class="next">
                                            <a id="check" >Đăng nhập</a>
                                        </div>
                                    </div>
                                </div>
								<div class="clr"></div>
                            </fieldset>
						</form>
						<div class="clr"></div>
					</div>
				</div>
		
            	<p>Sử dụng tài khoàn và mật khẩu để đăng nhập website</p>
            	<p><a href="http://localhost/joomla/">Go to site home page.</a></p>
				<div id="lock"></div>
			</div>
		</div>
	</div>
	<div id="footer">
		<p class="copyright">
			<a href="http://www.joomla.org">Joomla!&#174;</a> is free software released under the <a href="http://www.gnu.org/licenses/gpl-2.0.html">GNU General Public License</a>.	
		</p>
	</div>
  
    
</body>
</html>
