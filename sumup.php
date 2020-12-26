<?php
$textfile = './data/sumupdata.text';

$fp = fopen($textfile, 'rb');   
 
if(!$fp){  
  exit('ファイルがないか異常があります。');
}
 
if(!flock($fp, LOCK_EX)){
  exit('ファイルをロックできませんでした。');
}
 
while(!feof($fp)){
  $results[] = trim(fgets($fp));
}
 
if($results[18] != 0){  
  echo '<p>アンケートの集計結果：総数 ' . $results[18] . ' 件</p>';
 
?>
 
<table>
  <style>
  table th {
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    border: 1px solid #ccc;
    background-color: #666;
    color: #FFF;
  }
  table td {
    padding: 10px;
    vertical-align: top;
    border: 1px solid #ccc;
  }
  </style>
  <thead>
  <tr>
  <th>質問</th>
  <th>人数</th>
  <th>比率</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td>性別</td>
<?php
  $male_rate   = round($results[0] / $results[18] * 100);
  $female_rate = round($results[1] / $results[18] * 100);
 
  echo '  <td>男性：' . $results[0] . '人 女性：' . $results[1] . '人</td>';
  echo '  <td>男性：' . $male_rate . '% 女性：' . $female_rate . '%</td>';
?>
  </tr>
  <tr>
  <td>年齢</td>
<?php
  $age10_rate = round($results[2] / $results[18] * 100);
  $age20_rate = round($results[3] / $results[18] * 100);
  $age30_rate = round($results[4] / $results[18] * 100);
  $age40_rate = round($results[5] / $results[18] * 100);
  $age50_rate = round($results[6] / $results[18] * 100);
  $age60_rate = round($results[7] / $results[18] * 100);
  $age70_rate = round($results[8] / $results[18] * 100);
  $age80_rate = round($results[9] / $results[18] * 100);
 
  echo '  <td>10代：' . $results[2] . '人<br>' .
             '20代：' . $results[3] . '人<br>' .
             '30代：' . $results[4] . '人<br>' .
             '40代：' . $results[5] . '人<br>' .
             '50代：' . $results[6] . '人<br>' .
             '60代：' . $results[7] . '人<br>' .
             '70代：' . $results[8] . '人<br>' .
         '80代以上：' . $results[9] . '人</td>';
  echo '  <td>10代：' . $age10_rate . '%<br>' .
             '20代：' . $age20_rate . '%<br>' .
             '30代：' . $age30_rate . '%<br>' .
             '40代：' . $age40_rate . '%<br>' .
             '50代：' . $age50_rate . '%<br>' .
             '60代：' . $age60_rate . '%<br>' .
             '70代：' . $age70_rate . '%<br>' .
         '80代以上：' . $age80_rate . '%</td>';
?>
  </tr>
  <tr>
  <td>趣味</td> 
  
<?php
  $hobby1_rate = round($results[10] / $results[18] * 100);
  $hobby2_rate = round($results[11] / $results[18] * 100);
  $hobby3_rate = round($results[12] / $results[18] * 100);
  $hobby4_rate = round($results[13] / $results[18] * 100);
  $hobby5_rate = round($results[14] / $results[18] * 100);
  $hobby6_rate = round($results[15] / $results[18] * 100);
  $hobby7_rate = round($results[16] / $results[18] * 100);
  $hobby8_rate = round($results[17] / $results[18] * 100);
 
  echo '  <td>音楽：' . $results[10] . '人<br>' .
         'スポーツ：' . $results[11] . '人<br>' .
               '車：' . $results[12] . '人<br>' .
           'アート：' . $results[13] . '人<br>' .
             '旅行：' . $results[14] . '人<br>' .
           'カメラ：' . $results[15] . '人<br>' .
             '読書：' . $results[16] . '人<br>' .
           'その他：' . $results[17] . '人</td>';
  echo '  <td>音楽：' . $hobby1_rate . '%<br>' .
         'スポーツ：' . $hobby2_rate . '%<br>' .
               '車：' . $hobby3_rate . '%<br>' .
           'アート：' . $hobby4_rate . '%<br>' .
             '旅行：' . $hobby5_rate . '%<br>' .
           'カメラ：' . $hobby6_rate . '%<br>' .
             '読書：' . $hobby7_rate . '%<br>' .
           'その他：' . $hobby8_rate . '%</td>';
?>
  </tr>
  </tbody>
  </table>
<?php
} else {
  echo '  <p class="msg">表示できるようなアンケートデータがありません。</p>';
}
fclose($fp);
echo '<p class="link"><a href="input.php">アンケートページへ戻る</a></p>';
?>