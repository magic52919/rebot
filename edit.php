<!DOCTYPE html>
<html lang="en">

<head>
    <title>範本</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include_once 'mql.php';
    $mysqli->query("SET NAMES UTF8");

    if (isset($_REQUEST['editid'])) {
        $editid = $_REQUEST['editid'];
        $sql = "select * from example where id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $editid);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_object();
        $id = $product->id;
    }else if (isset($_REQUEST['updateid'])) {
        $updateid = $_REQUEST['updateid'];
        $theme = $_REQUEST['theme'];
        $content = $_REQUEST['content'];
        $time=date('Y-m-d H:i:s',time()+21600);
        $sql = "UPDATE example set theme='{$theme}',content='{$content}',createtime='{$time}' where id = {$updateid}";
        $mysqli->query($sql);
        header('Location: exampleblog.php');
    }



    ?>
    <div class="container">
        <h2>範例編號 <?php echo $id ?></h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>主題</th>
                    <th>內容</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="edit.php" method="post" enctype='multipart/form-data'>
                        <input type="hidden" name="updateid" value='<?php echo $product->id; ?>'>
                    <td><input type="text" name="theme" value='<?php echo $product->theme; ?>'></td>  
                    <td><textarea name="content"  cols="60" rows="10"><?php echo $product->content; ?></textarea></td>    
                    <td><input type="submit" value="新增"> </td>   
                </form>
                    
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>