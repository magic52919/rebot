<!DOCTYPE HTML>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf8">
    <html lang="en">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <title>skype群發工具</title>
    <style>
        #cul_word {
            float: right;
        }
    </style>

<body background="bcakground.png" style="background-repeat:no-repeat; background-size: cover;">
    <?php
    session_start();
    $_SESSION['url']='skyfrom.php';
    ?>
    
<script>
        function word() {
            let length = encodeURI(document.getElementById("content").value).length;
            if (length > 900) {
                alert("已超過字數限制");
            }
            console.log(encodeURI(document.getElementById("content").value));
            document.getElementById("test").innerHTML = 900 - length;

        }

        function alert_bbin() {

            if (window.confirm('你確定要發送至bbin嗎?') == true) {
                document.getElementById('send').disabled = true;
                return true;
            } else {
                document.getElementById('send').disabled = false;
                return false;
            }
        }
    </script>
    <form action="skyfrom.php" method="post" style="margin-left:10%" onkeyup="word()" onsubmit="return alert_bbin();">
        <h3 style=color:blue;>群發到所有外接API群組視窗<a id="right" href="exampleblog.php" style="margin-left:  80px" class="btn  btn-success pull-right">範本</a></h3>
        
        <div style="width: 500px">
            <textarea style="border:3px black dashed;border-radius:5px;background-color:rgba(241,241,241,.98);width: 500px;height: 500px;padding: 10px;resize: none;" placeholder="輸入群發內容" name="content" id="content"></textarea><br>
            <input type="submit" class="btn btn-primary" data-toggle="button" style="background-color:black" id="send">
            <span id="cul_word">
                <h4>剩餘字元:<span id="test" style="">950</span></h4>
            </span>
            <div>
            <script>
        let dt = new Date();
        document.write(dt.getTime());
        document.write('<br>');

        var strtime = '2014-04-23 18:55:49:123';
        
        var dd = new Date(strtime.replace(/-/g, '/'));
      
        document.write(dd.getTime());
      </script>
                <?php
                if (!isset($_REQUEST['content'])) exit(0);
                include_once("skyperobotcurl.php");
                echo sendMessage($_REQUEST['content']);
                //echo $_REQUEST['content'];
                unset($_SESSION['url']);

                header('location: '.$_SERVER['HTTP_REFERER']);
                ?>
            </div>

        </div>
    </form>
    
</body>

</html>