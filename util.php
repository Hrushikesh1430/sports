<?php
function validateProfile()
{
    if ( strlen($_POST['fname']) == 0 ||  strlen($_POST['lname'])== 0 ||  strlen($_POST['email']) == 0 || strlen($_POST['pno']) == 0||  strlen($_POST['uname']) == 0 ||  strlen($_POST['pass']) == 0 || strlen($_POST['cpass']) == 0)
    {
        return "All fields are required";
    }
    if(strpos($_POST['email'],'@')===false)
    {
        return "E-mail must require @";
    }
    if (($_POST['pass']) != ($_POST['cpass']) )
    {
        return "Passwords do not match";
    }
    if(!is_numeric($_POST['pno']) || strlen($_POST['pno'])!=10)
    {
        return "Enter a valid phone number";
    }


return true;
}