<script type="text/javascript">
$('#homeloan_form').parsley();
$('#homeloan_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>loan-inquery-submit.php",
            type: "POST",
            data: $('#homeloan_form').serialize(),
            dataType: 'json',
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
                    
                    //$('#homeloan_form').trigger("reset");
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.notice({ title:"success",message: data.html_message });
                    $.notifyBar({cssClass: "success", html: data.html_message});
                    //$('#homeloan_form').parsley().destroy();
                    // setTimeout(function ()
                    // {
                    //     location.reload();
                    // }, 3000);
                }
                else
                {
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.error({ title:"Error",message: data.html_message });
                    $.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function ()
            {
                $.unblockUI();
                //$.growl.error({ title:"Error",message: "Error fetching data from server." });
                $.notifyBar({cssClass: "error", html: "Error fetching data from server."});
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});
$('#vehiclesloan_form').parsley();
$('#vehiclesloan_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>loan-inquery-submit.php",
            type: "POST",
            data: $('#vehiclesloan_form').serialize(),
            dataType: 'json',
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
                    
                    $('#vehiclesloan_form').trigger("reset");
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.notice({ title:"success",message: data.html_message });
                    $.notifyBar({cssClass: "success", html: data.html_message});
                    $('#vehiclesloan_form').parsley().destroy();
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 3000);
                }
                else
                {
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.error({ title:"Error",message: data.html_message });
                    $.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function ()
            {
                $.unblockUI();
                //$.growl.error({ title:"Error",message: "Error fetching data from server." });
                $.notifyBar({cssClass: "error", html: "Error fetching data from server."});
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});
$('#lifeloan_form').parsley();
$('#lifeloan_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>loan-inquery-submit.php",
            type: "POST",
            data: $('#lifeloan_form').serialize(),
            dataType: 'json',
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
                    
                    $('#lifeloan_form').trigger("reset");
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.notice({ title:"success",message: data.html_message });
                    $.notifyBar({cssClass: "success", html: data.html_message});
                    $('#lifeloan_form').parsley().destroy();
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 3000);
                }
                else
                {
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.error({ title:"Error",message: data.html_message });
                    $.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function ()
            {
                $.unblockUI();
                //$.growl.error({ title:"Error",message: "Error fetching data from server." });
                $.notifyBar({cssClass: "error", html: "Error fetching data from server."});
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});
$('#businessloan_form').parsley();
$('#businessloan_form').on('submit', function (e)
{
    e.preventDefault();
    var f = $(this);
    f.parsley().validate();
    if (f.parsley().isValid())
    {
        $.ajax({
            url: "<?php echo $base_url;?>loan-inquery-submit.php",
            type: "POST",
            data: $('#businessloan_form').serialize(),
            dataType: 'json',
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
                    
                    $('#businessloan_form').trigger("reset");
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.notice({ title:"success",message: data.html_message });
                    $.notifyBar({cssClass: "success", html: data.html_message});
                    $('#businessloan_form').parsley().destroy();
                    setTimeout(function ()
                    {
                        location.reload();
                    }, 3000);
                }
                else
                {
                    //$('#registration_form_response_msg').html(data.html_message);
                    //$.growl.error({ title:"Error",message: data.html_message });
                    $.notifyBar({cssClass: "error", html: data.html_message});
                }
            },
            error: function ()
            {
                $.unblockUI();
                //$.growl.error({ title:"Error",message: "Error fetching data from server." });
                $.notifyBar({cssClass: "error", html: "Error fetching data from server."});
            }
        });
    }
    else
    {
        e.preventDefault();
    }
});

</script>

