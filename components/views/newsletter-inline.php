<?php
/**
 * User: DatornData jb@datorndata.com
 * Date: 7/25/13
 * Time: 11:28 AM
 *
 * $this NewsletterSignup
 */
?>
<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup" style="text-align: right;margin-top:1em;">
    <form action="//hnn.us1.list-manage.com/subscribe/post?u=191ccdd6c73c5afeafd52cfb8&amp;id=4b27cc9cc2"
          class="validate form-inline" id="mc-embedded-subscribe-form" method="post" name="mc-embedded-subscribe-form"
          target="_blank">

        <div class="mc-field-group" style="clear: both;">
            <input class="required email span2" id="mce-EMAIL" name="EMAIL" type="text" value="" placeholder="Join our mailing list"><input class="btn sm-margin" id="mc-embedded-subscribe" name="subscribe" style="margin-left: 1em" type="submit" value="Subscribe">
        </div>
        <div id="mce-responses" style="float: left; top: -1.4em; clear: both;">
            <div class="response" id="mce-error-response" style="display: none;">&nbsp;</div>
            <div class="response" id="mce-success-response" style="display: none;">&nbsp;</div>
        </div>

        <a class="mc_embed_close" href="#" id="mc_embed_close" style="display: none;">Close</a>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        var fnames = new Array();
        var ftypes = new Array();
        fnames[0] = 'EMAIL';
        ftypes[0] = 'email';
        try {
            var jqueryLoaded = jQuery;
            jqueryLoaded = true;
        } catch (err) {
            var jqueryLoaded = false;
        }
        var head = document.getElementsByTagName('head')[0];
        if (!jqueryLoaded) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
            head.appendChild(script);
            if (script.readyState && script.onload !== null) {
                script.onreadystatechange = function () {
                    if (this.readyState == 'complete') mce_preload_check();
                }
            }
        }
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = '//downloads.mailchimp.com/js/jquery.form-n-validate.js';
        head.appendChild(script);
        var err_style = '';
        try {
            err_style = mc_custom_error_style;
        } catch (e) {
            err_style = 'background: FFEEEE none repeat scroll 0% 0%; float: left; z-index: 1; width: 80%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; color: #FF0000;';
        }
        var head = document.getElementsByTagName('head')[0];
        var style = document.createElement('style');
        style.type = 'text/css';
        if (style.styleSheet) {
            style.styleSheet.cssText = '.mce_inline_error {' + err_style + '}';
        } else {
            style.appendChild(document.createTextNode('.mce_inline_error {' + err_style + '}'));
        }
        head.appendChild(style);
        setTimeout('mce_preload_check();', 250);

        var mce_preload_checks = 0;
        function mce_preload_check() {
            if (mce_preload_checks > 40) return;
            mce_preload_checks++;
            try {
                var jqueryLoaded = jQuery;
            } catch (err) {
                setTimeout('mce_preload_check();', 250);
                return;
            }
            try {
                var validatorLoaded = jQuery("#fake-form").validate({});
            } catch (err) {
                setTimeout('mce_preload_check();', 250);
                return;
            }
            mce_init_form();
        }
        function mce_init_form() {
            jQuery(document).ready(function ($) {
                var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function () {
                }, onfocusout: function () {
                }, onblur: function () {
                }  };
                var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
                $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
                options = { url: 'http://hnn.us1.list-manage.com/subscribe/post-json?u=191ccdd6c73c5afeafd52cfb8&id=4b27cc9cc2&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                    beforeSubmit: function () {
                        $('#mce_tmp_error_msg').remove();
                        $('.datefield', '#mc_embed_signup').each(
                            function () {
                                var txt = 'filled';
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function () {
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function () {
                                        if (fields.length == 2) fields[2] = {'value': 1970};//trick birthdays into having years
                                        if (fields[0].value == 'MM' && fields[1].value == 'DD' && fields[2].value == 'YYYY') {
                                            this.value = '';
                                        } else if (fields[0].value == '' && fields[1].value == '' && fields[2].value == '') {
                                            this.value = '';
                                        } else {
                                            this.value = fields[0].value + '/' + fields[1].value + '/' + fields[2].value;
                                        }
                                    });
                            });
                        return mce_validator.form();
                    },
                    success: mce_success_cb
                };
                $('#mc-embedded-subscribe-form').ajaxForm(options);

            });
        }
        function mce_success_cb(resp) {
            $('#mce-success-response').hide();
            $('#mce-error-response').hide();
            if (resp.result == "success") {
                $('#mce-' + resp.result + '-response').show();
                $('#mce-' + resp.result + '-response').html(resp.msg);
                $('#mc-embedded-subscribe-form').each(function () {
                    this.reset();
                });
            } else {
                var index = -1;
                var msg;
                try {
                    var parts = resp.msg.split(' - ', 2);
                    if (parts[1] == undefined) {
                        msg = resp.msg;
                    } else {
                        i = parseInt(parts[0]);
                        if (i.toString() == parts[0]) {
                            index = parts[0];
                            msg = parts[1];
                        } else {
                            index = -1;
                            msg = resp.msg;
                        }
                    }
                } catch (e) {
                    index = -1;
                    msg = resp.msg;
                }
                try {
                    if (index == -1) {
                        $('#mce-' + resp.result + '-response').show();
                        $('#mce-' + resp.result + '-response').html(msg);
                    } else {
                        err_id = 'mce_tmp_error_msg';
                        html = '<div id="' + err_id + '" style="' + err_style + '"> ' + msg + '</div>';

                        var input_id = '#mc_embed_signup';
                        var f = $(input_id);
                        if (ftypes[index] == 'address') {
                            input_id = '#mce-' + fnames[index] + '-addr1';
                            f = $(input_id).parent().parent().get(0);
                        } else if (ftypes[index] == 'date') {
                            input_id = '#mce-' + fnames[index] + '-month';
                            f = $(input_id).parent().parent().get(0);
                        } else {
                            input_id = '#mce-' + fnames[index];
                            f = $().parent(input_id).get(0);
                        }
                        if (f) {
                            $(f).append(html);
                            $(input_id).focus();
                        } else {
                            $('#mce-' + resp.result + '-response').show();
                            $('#mce-' + resp.result + '-response').html(msg);
                        }
                    }
                } catch (e) {
                    $('#mce-' + resp.result + '-response').show();
                    $('#mce-' + resp.result + '-response').html(msg);
                }
            }
        }

    });
</script><!--End mc_embed_signup-->