<?php
$bu = config_item('app_start_url') ;
$ajax = $bu . "/register/";
?>
<script type='text/javascript'>
var base_url = "<?php echo config_item('app_start_url'); ?>"

function run_local() {
    $("#username").blur(function() {
        $(this).val($(this).val().toLowerCase())
    })

    $("#btn_logon").click(function() {
        var params = make_param_list(['username','password'])
        params['aktion'] = "LOGON"
        $.ajax({
            url: base_url + '/welcome/ajax',
            type: 'POST',
            data: params,
            success: function(data) {
                var o = JSON.parse(data)
                if (o.iam_id != '0') {
                    window.location.replace(o.callback)
                } else {
                    ShowAlert(o.message)
                }
            }
        }) // ajax 
    })
}
</script>

	<div id="container">
		<h1>
		    Unified Identity Manager
		</h1>

		<div id="body">
			<h3>Login please... <a href="<?php echo config_item('app_start_url') . '/register'; ?>">or create an account</a></h3>

			<p>User name:</p>
			<code><input type=text id=username size=40></code>

			<p>Password:</p>
			<code><input type=password id=password size=40></code>

            <p><input type=button value="Logon" id=btn_logon></p>
		</div>

		<p class="footer">Unified IAM tool by Ios Petrosky</p>
	</div>
</body>
</html>
