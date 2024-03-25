<head>


<?php //include'view/pages/includes/files/links.php';?>

    <style>
    *{
        font-family: 'roboto';
    };
    .span{
        text-transform: uppercase;
    }
</style>
</head>



<div>
    <div align="center">
        <span style="color: red; font-size: 57px; text-transform:inherite;"><strong>Oops...!</strong></span>
    </div>
    <br />
    <span style="color: black;">Seems like you either clicked a <b>Broken Link</b> or a <b>page that no longer exists</b>. Kindly do one of the followings:</span><br />
    <ol style="line-height: 25px;">
        <li><span style="font-size: large;"><a href="<?=$_SERVER['HTTP_REFERER'];?>"> Go back</a> </span></li>
        <li><span style="font-size: large;"><a href="./">Go to Homepage</a> and surf with safety on our website.</span></li>
    </ol>
    <br />
    <div align="center">
        <span style="color: #08c500; font-size: 120px;"><strong>404</strong></span>
    </div>
    <div align="center">
        <span style="color: #eb0f0f; font-size: 20px;">Page Not Found!</span>
    </div>
</div>