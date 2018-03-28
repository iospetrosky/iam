<?php
$bu = config_item('app_start_url') ;
$ajax = $bu . "/register/";
?>

<script type='text/javascript'>
var base_url = "<?php echo config_item('app_start_url'); ?>"

function run_local() {
    $("#btn_create").click(function () {
        var params = make_param_list(['username','fullname', 'email','password'])
        params['aktion'] = 'MAKE_NEW_USER'
        $.ajax({
            url: base_url + '/register/ajax',
            type: 'POST',
            data: params,
            success: function(data) {
                if (data != '0') {
                    ShowAlert("Identity created. You can now log into the system","Message","",base_url)
                } else {
                    ShowAlert("There was an error during the creation of your identity","Error")
                }
            }
        }) // ajax 
   
    })
    
    $("#email").blur(function() {
        $(this).val($(this).val().toLowerCase())
        var params = make_param_list(['email'])
        params['aktion'] = 'TEST_EMAIL'
        $.ajax({
            url: base_url + '/register/ajax',
            type: 'POST',
            data: params,
            success: function(data) {
                $("#email_status").html(data)
            }
        }) // ajax 
    })

    $("#username").blur(function() {
        $(this).val($(this).val().toLowerCase())
        var params = make_param_list(['username'])
        params['aktion'] = 'TEST_USER'
        $.ajax({
            url: base_url + '/register/ajax',
            type: 'POST',
            data: params,
            success: function(data) {
                $("#user_status").html(data)
            }
        }) // ajax 
    })
} // run_local    
    
</script>


	<div id="container">
		<h1>
		    Create a user ID
		</h1>
    
		<div id="body">
			<h3>Insert all the required data and submit the form</h3>

			<p>Desired user ID:</p>
			<code><input type=text id=username size=40> <span id=user_status>case insensitive</span></code>

			<p>Full name:</p>
			<code><input type=text id=fullname size=40></code>

			<p>Email:</p>
			<code><input type=text id=email size=40> <span id=email_status>case insensitive</span></code>

			<p>Password:</p>
			<code><input type=password id=password size=40> CASE SENSITIVE</code>
			
            <p>
            <input type="button" value="Create account" id="btn_create" >
            </p>
		</div>

		<p class="footer">Unified IAM tool by Ios Petrosky</p>
	</div>
</body>
    