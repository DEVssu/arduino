
<!DOCTYPE html>
<meta charset="utf-8" />
<title>로그인</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$("#login").click(function() {
		login();
	});
	
	// enter event
	$('input').keyup(function(e) {
		if (e.keyCode == 13) {
			//alert("you pressed enter key");
			login();
		}
	});

	function login() {
		$('form').attr({action:'./login_ok.php', method:'post'}).submit();
	}
});

</script>
<body leftmargin="0" topmargin="56" marginwidth="0" marginheight="0" scroll="no" onload="load()">
	<form id="form1" name="form1" action="./common/login_ok.php" method="post">
		<input type="hidden" name="forwardPage" value="./loginok.jsp">
		<input type="hidden" name="actionName" value="loginAction">
		<input type="hidden" name="cmd" value="login">
		<input type="hidden" name="titLogId" value="smartdo">
 		<table width="644" border="0" align="center" cellpadding="1" cellspacing="1">
			<tr><td height="200"></td></tr>
			<tr>
				<td colspan="3" style="padding-left: 5px;" align="center">
				<img  height="200" alt="Logo" src="UPCNS.JPG"></td>
			</tr>
			<tr>
				<td width="100">&nbsp;</td>
				<td valign="top">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" >
						<tr>
							<td nowrap class="log_title_kr" align="right" >
								<font color="#727272">ID &nbsp;</font></td>
							<td><input name="USER_ID" id="USER_ID" type="text" size="27"
								class="Input" maxlength="20" value="you" 
								onkeyup='fncSaveCookie();'
								onfocus="this.select()" onkeypress="if(event.keyCode==13) {javascript:frm_login.PASSWORD.focus();;}">
							</td>
							<td valign="top" align="center">
							<select name="USER_LANG"
								id="USER_LANG" class="select" id="select"
								style="width: 97px;" onchange="getDomain()">
									<option value="KO">Korean</option>
									<option value="EN">English</option>
							</select>
							</td>
						</tr>
						<tr>
							<td nowrap class="log_title_kr" align="right">
								<font color="#727272">비밀번호 &nbsp;</font></td>
							<td><input name="PASSWORD" id="PASSWORD" type="password" size="27"
								class="Input" maxlength="20" value="you"
								onfocus="this.select()" onkeyup='fncSaveCookie();' onkeypress="if(event.keyCode==13) {javascript:login();}">
							</td>
							<td rowspan="2" align="center">
							<a href="#"
								onclick="javascript:login()"><img
									src="login.png" width="97" height="43" id='login' type='button'
									border="0" alt="Login">
							</a>
							</td>
						</tr>
						<tr>
							<td nowrap class="log_title_kr" align="right">
								<font color="#727272">비밀번호변경 &nbsp;</font></td>
							<td><input name="NEW_PASSWORD" type="password" size="27"
								class="Input" maxlength="20" value="" onfocus="this.select()" onkeyup="fncSaveCookie()" onkeypress="if(event.keyCode==13) {javascript:login();}">
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td valign="top" align="left" class="log_sub_kr">
							<input name="user_chk" id="user_chk" type="checkbox" onclick="fncSaveCookie()" onkeypress="if(event.keyCode==13) {javascript:login();}"> 아이디/비번 저장
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</td>
				<td width="100">&nbsp;</td>
			</tr>
		</table>
	</form>
</body>
</html>


