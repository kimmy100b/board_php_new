<?php
# 첨부파일을 다운받는 소스코드

header('Content-Type: text/html; charset=utf-8');
require_once '../DB/DBconnect.php';

$target_Dir = "../board_files/";

$d_file = $_GET['fname']; //file_name_down
$board_sid = $_GET['id'];
$sql = "select file_name_org from file where file_name_down ='" . $d_file . "' and board_sid = '" . $board_sid . "'";
$result = mysqli_query($conn, $sql);
$file = mysqli_fetch_array($result);

$o_file = $file['file_name_org'];

$down = $target_Dir . $o_file;
$filesize = filesize($down);

if (file_exists($down)) {
  header("Content-Type:application/octet-stream");
  header("Content-Disposition:attachment;filename=$d_file");
  header("Content-Transfer-Encoding:binary");
  header("Content-Length:" . filesize($target_Dir . $o_file));
  header("Cache-Control:cache,must-revalidate");
  header("Pragma:no-cache");
  header("Expires:0");
  if (is_file($down)) {
    $fp = fopen($down, "r");
    while (!feof($fp)) {
      $buf = fread($fp, 8096);
      $read = strlen($buf);
      print($buf);
      flush();
    }
    fclose($fp);
  }
} else {
?>
  <script>
    alert("존재하지 않는 파일입니다.")
  </script>
<?php
}
?>