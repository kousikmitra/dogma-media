<?php
function auth()
{
    if(isset($_SESSION['user_id'])){
        return true;
    }
    return false;
}
?>