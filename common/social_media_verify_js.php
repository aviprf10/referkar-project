<script>
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

    (function ()
    {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = false;
        po.src = 'https://apis.google.com/js/client:plusone.js?onload=render';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();

    function verify_facebook()
    {
        FB.init({
            appId: '1070798672968179', // App ID
            channelUrl: '//' + window.location.hostname + '/channel', // Path to your Channel File
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true  // parse XFBML
        });

        FB.login(function (response)
        {
            if (response.authResponse)
            {
                FB.api('/me', function (data)
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
        first_name = data.first_name;
        last_name = data.last_name;
        email = data.email;
        user_id = data.id;
        reg_from = "facebook";
        $.ajax({
            type: "POST",
            url: "<?php echo $base_url; ?>verify-facebook.php",
            data: {first_name: first_name, last_name: last_name, email: email, id: user_id, reg_from: reg_from},
            success: function (data)
            {
                if (data.status == 'success')
                {
                    $('#facebook_verify_block').css("background-color", "#4285f4");
                    $('#facebook_verify_div').css("background-color", "#4285f4");
                    $('#facebook_verify_list').attr('data-original-title', 'Facebook Verified');
                    $('#facebook_verify_list1').attr('data-original-title', 'Facebook Verified');
                }
                else
                    $('#log_res').html(data).addClass("alert alert-danger");

            }
        });
    }

    function connectG(token)
    {
        gapi.client.plus.people.get({userId: 'me'}).execute(function (result)
        {

            //console.log(result);
            // Filter the emails object to find the user's primary account, which might
            // not always be the first in the array. The filter() method supports IE9+.
            email = result['emails'].filter(function (v)
            {
                return v.type === 'account'; // Filter out the primary email
            })[0].value; // get the email from the filtered results, should always be defined.

            image_url = result.image.url; // get the image url


            if ($.trim(email) !== "")
            {
                displayName = result.displayName;
                id = result.id;
                gender = result.gender;

                $.ajax({
                    type: "POST",
                    url: "<?php echo $base_url; ?>verify-google.php",
                    data: {g_display_name: displayName, g_email: email, reg_from_id: id, reg_from: "google_plus", gender: gender, token: token, image_url: image_url},
                    success: function (data)
                    {
                        if (data.status == 'success')
                        {
                            $('#google_verify_block').css("background-color", "#4285f4");
                            $('#google_verify_div').css("background-color", "#4285f4");
                            $('#google_verify_list').attr('data-original-title', 'Google Verified');
                            $('#google_verify_list1').attr('data-original-title', 'Google Verified');
                        }
                        else
                        {
                            $('#log_res').html(data).addClass("alert alert-danger");
                        }
                    }
                });
            }
        });
    }

    function signinCallback(authResult)
    {
        if (authResult['status']['signed_in'])
        {
            // Update the app to reflect a signed in user
            // Hide the sign-in button now that the user is authorized, for example:
            gapi.client.load('plus', 'v1', function ()
            {
                connectG();
            });
            // gapi.auth.signOut();
        }
        else
        {
            // Update the app to reflect a signed out user
            // Possible error values:
            //   "user_signed_out" - User is signed-out
            //   "access_denied" - User denied access to your app
            //   "immediate_failed" - Could not automatically log in the user

        }
    }

    function gplus()
    {
        var additionalParams = {
            'callback': signinCallback
        };

        gapi.auth.signIn(additionalParams); // Will use page level configuration
    }

</script>