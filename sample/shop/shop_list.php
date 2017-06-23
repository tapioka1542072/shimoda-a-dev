<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print 'ようこそゲスト様　';
	print '<a href="member_login.html">会員ログイン</a><br />';
	print '<br />';
}
else
{
	print 'ようこそ';
	print $_SESSION['member_name'];
	print ' 様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>YOMOTTO書籍</title>
</head>
<body>

<?php

try
{

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

print '商品一覧<br /><br />';

while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}
        
<?php
require_once('../common/common.php');
?>
    
キーワードを選んでください。<br/>
<from method="post"acion="">
種類
<?php_pulldown_type(); ?>
サイズ
<?php_pulldown_size(); ?>
色
<?php_pulldown_color(); ?>
<br/>
<input type="submit" value="絞り込み">
</form>

<?php

//フリーキーワード
$keyword='';
if(isset($_POST['keyword'])){
    $keyword=$_POST['keyword'];
}
if($keyword!==''){
    print $keyword.'が含まれる商品';
    print '<br/>';
}
//固定キーワード
$type='';
$size='';
$color='';
if(isset($_POST['type'])){
    $type=$_POST['type'];
    $size=$_POST['size'];
    $color=$_POST['color'];
}
if($type!==''){
    print $type.','.$size.','.$color.'に一致する商品';
    print '<br/>';
}

white(true)
{
        $rec=$stmt->fetch(PD0::FETCH_ASSOC)
            $type2=$_rec['type'];
            $size2=$_rec['size'];
            $color2=$_rec['color'];
         if($rec==false)
         {
             break;
         }
            $disp=0;
        //キーワド画から、または、キーワードが含まれるときの表示
        if(($keyword==='')&&($type==='')){
                $disp=1;
        }
        else if(($type==='')&&(strpos($rec['name'],$keyword)!==false)){
            $disp=1;
        }
        else if(($keyword==='')&&((strpos($type2,$type)!==false)&&(strpos($size2,$size)!
==false)&&(strpos($color2,$color)!==false))){
            $disp=1;
        }
        
        if($disp===1){
            print '<a href="shop_product.php?procode='.$rec['code'].'">';
            print $rec['name'].'---';
            print $rec['price'].'円';
            print '</a>';
            print '<br />';
        }      
}


if ($) {
while (($dirElement = readdir($)) !== false) {

}
closedir($);
}
        
        
        
        
	print '<a href="shop_product.php?procode='.$rec['code'].'">';
	print $rec['name'].'---';
	print $rec['price'].'円';
	print '</a>';
	print '<br />';
}

print '<br />';
print '<a href="shop_cartlook.php">カートを見る</a><br />';

}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>

</body>
</html>