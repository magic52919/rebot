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
  $sql = "select * from example";
  $result = $mysqli->query($sql);

  if (isset($_REQUEST['deleteid'])) {
    $deleteid = $_REQUEST['deleteid'];
    $sql = "DELETE FROM example where id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $deleteid);
    $stmt->execute();
    header('Location: exampleblog.php');
  }
  ?>
  <div class="container">
    <h2>範例<a href="create.php" class="btn btn-md btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> 新增</a></h2>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>編號</th>
          <th>主題</th>
          <th>內容</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php
        session_start();
        echo $_SESSION['url'];
        $i = 1;
        while ($product = $result->fetch_object()) {
          echo '<tr>';
          echo "<td>{$i}</td>";
          echo "<input type='hidden' name='updateid' value='$product->id'>";
          echo "<td>{$product->theme}</td>";
          echo "<td><textarea cols='60' rows='10' readonly='readonly'>{$product->content}</textarea></td>";
          echo "<td>";
          echo "<span class='pull-right'>";
          echo "<a href='edit.php?editid={$product->id}' class='btn'>修改</a>";
          echo "<a href='?deleteid={$product->id}' onclick='return confirmDelete(\"編號{$i}\")'><button type='submit' class='btn'>刪除</button></a>";
          echo "</span>";
          echo "</td>";
          echo '</tr>';
          $i++;
        }
        ?>
        <script>
          function confirmDelete(con) {
            return confirm('確定刪除' + con + '?');
          }
          
        </script>
      </tbody>
    </table>

    <a href=<?php echo $_SESSION['url'] ?> class="btn btn-md btn-success"><span class="glyphicon"></span>回頁面</a>
  </div>

</body>

</html>