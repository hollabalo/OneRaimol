function cancel_staff(){redirect("cms/accounts/staff")}function submit_staff(){wait_msg(message.loading);$("#staff-form").ajaxSubmit(function(a){a=JSON.parse(a);if(a.success==true)if(a.action=="add")redirect("cms/accounts/staff/index/MG4zUmExbTBMYWRk");else a.action=="edit"&&redirect("cms/accounts/staff/index/MG4zUmExbTBMZWRpdA==");else error_msg(a.failmessage)})}
function delete_staff(){$(".success").hide();$(".notice").hide();var a=get_ids("id");if(a.length<1){error_msg(message.noselection);return false}wait_msg(message.loading);$.ajax({url:base_url+"cms/accounts/staff/delete",type:"POST",dataType:"json",data:{id:a},success:function(b){b.success==true&&redirect("cms/accounts/staff/index/MG4zUmExbTBMZGVsZXRl")},error:function(){error_msg(message.ajaxerror)}});return false}
function enable_staff(){$(".success").hide();$(".notice").hide();var a=get_ids("id");if(a.length<1){error_msg(message.noselection);return false}wait_msg(message.loading);$.ajax({url:base_url+"cms/accounts/staff/enable",type:"POST",dataType:"json",data:{id:a},success:function(b){b.success==true&&redirect("cms/accounts/staff/index/MG4zUmExbTBMZW5hYmxl")},error:function(){error_msg(message.ajaxerror)}});return false}
function disable_staff(){$(".success").hide();$(".notice").hide();var a=get_ids("id");if(a.length<1){error_msg(message.noselection);return false}wait_msg(message.loading);$.ajax({url:base_url+"cms/accounts/staff/disable",type:"POST",dataType:"json",data:{id:a},success:function(b){b.success==true&&redirect("cms/accounts/staff/index/MG4zUmExbTBMZGlzYWJsZQ==")},error:function(){error_msg(message.ajaxerror)}});return false};
