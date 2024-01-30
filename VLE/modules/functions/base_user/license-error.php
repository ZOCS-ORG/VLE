
<style>
    .page{
        text-align:center; 
        font-family:helvetica;
        padding:5% 0; 
        color:#f97b49;
    }
</style>

<div class='page'>
<img src="../../base_user/bg.jpg" alt="img">
<?php
    echo "<h2>".$fatal_error." </h2> <br>";

    if(isset($add_license)){ 
        echo "<h2>".$add_license." </h2> <br>";
    }
    die();
?>
<img>
</div>