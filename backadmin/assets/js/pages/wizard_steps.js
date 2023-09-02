/* ------------------------------------------------------------------------------
 *
 *  # Steps wizard
 *
 *  Specific JS code additions for wizard_steps.html page
 *
 *  Version: 1.1
 *  Latest update: Dec 25, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function ()
{


    // Wizard examples
    // ------------------------------

    // Basic wizard setup
    $(".steps-basic").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        labels: {
            finish: 'Submit'
        },
        onFinished: function (event, currentIndex)
        {
            alert("Form submitted.");
        }
    });


    // Async content loading
    $(".steps-async").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        labels: {
            finish: 'Submit'
        },
        onContentLoaded: function (event, currentIndex)
        {
            $(this).find('select.select').select2();

            $(this).find('select.select-simple').select2({
                minimumResultsForSearch: Infinity
            });

            $(this).find('.styled').uniform({
                radioClass: 'choice'
            });

            $(this).find('.file-styled').uniform({
                wrapperClass: 'bg-warning',
                fileButtonHtml: '<i class="icon-googleplus5"></i>'
            });
        },
        onFinished: function (event, currentIndex)
        {
            alert("Form submitted.");
        }
    });


    // Saving wizard state
    $(".steps-state-saving").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        saveState: true,
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        onFinished: function (event, currentIndex)
        {
            alert("Form submitted.");
        }
    });


    // Specify custom starting step
    $(".steps-starting-step").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        startIndex: 2,
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        onFinished: function (event, currentIndex)
        {
            alert("Form submitted.");
        }
    });


    //
    // Wizard with validation
    //

    // Show form
    var form = $(".steps-validation").show();


    // Initialize wizard
    $(".steps-validation").steps({
        // enableAllSteps: true,
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        onStepChanging: function (event, currentIndex, newIndex)
        {

            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }

            // Forbid next action on "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age-2").val()) < 18)
            {
                return false;
            }

            // Needed in some cases if the user went back (clean up)

            if (currentIndex == 1)
            {

                var total_variant = $('#total_variant').val();

                if (total_variant == 1 || total_variant == 2)
                {
                    var listing_type = $('#listing_type').val();
                    var selected_variant_list = [];
                    var total_added_variant;
                    var total_selected_variant;
                    total_added_variant = $('#variant_table tbody tr').length;

                    if (listing_type == 'add')
                    {
                        // In add listing check number of selected values are equal to number of rows in bottom table

                        // First check variant 1 or 2 select dropdown is blank
                        if (total_variant == 1)
                        {
                            selected_variant_list = $('#variant_1_data_total_1').val();
                            if (selected_variant_list == null)
                            {
                                $.notifyBar({cssClass: "error", html: "Please select variant!"});
                                return false;
                            }
                        }
                        else if (total_variant == 2)
                        {
                            selected_variant_list = $('#variant_2_data').val();

                            if (selected_variant_list == null)
                            {
                                $.notifyBar({cssClass: "error", html: "Please select variant!"});
                                return false;
                            }
                        }

                        if (selected_variant_list)
                        {
                            total_selected_variant = selected_variant_list.length;
                            // total_added_variant = $('#variant_table tbody tr').length;

                            if (total_added_variant != total_selected_variant)
                            {
                                // $.notifyBar({cssClass: "error", html: "Please Enter atleast one variant..!"});
                                $.notifyBar({cssClass: "error", html: "Please Enter all selected variant details!"});
                                return false;
                            }
                        }
                    }
                    else if (listing_type == 'edit')
                    {
                        // In edit listing check if all selected values are present in the bottom table

                        if (total_variant == 1)
                        {
                            selected_variant_list = $('#variant_1_data_total_1').val();
                        }
                        else if (total_variant == 2)
                        {
                            selected_variant_list = $('#variant_2_data').val();
                        }

                        if (selected_variant_list)
                        {
                            var added_variant_list = [];
                            $('#variant_table tr').each(function ()
                            {
                                added_variant_list.push($(this).find("#variant_two").text());
                            });

                            if (!added_variant_list.containsArray(selected_variant_list))
                            {
                                $.notifyBar({cssClass: "error", html: "Please Enter all selected variant details!"});
                                return false;
                            }
                        }
                    }

                    var sku_id_array = [];
                    for (var i = 0; i < total_added_variant; i++)
                    {
                        var id = '#product_' + i + '_sku_id';
                        sku_id_array.push($(id).val());
                    }
                    var results = [];
                    for (var j = 0; j < sku_id_array.length - 1; j++)
                    {
                        if (sku_id_array[j + 1] == sku_id_array[j])
                        {
                            results.push(sku_id_array[j]);
                        }
                    }
                    var duplicate_sku_array = results.filter(function (x, i, a) {
                        return a.indexOf(x) == i;
                    });

                    if (duplicate_sku_array.length > 0)
                    {
                        var duplicate_sku_list = duplicate_sku_array.join();
                        if(duplicate_sku_list)
                        {
                            var error_message = 'Duplicate sku id ' + duplicate_sku_list + ' !';
                            $.notifyBar({cssClass: "error", html: error_message});
                            return false;
                        }
                    }
                }
            }
            else if (currentIndex == 2)
            {
                var main_image = $("#file_name1").val();
                if (main_image == '')
                {
                    $.notifyBar({cssClass: "error", html: "Please Add Product Main Image..!"});
                    return false;
                }
            }


            if (currentIndex < newIndex)
            {

                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }

            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },

        onStepChanged: function (event, currentIndex, priorIndex)
        {

            // Used to skip the "Warning" step if the user is old enough.
            if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
            {
                form.steps("next");
            }

            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            // if (currentIndex === 2 && priorIndex === 3)
            // {
            //     form.steps("previous");
            // }
        },

        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },

        onFinished: function (event, currentIndex)
        {
            var path = $('#path').val();
            var listing_type = document.getElementById("listing_type").value;
            if (listing_type == 'add')
            {
                submit_url = path + "add-listings-submit.php";
            }
            else if (listing_type == 'edit')
            {
                submit_url = path + "edit-listings-submit.php";
            }

            $.ajax({
                url: submit_url,
                type: "POST",
                data: $('#add_listings_form').serialize(), // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                success: function (data)
                {
                    if (data.status == 'success')
                    {
                        var success_message = '';
                        if (listing_type == 'add')
                        {
                            $('#add_listings_form').trigger("reset");
                            success_message = 'added';
                        }
                        else
                        {
                            success_message = 'updated';
                        }
                        $.blockUI({message: '<img src="' + path + 'assets/images/loading.gif" /><br><h6>Listing ' + success_message + ' successfully. Please wait we are redirecting you to my listing.</h6>'});
                        redirectURL = path + "view-top-product/0";
                        setTimeout("location.href = redirectURL", 1000);
                    }
                    else
                    {
                        $.notifyBar({cssClass: "error", html: data.html_message});
                    }
                }
            });
        }
    });


    // Initialize validation
    $(".steps-validation").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass)
        {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass)
        {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function (error, element)
        {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container'))
            {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline'))
                {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else
                {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio'))
            {
                error.appendTo(element.parent().parent().parent());
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible'))
            {
                error.appendTo(element.parent());
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline'))
            {
                error.appendTo(element.parent().parent());
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group'))
            {
                error.appendTo(element.parent().parent());
            }

            else
            {
                error.insertAfter(element);
            }
        },
        rules: {
            email: {
                email: true
            }
        }
    });


    // Initialize plugins
    // ------------------------------

    // Select2 selects
    $('.select').select2();


    // Simple select without search
    $('.select-simple').select2({
        minimumResultsForSearch: Infinity
    });


    // Styled checkboxes and radios
    $('.styled').uniform({
        radioClass: 'choice'
    });


    // Styled file input
    $('.file-styled').uniform({
        wrapperClass: 'bg-warning',
        fileButtonHtml: '<i class="icon-googleplus5"></i>'
    });

});

Array.prototype.containsArray = function (array /*, index, last*/)
{

    if (arguments[1])
    {
        var index = arguments[1], last = arguments[2];
    }
    else
    {
        var index = 0, last = 0;
        this.sort();
        array.sort();
    }

    return index == array.length
        || ( last = this.indexOf(array[index], last) ) > -1
        && this.containsArray(array, ++index, ++last);

};
