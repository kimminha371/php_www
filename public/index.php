<?php
$config = include "../dbconf.php";
// echo "대림대학교";
// print_r($config);

require "../Loading.php";
// require "../Module/Database/Database.php";
// require "../Module/Database/Table.php";

$db = new \Module\Database\Database($config);
//echo "<br>";
$query = "SHOW TABLES";
$result = $db->queryExecute($query);

$count = mysqli_num_rows($result);
$content = ""; //초기화
$rows = []; //배열 초기화
for($i=0;$i<$count;$i++) {
    $row = mysqli_fetch_object($result);
    $rows []=$row;
    // $content .= "<tr>";
    // $content .= "<td>$i</td>";
    // $content .= "<td>".$row->Tables_in_php."</td>";
    // $content .= "</tr>";
}
$content = table($rows);

$body = file_get_contents("../Resource/table.html");
//데이터 치환
$body = str_replace("{{content}}",$content,$body); 
echo $body;

function table($rows)
{
    $body = "<table class=\"table\">";
    $body .= "<thead>";
    $body .= "<tr>
        <th>번호</th>
        <th>테이블명</th>
      </tr>";
      $body .= "</thead>";
      $body .= "<tbody>";

      for($i=0;$i<count($rows);$i++){
        $body .= "<tr>";
        $body .= "<td>$i</td>";
        $body .= "<td>".$rows[$i]->Tables_in_php."</td>";
        $body .= "</tr>";
      }

      $body .= "</tbody>";
      $body .= "</table>";

      return $body;
      
}