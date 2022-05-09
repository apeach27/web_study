<?php
    include "00_conn.php";

    $fno = $_POST['fno'];

    if(isset($_FILES['fileup']) && $_FILES['fileup']['name'] != "") {

        $file = $_FILES['fileup'];
        $upload_directory = 'data/';
        $ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
    
        $allowed_extensions = explode(',', $ext_str);
    
        $max_file_size = 5242880;
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1);
    
        // 확장자 체크
        if(!in_array($ext, $allowed_extensions)) {
            echo "업로드할 수 없는 확장자 입니다.";
        }

        // 파일 크기 체크
        if($file['size'] >= $max_file_size) {
            echo "5MB 까지만 업로드 가능합니다.";
        }

        $path = md5(microtime()) . '.' . $ext;

        if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
    
            echo $query = "INSERT INTO fileup (file_id, name_orig, name_save, reg_time) VALUES(?,?,?,now())";
    
            $file_id = md5(uniqid(rand(), true));
            $name_orig = $file['name']; 
            $name_save = $path;
    
            $stmt = mysqli_prepare($conn, $query);
            $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
            $exec = mysqli_stmt_execute($stmt);
    
            mysqli_stmt_close($stmt);
    
            echo"<h3>파일 업로드 성공</h3>";
            echo "<meta http-equiv='Refresh' content='1; url=01_list.php'/>";

        }

    } else {
        echo "<h3>파일이 업로드 되지 않았습니다.</h3>";
        echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
    }
    
	mysqli_close($conn);
    
    
    
    // echo $_SERVER["DOCUMENT_ROOT"];
    // function arrdir($dir){
        // arrdir() 지정한 디렉토리의 파일 목록을 배열에 반환하는 함수 (기본 : 오름차순, sort() 내림차순 )

        // if ($handle = opendir($dir)) {
        //     while (($file = readdir($handle))){
        //         $ardir[] = $file;
        //     }
        //     closedir($handle);
        //     sort($ardir);
        //     return $ardir;
        // }
        // else{
        //     echo ("디렉토리를 검색할 수 없습니다.");
        // }

    // }

    // $dir = "./down/";
    // $file_name = $_FILES["fn"]['name'];
    // $file_size = $_FILES["fn"]['size'];
    // $file_tmp = $_FILES["fn"]['tmp_name'];
    // $uploadfile = $dir. $file_name;

    // echo(
    //     "파일명 : $file_name<br/>
    //     파일크기(byte) : $file_size<br/>
    //     임시저장경로 : $file_tmp<br/>
    //     저장 파일 : $uploadfile<br/><br/>"
    // );

    // if(move_uploaded_file($file_tmp, $uploadfile)) {
    //     echo("파일 업로드 완료");
    //     $ardir = scandir($dir);
    //     foreach($ardir as $value){
    //         if($value != "." && $value !="..")
    //             echo("{$value}<br/>");
    //     }
    // }
    // else
    //     die("파일 업로드 실패");
?>