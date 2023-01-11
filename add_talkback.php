<?php

include 'db_params.php';
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_schema);


// נגד הזרקת sql
$name = isset($_GET['name']) ? addslashes($_GET['name']) : "";
$title = isset($_GET['title']) ? addslashes($_GET['title']) : "";
$content  = isset($_GET['content']) ? addslashes($_GET['content']) : "";
if (isset($_GET['btn'])) {

    $query = "INSERT INTO `tkbk` ";
    $query .= "(`id`, `title`, `content`, `name`) ";
    $query .= " VALUES ";
    $query .= " (NULL, '$title', '$content', '$name'); ";
    $result = mysqli_query($mysqli, $query);
}
//-------/\-----------------/\------------

//-------/\--------- ניחושים עם SESSION --------/\------------

$_SESSION['name'] = value;

session_start();
if (isset($_SESSION['name']) AND $_SESSION['name'] != '')
{
header("location:add_talkback.php");
exit();
}
?>
<html>
    <head>
        <title>talk backs</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        להוספת תגובה:
        <form method="get" action="">
            title:<input type="text" name="title"  />
            <br/>
            content:<input type="text" name="content"  />
            <br/>
            name:<input type="text" name="name"  />
            <br/>
            <br/>
            <button name="btn" value="1">Send</button>        
        </form>
        <h2>התגובות</h2>
        <?php
        //-------/\---------cookie  print user--------/\------------

        echo $_COOKIE['name']; 
        $query ="SELECT * FROM `tkbk`  ";
        $result = mysqli_query($mysqli,$query);
        while($row = mysqli_fetch_assoc($result)) {?>
            <div>
                <!-- javascript נגד הזקרת קוד -->
            <h3><?php echo htmlspecialchars($row['title']) ?></h3>
            (<?php echo htmlspecialchars($row['name']) ?>)
            <p><?php echo htmlspecialchars($row['content']) ?></p>
            </div>
        <?php } ?>

    </body>
</html>