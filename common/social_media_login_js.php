<script type="text/javascript">
    // Load the Google JS file
    (function ()
    {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/client:plusone.js?onload=render'; // Append a onload trigger initialization function
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();


    //Facebook functions starts here
    (function (d)
    {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id))
        {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));

    function facebook()
    {

        FB.init({
            appId: '1032247773599377', // App ID
            channelUrl: '//' + window.location.hostname + '/channel', // Path to your Channel File
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true,  // parse XFBML
            version    : '{latest-api-version}'
        });

        FB.login(function (response)
        {
            if (response.authResponse)
            {
                FB.api('/me?fields=id,first_name,last_name,email,gender,picture', function (data)
                {
                    if (data)
                    {
                        userData(data);
                    }
                });
            }
        }, {scope: 'email'});
    }

    function userData(data)
    {
        $.ajax({
            url: "<?php echo $base_url; ?>login-submit.php",
            type: "POST",
            data: {
                registered_from: "facebook",
                data: data
            },
            dataType: 'json', // what type of data do we expect back from the server
            encode: true,
            beforeSend: function ()
            {
                $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
            },
            success: function (data)
            {
                $.unblockUI();
                if (data.status == 'success')
                {
                    if(data.new_user==1)
                    {
                     onclick_mobile_validate();
                    }
                    else
                    {
                        if (data.page != '')
                        {
                            window.location.href = '<?php echo $base_url;?>' + data.page;
                        }
                        else
                        {
                            //$('#response_msg').html(data.html_message);
                            $.notifyBar({ cssClass: "error", html: data.html_message});
                            $('#login_form').trigger("reset");
                        }
                    }
                }
                else
                {
                    //$('#response_msg').html(data.html_message);
                    $.notifyBar({ cssClass: "error", html: data.html_message});
                }
            }
        });
    }
</script>


<script type="text/javascript">
    // The initialization function
    function render()
    {
        //I am not using it but kept anyway

    }
    var i;
    // Function called from a onClick on a link or button (the 'sign in with g+' button)
    function gplus()
    {
        i = 0;
        var additionalParams = {
            'callback': signinCallback,
            'approvalprompt': 'force',

            // Here to write your App ID
            'clientid': '375937012898-f4qpuq56l94bilplj289p38rml5ukkef.apps.googleusercontent.com',
            'cookiepolicy': 'single_host_origin',
            'requestvisibleactions': 'http://schemas.google.com/AddActivity',
            'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
          
            /*'approvalprompt': 'force' finally removed*/
        };
        gapi.auth.signIn(additionalParams);
    }

    // The callback function
    function signinCallback(authResult)
    { //my callback function

        var email = '';
        var given_name = '';
        if (authResult['status']['signed_in'])
        {
            // Loading API
            gapi.client.load('oauth2', 'v2', function ()
            {
                gapi.client.oauth2.userinfo.get().execute(function (resp)
                {
                    console.log(resp);
                    if(resp["email"])
                    {
                        if (i < 2)
                        { //execute the doLogin just one time (my cheat)
                            $.ajax({
                                url: "<?php echo $base_url; ?>login-submit.php",
                                type: "POST",
                                data: {
                                    registered_from: "google_plus",
                                    data: resp
                                },
                                dataType: 'json', // what type of data do we expect back from the server
                                encode: true,
                                beforeSend: function ()
                                {
                                    $.blockUI({message: '<img id="loading-image" src="<?php echo $base_url_images;?>loading.gif" alt="Loading.."/>'});
                                },
                                success: function (data)
                                {
                                    $.unblockUI();
                                    if (data.status == 'success')
                                    {

                                        
                                        if(data.new_user==1)
                                        {
                                            onclick_mobile_validate();
                                        }
                                        else
                                        {
                                            
                                            if (data.page != '')
                                            {
                                                window.location.href = '<?php echo $base_url;?>' + data.page;
                                            }
                                            else
                                            {
                                                //$('#response_msg').html(data.html_message);
                                                $.notifyBar({ cssClass: "error", html: data.html_message});
                                                $('#login_form').trigger("reset");
                                            }
                                            
                                        }
                                    }
                                    else
                                    {
                                         $.notifyBar({ cssClass: "error", html: data.html_message});
                                        //$('#response_msg').html(data.html_message);
                                    }
                                }
                            });
                        }
                        i = 2;
                    }
                });
            });
        }
        else
        {
            // Update the app to reflect a signed out user
            // Possible error values:
            //"user_signed_out" - User is signed-out
            //"access_denied" - User denied access to your app
            //"immediate_failed" - Could not automatically log in the user
            
        }
    }
</script>