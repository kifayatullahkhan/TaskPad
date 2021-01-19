<ul>
        <li><a href="cpanel.php">لوحة التحكم</a>
            <ul>
            <li><a href="user_profile.php">الملف الشخصي</a></li>         
            <li><a href="change_password.php">تغيير كلمة المرور</a></li>          	
            <li><a href="sign_in/sign_out.php">خروج</a></li>            
            </ul>

        </li>
         <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],3,$database_Conn,$Conn)>=1   || Get_Allow_Everyone_AccessessRights(3,$database_Conn,$Conn)>=1) {?>
            <li><a href="#">الاعدادات</a>
             <ul>
                <li><a href="user_accounts.php">حسابات المستخدمين</a></li>
                <li><a href="user_groups.php">المجموعات</a></li>           
                <li><a href="change_user_password.php">تغيير كلمة المرور</a></li>
  			</ul>  
            </li>   
            <li><a href="#">المهام</a>
             <ul>
             <li><a href="erp_taskmanagement.php">اضافة مهمة</a></li>
                <li><a href="erp_task_manag_update.php"> تحديث مهمة</a></li>
  			</ul>  
            </li>   
       <?php  } // end of Group Based Show Area ?>

            
             <li><a href="erp_task_manag_update.php">عرض</a>
             <ul>
                <li><a href="erp_task_manag_update.php"> عرض المهام</a></li>
  			</ul>  
            </li>                  
      </ul>