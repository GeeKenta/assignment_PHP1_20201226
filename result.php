<h1>アンケート結果</h1>
<?php
function checkInput($var){
  if(is_array($var)){
    return array_map('checkInput', $var);
  }else{
    if(get_magic_quotes_gpc()){  
      $var = stripslashes($var);
    }
    if(preg_match('/\0/', $var)){  
      die('不正な入力（NULLバイト）です。');
    }
    if(!mb_check_encoding($var, 'UTF-8')){ 
      die('不正な文字エンコードです。');
    } 
    if(!ctype_digit($var)) {  
      die('不正な入力です。');
    }
    return (int)$var;
  }
}
 
$_POST = checkInput($_POST);
 
$error = 0;  
 
if(isset($_POST['gender'])) {
  $gender = $_POST['gender'];
  if($gender == 1) {
    $gendername = '男性';
  }elseif($gender == 2) {
    $gendername = '女性';
  }else{
    $error = 1; 
  }
}else{
  $error = 1;
}
 
if(isset($_POST['age'])) {
  $age = $_POST['age'];
  if($age < 1 || $age > 8 ) {
    $error = 1;  
  }
}else{
   $error = 1;  
}
 
if(isset($_POST['hobby'])) {
  $hobby = $_POST['hobby'];
  if(is_array($hobby)) {
    foreach($hobby as $value) {
      if($value < 0 || $value > 7) {
        $error = 1;  
      }
    }
  }else{
    $error = 1;  
  }
}else{
  $error = 1;  
}
 
if($error == 0) {
  echo '<dl>';
  echo '<dt>性別：</dt><dd>' . $gendername . '</dd>';  
  
  if($age != 8) {
    echo '<dt>年齢：</dt><dd>' . $age . '0代</dd>';
  }else{
    echo '<dt>年齢：</dt><dd>80代以上</dd>';
  }
  
  echo '<dt>趣味：</dt>';
  echo '<dd>';
  foreach($hobby as $value) {
    switch($value) {
      case 0:
        echo '音楽<br>';
        break;
      case 1:
        echo 'スポーツ<br>';
        break;
      case 2:
        echo '車<br>';
        break;
      case 3:
        echo 'アート<br>';
        break;
      case 4:
        echo '旅行<br>';
        break;
      case 5:
        echo 'カメラ<br>';
        break;
      case 6:
        echo '読書<br>';
        break;
      case 7:
        echo 'その他<br>';
        break;
    }
  }
  echo '</dd></dl>';
  
  $textfile = './data/sumupdata.text';
  
  $fp = fopen($textfile, 'r+b');
  if(!$fp) {
    exit('ファイルが存在しないか異常があります');
  }
  if(!flock($fp, LOCK_EX)){
    exit('ファイルをロックできませんでした');
  }
  while(!feof($fp)) {
    $results[] = trim(fgets($fp));
  }
  
  if($gender == 1) $results[0] ++;
  if($gender == 2) $results[1] ++;
  
  $results[$age + 1] ++;
  
  foreach($hobby as $value) {
    $results[$value + 10] ++;
  }
  
  $results[18] ++;
  
  rewind($fp);
 
  foreach($results as $value) {
    fwrite($fp, $value . "\n");
  }
  
  fclose($fp);
  
  echo '<p class="message sucess">以上の内容を保存しました。<br>アンケートにご協力いただきありがとうございました！</p>';
  echo '<p class="message"><a href="sumup.php">集計結果ページへ</a></p>';
}else{
  echo '<p class="message error">恐れ入りますが<a href="input.php">アンケート入力ページ</a>に戻り、アンケートの項目全てにお答えください。</p>';
}
 
?>