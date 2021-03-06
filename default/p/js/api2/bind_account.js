$(function()
{
	$("#bind_form").validate({
        focusInvalid: false,
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		messages:
		{
			email: {
				required: "`電子信箱`與`行動電話`至少需填寫其中之一",
				email: "請填寫正確的電子信箱位址"
			},
			mobile: {
				required: ""
			},
			pwd: {
				required: "`密碼`必填",
				minlength: "`密碼`最少6碼",
				maxlength: "`密碼`最多18碼",
			},
			pwd2: { 
				required: "`確認密碼`必填",
				equalTo: "兩次密碼不相同",
			},
		},
		rules:
		{
			email: {
				required: "#mobile:blank"
			},
			mobile: {
				required: "#email:blank"
			}
    	},
		showErrors: function(errorMap, errorList)
		{
		   var err = '';
		   $(errorList).each(function(i, v)
		   {
			   err += v.message + "<br/>";
		   });
		   if (err)
		   {
				leOpenDialog('綁定錯誤', err, leDialogType.MESSAGE);
		   }
		},
		submitHandler: function(form)
		{
			$(form).ajaxSubmit({
				dataType: 'json',
				success: function(json)
				{
					if (json.status == 'success')
					{
						location.href = '/api2/ui_login?site='+json.site;
						return;
					}					
					else
					{
						leOpenDialog('綁定錯誤', json.message, leDialogType.MESSAGE);
					}
				}
			});
		}
	});
});

