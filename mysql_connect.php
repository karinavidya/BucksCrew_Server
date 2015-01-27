<?php
    $link = mysql_connect('localhost', 'root', '');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully <br>';
     
    mysql_select_db('BucksCrew', $link);
    $dbAccount = 'dbAccount';
    $dbSubscription = 'dbSubscription';

    //mysql_close($link);
?>