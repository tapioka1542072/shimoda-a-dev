<?php
 session_start();
 session_regenerate_id(true);
 if(isset($_SESSION['member_login'])==false)
 {
 	print 'ようこそゲスト様�??';
 	print '<a href="member_login.html">会員ログイン</a><br />';
 	print '<br />';
 }
 else
 {
 	print 'ようこそ';
 	print $_SESSION['member_name'];
 	print ' 様�??';
 	print '<a href="member_logout.php">ログアウ�?</a><br />';
 	print '<br />';
 }
 ?>
 
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="UTF-8">
 <title>YOMOTTO書籍販売</title>
 </head>
 <body>
 
 <?php
       
print ' 人気商�?<br/><br/>';

 
try {
    
 //DB接�?
$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
 $user='root';
 $password='';
 $dbh=new PDO($dsn,$user,$password);
 $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//�?品データ
 $sql='SELECT code,name,price FROM mst_product WHERE 1';
 $stmt1=$dbh->prepare($sql);
 $stmt1->execute();
$p_code=array();
$p_name=array();
$p_price=array();
$p_sum=array();
while(true)
{
 $rec=$stmt1->fetch(PDO::FETCH_ASSOC);
 if($rec==false)
 {
 break;
 }
 $p_code[]=$rec['code'];
 $p_name[]=$rec['name'];
 $p_price[]=$rec['price'];
 $p_sum[]=0;
}
$pro_num=count($p_code);

 //注�?�?ータ
 $sql='SELECT code,code_product,quantity FROM dat_sales_product WHERE 1';
 $stmt2=$dbh->prepare($sql);
 $stmt2->execute();
$s_code=array();
$s_pro_code=array();
$s_quantity=array();
while(true)
{
 $rec=$stmt2->fetch(PDO::FETCH_ASSOC);
 if($rec==false)
 {
 break;
 }
  $s_code[]=$rec['code'];
 $s_pro_code[]=$rec['code_product'];
 $s_quantity[]=$rec['quantity'];
}
$sales_num=count($s_code);
 
 //DB�?断
 $dbh=null;
        
 //�?�?
for ($i = 0; $i < $sales_num; $i++){
 for ($j = 0; $j < $pro_num; $j++){
 if($s_pro_code[$i]===$p_code[$j]){
    $p_sum[$j]=$p_sum[$j]+$s_quantity[$i]; 
 break;
 }
 }
 }

//ソー�?
arsort($p_sum);

//売�?1�?
$key=key($p_sum);
print '注�?数1�? ';
print '<a href="shop_product.php?procode='.$p_code[$key].'">';
print $p_name[$key].'---';
print $p_price[$key].'�?';
print ' 注�?数'.$p_sum[$key].'�?';
print '</a>';
print '<br />';

//売�?2�?
next($p_sum);
$key=key($p_sum);
print '注�?数2�? ';
print '<a href="shop_product.php?procode='.$p_code[$key].'">';
print $p_name[$key].'---';
print $p_price[$key].'�?';
print ' 注�?数'.$p_sum[$key].'�?';
print '</a>';
print '<br />';

//売�?3�?
next($p_sum);
$key=key($p_sum);
print '注�?数3�? ';
print '<a href="shop_product.php?procode='.$p_code[$key].'">';
print $p_name[$key].'---';
print $p_price[$key].'�?';
print ' 注�?数'.$p_sum[$key].'�?';
print '</a>';
print '<br />';
print '<br />';

} catch (Exception $ex){
         print 'ただ�?ま障害により大変ご迷惑をお掛けしております�??'; 
         exit(); 
    }
    
           ?> 
     
 
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
 
 print '�?品�?覧<br /><br />';
 
 while(true)
 {
 	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
 	if($rec==false)
 	{
 		break;
 	}
 	print '<a href="shop_product.php?procode='.$rec['code'].'">';
 	print $rec['name'].'---';
 	print $rec['price'].'�?';
 	print '</a>';
 	print '<br />';
 }
 
 print '<br />';
 print '<a href="shop_cartlook.php">カートを見る</a><br />';
 
 }
 catch (Exception $e)
 {
 	 print 'ただ�?ま障害により大変ご迷惑をお掛けしております�??';
 	 exit();
 }
 
 ?>
 
 </body>
 </html> 