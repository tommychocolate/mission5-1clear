<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-01</title>
</head>
<body>
    追加<br>
    <form action="" method="post">
        <input type="text" name="name" value="名前">
        <input type="text" name="str" value="コメント">
        <input type="submit" name="submit" value="送信">
    </form>
        削除<br>
        <form action="" method="post">
        <input type="text" name="num" value="">
        <input type="text" name="pass" value="pass">
        <input type="submit" name="deleate" value="削除">
    </form>
        編集<br>
        <form action="" method="post">
        <input type="text" name="number" value="番号">
        <input type="text" name="name2" value="名前">
        <input type="text" name="str2" value="コメント">
        <input type="text" name="pass2" value="pass">
        <input type="submit" name="make" value="編集">
    </form>

<?php
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
         $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    //追加
                $pass=$_POST["pass"];
                $pass2=$_POST["pass2"];
                if($_POST["str"]==""||$_POST["name"]==""){
                    //echo "error";
                }
                else
                {


    $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $name = $_POST["name"];
    $comment = $_POST["str"]; //好きな名前、好きな言葉は自分で決めること
    $sql -> execute();
                }
    //追加終わり
        //削除
                    if($_POST["num"]==""){}else{
                    if($pass=="kirimi"){
                        if(!empty($_POST["num"])){

    $id = $_POST["num"];
    $sql = 'delete from tbtest where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();


    }
                        }
                    }
                    
    //削除ここまで
        //編集
                    if($_POST["name2"]==""||$_POST["str2"]==""){}else{
                    if($pass2=="sashimi"){
                        if(!empty($_POST["number"])){


    $id = $_POST["number"]; //変更する投稿番号
    $name =$_POST["name2"];
    $comment = $_POST["str2"]; //変更したい名前、変更したいコメントは自分で決めること
    $sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
                        }
                    }else{}
                    }



    //編集ここまで
        $dsn = 'mysql:dbname=tb230961db;host=localhost';
    $user = 'tb-230961';
    $password = 'ndv7Zvae3L';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
    if(isset($_POST['reset'])){
        $dsn = 'mysql:dbname=tb230961db;host=localhost';
    $user = 'tb-230961';
    $password = 'ndv7Zvae3L';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        $sql = 'DROP TABLE tbtest';
        $stmt = $pdo->query($sql);    
        echo "削除されました";
    }
?>  
        </form>
        リセット<br>
        <input type="submit" name="reset" value="リセット"/>
    </form>
</body>
</html>