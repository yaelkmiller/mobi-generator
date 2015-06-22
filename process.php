<?php
session_start();
if(isset($_POST["action"]) && $_POST["action"] == "upload") {
    upload_action();
}


function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
} // from http://www.php.net/manual/en/features.file-upload.multiple.php#53240

function upload_action() {
	if($_FILES["userfile"]["type"][0] != "text/html") {
		$_SESSION["errors"]["ebook-html"] = "<div class='alert alert-danger'>Your main ebook .html file is not valid.
             </div>";
	}
	if($_FILES["userfile"]["type"][1] != "text/html") {
		$_SESSION["errors"]["toc-html"] = "<div class='alert alert-danger'>Your table of contents .html file is not valid.
         </div>";
	}
	if(pathinfo($_FILES["userfile"]["name"][2], PATHINFO_EXTENSION) != "ncx") {
		$_SESSION["errors"]["toc-ncx"] = "<div class='alert alert-danger'>Your table of contents .ncx file is not valid.
         </div>";

	}
	if(pathinfo($_FILES["userfile"]["name"][3], PATHINFO_EXTENSION) != "opf") {
		$_SESSION["errors"]["ebook-opf"] = "<div class='alert alert-danger'>Your ebook .opf file is not valid.
     </div>";
	}
	if($_FILES["userfile"]["type"][4] != "image/jpeg" && $_FILES["userfile"]["type"][4] != "image/tiff") {
		$_SESSION["errors"]["cover-image"] = "<div class='alert alert-danger'>Your cover image file is not valid.
     </div>";
	}
	if($_FILES["userfile"]["type"][5] != '' && $_FILES["userfile"]["type"][5] != "image/jpeg" && $_FILES["userfile"]["type"][5] != "image/tiff") {
		$_SESSION["errors"]["add-image1"] = "<div class='alert alert-danger'>Your image file is not valid.
     </div>";
	}
	if($_FILES["userfile"]["type"][6] != '' && $_FILES["userfile"]["type"][6] != "image/jpeg" && $_FILES["userfile"]["type"][6] != "image/tiff") {
		$_SESSION["errors"]["add-image2"] = "<div class='alert alert-danger'>Your image file is not valid.
     </div>";
	}
	if (empty($_SESSION["errors"])) {
		$time = $_POST["time"];
		$file_name = pathinfo($_FILES["userfile"]["name"][0], PATHINFO_FILENAME);  
		$new_folder = mkdir("other-people\\$file_name-$time");
		$new_folder = "other-people\\$file_name-$time";
		$file_ary = reArrayFiles($_FILES['userfile']);
		foreach ($file_ary as $file) {
			$tmp_name = $file["tmp_name"];
			$name = $file["name"];
		move_uploaded_file($tmp_name, "$new_folder/$name");
		}

		$mobi_console = shell_exec("other-people\kindlegen.exe ".$new_folder."\\".$_FILES["userfile"]["name"][3]);
		$_SESSION["console"] = $mobi_console;
		$mobi_name = pathinfo($_FILES["userfile"]["name"][3], PATHINFO_FILENAME);
		$_SESSION["mobi"] = $new_folder."\\".$mobi_name.".mobi";
	}
	header("location: index.php");
}

 ?>