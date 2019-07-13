<?php 

if (!isset($_SESSION['invoice']))
{
    echo $Last_id = $_SESSION['invoice']['last_id'];
    $State_id = $_SESSION['invoice'][$Last_id]['state'];
}