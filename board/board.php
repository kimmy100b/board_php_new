<?php
#게시물 작업하는 함수 모음
header('Content-Type: text/html; charset=utf-8');
include_once "../DBconnect.php";
$DB = new DB();

class board{
    //파일 업로드 폴더
    var $uploads_dir;
    // var $uploads_dir = "../board_files";
    // // 파일명
    var $file;
    // var $file = $_FILES['userfile']['tmp_name'];
    // // 작성자
    var $writer = $_POST['writer'];
    // // 제목
    // var $title = $_POST['title'];
    // // 내용
    // var $content = htmlspecialchars($_POST['content'],ENT_QUOTES);
    // // 비밀번호
    // var $passwd = $_POST['passwd'];

    // function Board(){

    // }

    //게시물 내용 추가하는 함수
    function _add(){
        echo "안녕";
    }
}



?>