<div style="width:600px; background-color:#FFFFFF;">
  <!-- Green Title Bar of the Page Center Text-->
  <!-- Container Area of the  Page Body Text-->
  <div id="PageBodyAreaforText"><br />
    <div style="background-color:#FFFFFF">
   
    <?php if($_SESSION['MM_UserGroup']!=2) {?>  
       
<div id="CP_ERPTaskManagement" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">ادارة المهام</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_taskmanagement.php"><img src="images/cpanel/add-new-expense.png" alt="Add A Task that you want to monitor" width="56" height="53" border="0" /><br />
                    اضافة مهمة</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_task_manag_update.php"><img src="images/cpanel/add-new-exp-account.png" alt="Update your Task Status" width="56" height="53" border="0" /><br />
                    
                    تحديث مهمة</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_task_manag_update.php"><img src="images/cpanel/view-expenses.png" alt="Maintain Notes" width="56" height="53" border="0" /><br />
                    ملاحظات</a></div>
                </div></td>
                <td width="90" align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
    </div>
    <p>&nbsp;</p>
       <?php  } // end of Group Based Show Area ?>
       
       
       <?php if($_SESSION['MM_UserGroup']==2) {?>  
       
<div id="CP_ERPTaskManagementEmployee" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Employee</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_task_manag_update.php"><img src="images/cpanel/add-new-exp-account.png" alt="Update your Task Status" width="56" height="53" border="0" /><br />
                    
                    تحديث مهمة</a></div>
                </div></td>
                <td width="90" align="center">&nbsp;</td>
                <td width="90" align="center">&nbsp;</td>
                <td width="90" align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
    </div>
    <p>&nbsp;</p>
       <?php  } // end of Group Based Show Area ?>
      <p>&nbsp;</p>
    </div>
  </div>
</div>
<script type="text/javascript">
    var CP_ERPTaskManagement = new Spry.Widget.CollapsiblePanel("CP_ERPTaskManagement");
	    var CP_ERPTaskManagementEmployee = new Spry.Widget.CollapsiblePanel("CP_ERPTaskManagementEmployee");
	


</script>
