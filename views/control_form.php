<?php
$bu = config_item('app_start_url') ;
$ajax = $bu . "/control/";
?>
<script type='text/javascript'>
var base_url = "<?php echo $bu; ?>"

function run_local() {
    $("#fullname").val("<?php echo $fullname; ?>")
    $("#email").val("<?php echo $email; ?>")

    $("#btn_logoff").click(function(){
        $.get(base_url + "/control/logoff/", function () {
            window.location.replace(base_url)
        })
        
    })

    $("#email").blur(function() {
        $(this).val($(this).val().toLowerCase())
        var params = make_param_list(['email'])
        params['aktion'] = 'UPDATE_EMAIL'
        $.ajax({
            url: base_url + '/control/ajax',
            type: 'POST',
            data: params,
            success: function(data) {
                $("#email_status").html(data)
                setTimeout(() => {
                    $("#email_status").html('')
                }, 3000);
            }
        }) // ajax 
    })

    $("#fullname").blur(function() {
        var params = make_param_list(['fullname'])
        params['aktion'] = 'UPDATE_NAME'
        $.ajax({
            url: base_url + '/control/ajax',
            type: 'POST',
            data: params,
            success: function(data) {
                $("#fullname_status").html(data)
                setTimeout(() => {
                    $("#fullname_status").html('')
                }, 3000);
            }
        }) // ajax 
    })

    $("#password").blur(function() {
        if ($("#password").val() == '') return;
        var params = make_param_list(['password'])
        params['aktion'] = 'UPDATE_PASS'
        $.ajax({
            url: base_url + '/control/ajax',
            type: 'POST',
            data: params,
            success: function(data) {
                $("#password_status").html(data)
                setTimeout(() => {
                    $("#password_status").html('')
                }, 3000);
            }
        }) // ajax 
    })
} // run_local    
    
</script>

	<div id="container">
		<h1>
		    Identity Manager Control Pane
		</h1>
    
		<div id="body">
			<h3>Apps available:</h3>
            <ul>
                <li><a href="<?php echo config_item('base_url') . "/dnd.php"; ?>">DND Maps</a></li>
            </ul>
			<h3>Your data: <?php echo $username; ?></h3>
            <P>To update a value (including the password) type the new value. It will be saved automatically when you 
            deselect the input box</p>
			<code>Full name:_<input type=text id=fullname size=40><span id=fullname_status></span></code>
			<code>Email:_____<input type=text id=email size=40> <span id=email_status></span></code>
			<code>Password:__<input type=password id=password size=40><span id=password_status></span></code>

            <input type=button value=Logoff id=btn_logoff>
		</div>



		<p class="footer">Unified IAM tool by Ios Petrosky</p>
	</div>
</body>    