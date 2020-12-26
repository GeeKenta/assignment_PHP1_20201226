<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>超簡易的アンケート</title>
</head>
<body>
    
<h2>アンケート入力ページ</h2>
 
<form action="result.php" method="post">
<!-- <div>
  <p> 名前: <input type="text" name="your_name" value=""></p>
</div>
<div>
  <span>E-mail: </span>
  <input type="text" name="email" size="40" value="<?= $email ?>">
</div> -->
<div>
<p>性別</p>
  <input type="radio" name="gender" id="male" value="1">
    <label for="male"> 男性 </label>  
  <input type="radio" name="gender" id="female"  value="2">
    <label for="female"> 女性 </label>      
</div>
<div>
<label for="age"> 年齢 </label>
<select name="age" id="age">
<option value="0" selected>選択してください。</option>
<?php
for($num = 1; $num <= 7; $num++) {
  echo '<option value="' . $num . '">' . $num . '0代</option>' . "\n";
}
?>
<option value="8">80代以上</option>
</select>
</div>
<div>
<p>趣味</p>
<?php
$hobby = array(0 => "音楽",
               1 => "スポーツ",
               2 => "車",
               3 => "アート",
               4 => "旅行",
               5 => "カメラ",
               6 => "読書",
               7 => "その他");
$ids = array('music', 'sport', 'car', 'art', 'travel', 'camera', 'book', 'other');
foreach($hobby as $key => $value) {
  echo '<label for="' . $ids[$key] .'"><input type="checkbox" name="hobby[]" value="' 
  .$key . '" id="' . $ids[$key] . '">' . $value . '</label>' . "\n";
}
 
?>
</div>
<div>
<input type="submit" >
</div>
</form>

</body>
</html>