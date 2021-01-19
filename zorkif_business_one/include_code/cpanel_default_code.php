<div style="width:600px; background-color:#FFFFFF;">
 
  <!-- Container Area of the  Page Body Text-->
  <div id="PageBodyAreaforText"><br />
<div style="background-color:#FFFFFF">
    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],1,$database_Conn,$Conn)>=1   || Get_Allow_Everyone_AccessessRights(1,$database_Conn,$Conn)>=1) {?>      
      <div id="CP_Usermanagement" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">User Management</div>
        <div class="CollapsiblePanelContent"><br />
            <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0" class="DataEntryView">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="user_accounts.php"><img src="images/cpanel/add-user.png" alt="Manage User Account for the Software Login System" width="56" height="53" border="0" /><br />
                    User Accounts </a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="user_groups.php"><img src="images/cpanel/add-group.png" alt="Manage  User Groups in the Software for Login system and Rights Assignment" width="56" height="53" border="0" /><br />
                    Groups</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="change_user_password.php"><img src="images/cpanel/change-user-password.png" alt="Change any User's Password" width="56" height="53" border="0" /><br />User Password</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="change_password.php"><img src="images/cpanel/change-password.png" alt="Change your Password" width="56" height="53" border="0" /><br />Change Passwd</a></div>
                </div></td>
              </tr>
              </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>




    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],3,$database_Conn,$Conn)>=1   || Get_Allow_Everyone_AccessessRights(3,$database_Conn,$Conn)>=1) {?>       
       
      <a name="NewsManagement" id="NewsManagement"></a>
      <div id="CP_NewsManagement" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">News Management</div>
        <div class="CollapsiblePanelContent">
               <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="news_addnew.php"><img src="images/cpanel/add-news.png" alt="Add Dynamic news content to your web site." width="56" height="53" border="0" /><br />
                    Add News</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="news_viewall.php"><img src="images/cpanel/view-news.png" alt="view the list of news added to the web site." width="56" height="53" border="0" /><br />
                    View News</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"></div>
                </div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>
           <?php  } // end of Group Based Show Area ?>
</div>
  </div>
</div>


<script type="text/javascript">
	var CP_Usermanagement = new Spry.Widget.CollapsiblePanel("CP_Usermanagement");
	var CP_NewsManagement = new Spry.Widget.CollapsiblePanel("CP_NewsManagement");	
</script>
