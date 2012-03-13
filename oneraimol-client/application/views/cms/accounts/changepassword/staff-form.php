<script src="<?php echo $base_url . $config['js'] ?>/jquery.form.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/changepassword.js" type="text/javascript"></script>


<div id="msg"></div>
                        
                        <form id="formstaff-change-password" method="post" action="<?php echo $base_url ?>cms/accounts/staff/processchangepw/<?php if(isset($staff)) echo Helper_Helper::encrypt($staff->staff_id) ?>">
                            <table class="form">
                                        <?php if( isset($staff) ) { ?>
                                        <input type="hidden" name="staff_id" id="staff_id" value="<?php echo Helper_Helper::encrypt($staff->staff_id); ?>" />
                                        <?php } ?>
                                     
                                        <tr>
                                            <td class="right">
                                               <span class="required">&ast;</span>Type old password:
                                            </td>
                                        
                                            <td>
                                                <label for="old_password"></label>
                                                <input value="" class="text-input" name="old_password" id="old_password" type="password" maxlength="15" />
                                            </td>
                                            <td style="width:40%;"><span id="msg"></span></td>
                                        </tr>
                                    
                                    
                                    
                                    
                                        <tr>
                                            <td class="right">
                                                <span class="required">&ast;</span>New password:
                                            </td>
                                                
                                            <td>
                                                <label for="password"></label>
                                                <input value="" class="text-input" name="password" id="password" type="password" maxlength="15" />
                                            </td>
                                            <td style="width:40%;"><span id="msg"></span></td>
                                        </tr>
                                    
                                    
                                    
                                        <tr>
                                            <td class="right" >
                                                <span class="required">&ast;</span>Retype new password:
                                            </td>
                                        <td>
                                            <label for="retype_password"></label>
                                            <input value="" class="text-input" name="retype_password" id="retype_password" type="password" maxlength="15" />
                                        </td>
                                        
                                        <td style="width:40%;"><span id="msg"></span></td>
                                    
                                        </tr>
                                        
                                    
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><input name="btn_change" type="submit" value="Change password" />
                                                <input name="btn_cancel" type="button" onclick="cancel_changepasswordstaff()" value="Cancel" />
                                            </td>
                                        </tr>
                            
                            </table>
                        
                        </form>

<script src="<?php echo $base_url . $config['js'] ?>/cms/accounts/form/changepassword.js" type="text/javascript"></script>