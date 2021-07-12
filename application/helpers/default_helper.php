<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function columnLetter($c){

    $c = intval($c);
    if ($c <= 0) return '';

    $letter = '';
             
    while($c != 0){
       $p = ($c - 1) % 26;
       $c = intval(($c - $p) / 26);
       $letter = chr(65 + $p) . $letter;
    }
    
    return $letter;
        
}

function encrypt($simple_string, $ciphering = "AES-128-CTR", $encryption_key = "inventaris_shs", $options = 0, $encryption_iv = '1234567891011121'){
	return openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
}

function decrypt($simple_string, $ciphering = "AES-128-CTR", $encryption_key = "inventaris_shs", $options = 0, $encryption_iv = '1234567891011121'){
	return openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
}

function session_key(){
	return md5("inventaris_shs");
}

function font_awesome($fa){
	return '<i class="fa '.$fa.'" ></i>';
}

function array_seek($arrays, $selectkey){
	$result = NULL;
	for ($i=0; $i < count($arrays); $i++) { 
		$t = $arrays[$i];
			if($t['name'] == $selectkey) {
			$result = $t['value'];
			break;
		};
	}
	return $result;
}

function input_text_value($va = NULL, $default_val = NULL){
	if($va==NULL){
		if ($default_val <> NULL) {
			return $default_val;
		}
		return NULL;
	}else{
		return $va;
	}
}

function input_radio_value($this_value, $value=NULL, $this_default=FALSE){
	if ($value == NULL) {
		return NULL;
	}else if($value == $this_value){
		return 'checked="true"';
	}else{
		return NULL;
	}
}

function input_checkbox_value($this_value, $value=NULL, $this_default=FALSE){
	if ($value == NULL) {
		return NULL;
	}else if($value == $this_value){
		return 'checked="true"';
	}else{
		return NULL;
	}
}

function input_select_value($value=NULL, $text=NULL){
	if($value==NULL&&$text==NULL){
		return '<option class="removable" value=""></option>';
	}else{
		return '<option class="removable" value="'.$value.'">'.$text.'</option>';
	}
}

function create_thumbnail($img, $width = 100, $height = 100)
{
    $thumbnail_width = $width;
    $thumbnail_height = $height;
    $thumb_beforeword = "thumb";
    $arr_image_details = getimagesize($img);
    $original_width = $arr_image_details[0];
    $original_height = $arr_image_details[1];
    if ($original_width > $original_height) {
        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);
    } else {
        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);
    }
    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);
    if ($arr_image_details[2] == IMAGETYPE_GIF) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    }
    if ($arr_image_details[2] == IMAGETYPE_JPEG) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    }
    if ($arr_image_details[2] == IMAGETYPE_PNG) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    }
    if ($imgt) {
        $old_image = $imgcreatefrom($img);
        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
        $imgt($new_image, $thumb_beforeword . $img);
    }
}

function upload_path($optional_name = NULL){
	$up = "./uploads";
	if(! file_exists($up)) {mkdir($up);};
	
	if($optional_name != NULL){
		$optional_name = format_path($optional_name);
		if(! file_exists($up."/".$optional_name))mkdir($up."/".$optional_name);
		$up .= "/".$optional_name."/";
	}
	return $up;
}

function number_to_kilo($number){
	return format_number($number/1000)."K";
}

function string_statusresv($s){
	$result = NULL;
	switch($s){
		case "1":
			$result = "Mennunggu Konfirmasi";
			break;
		case "2":
			$result = "Telah Dikonfirmasi";
			break;
		case "3":
			$result = "Telah Dikonfirmasi";
			break;
		default:
			$result = "Ditolak";
			break;
	}
	return $result;
}

function logcat($action, $dataval, $controller)
{
	$result = NULL;
	switch($action){
		case "create":
			$result = "Menambahkan %controller </br><a href='' role='button'>$dataval</a>";
			break;
		case "insert":
			$result = "Menambahkan %controller baru.</br><a href='' role='button'>$dataval</a>";
			break;
		case "update":
			$result = "Mengubah %controller <a href='#'>$dataval</a>";
			break;
		case "edit":
			$result = "Mengubah %controller <a href='#'>$dataval</a>";
			break;
		case "delete":
			$result = "Menghapus %controller <a href='#'>$dataval</a>";
			break;
		case "read":
			$result = "Melihat %controller <a href='#'>$dataval</a>";
			break;
		case "reservasi":
			$result = "Melakukan %controller kamar <a href='#'>$dataval</a>";
			break;
		case "konfirmasi":
			$result = "Mengkonfirmasi %controller Kamar <a href='#'>$dataval</a>";
			break;
		case "tolak":
			$result = "Menolak %controller Kamar <a href='#'>$dataval</a>";
			break;
		default:
			$result = "Online";
			break;
	};
	switch(strtolower($controller)){
		case "petugas":
			$result = str_replace("%controller","Akun",$result);
			break;
		case "pelanggan":
			$result = str_replace("%controller","data tamu",$result);
			break;
		case "kamar":
			$result = str_replace("%controller","kamar",$result);
			break;
		case "pengeluaran":
			$result = str_replace("%controller","Data Pengeluaran keterangan ",$result);
			break;
		case "tamu":
			$result = str_replace("%controller","Data Kamar ",$result);
			$result .=  " yang sedang digunakan tamu.";
		case "akun":
			$result = str_replace("%controller","Data akun ",$result);
			break;
		case "bank":
			$result = str_replace("%controller","Data ",$result);
			break;
		default:
			$result = str_replace("%controller",$controller,$result);
			break;
	}
	return $result;
};

function timelog($date, $jam, $detailed=FALSE)
{
	if(trim($date)==NULL||trim($jam)==NULL){return NULL;};
	$tanggal = format_date($date);
	$lastactivity=0;
	$d = substr($tanggal,0,2);
	$m = substr($tanggal,3,2);
	$Y = substr($tanggal,6,4);
	$H = substr($jam,0,2);
	$i = substr($jam,3,2);
	if($Y>=date("Y")){
		if($m>=date("m")){
			if($d>=date("d")){
				if($H>=date("H")){
					if($i>=date("i")){
						$lastactivity = "Baru saja";
					}else{
						$lastactivity = (date("i") - $i) . " Menit yang lalu";
					}
				}else{
					if($detailed===TRUE){
						if($i==date("i")){
							$lastactivity = (date("H") - $H) . " Jam yang lalu";
						}else{
							$lastactivity = (date("H") - $H) . " Jam " . (date("i") - $i) . " Menit yang lalu";
						}
					}else{
						$lastactivity = (date("H") - $H) . " Jam yang lalu";
					}
				}
			}else{
				if($detailed===TRUE){
					if($H==date("H")){
						$lastactivity = (date("d") - $d) . " Hari yang lalu";
					}else{
						$lastactivity = (date("d") - $d) . " Hari " . (date("H") - $H) . " Jam yang lalu";
					}
				}else{
					$lastactivity = (date("d") - $d) . " Hari yang lalu";
				}
			}
		}else{
			if($detailed===TRUE){
				if($d==date("d")){
					$lastactivity = (date("m") - $m) . " Bulan " . (date("d") - $d) . " Hari yang lalu";
				}else{
					$lastactivity = (date("m") - $m) . " Bulan yang lalu";
				}
			}else{
				$lastactivity = (date("m") - $m) . " Bulan yang lalu";
			}
		}
	}else{
		if($detailed===TRUE){
			$lastactivity = $tanggal . " " . $jam;
		}else{
			$lastactivity = $tanggal;
		}
	};

	return $lastactivity;
}

function format_path($path){
	$res = trim($path);
	if(trim($path) == NULL){
		return NULL;
	}else{
		$checkstartslash = TRUE;
		while ($checkstartslash == TRUE) {
			// do loop for checking the start slash,
			// there are posibility more than 1 slash at the begining string
			if(substr($res, 0, 1)=="/" || substr($res, 0, 1)=="\\"){
				$res = substr($res, 1);
			}else{
				$checkstartslash = FALSE;
			};
		}
		
		$res = str_replace("\\", "/", $res);
		$res = str_replace("//", "/", $res);
		$res = str_replace("\\\\", "/", $res);
	}
	return $res;
}

function format_number($number){
	$result = $number;
	if(strpos($number, ",")!==FALSE && strpos($number, ".")!==FALSE){
		$iComa = max(strpos($number, ","), strpos($number, "."));

		$result = substr($number, 0, $iComa);
	}else if(strpos($number, ",")===FALSE && strpos($number, ".")===FALSE){
		$result = number_format($number);
	}
	
	$result = str_replace(",", ".", $result);

	return $result;
}

function set_timezone($zone = 'Asia/Jakarta'){
	date_default_timezone_set($zone);
}

function format_date($date, $separator = "-"){
	if(trim($date)==NULL){return NULL;};
	$c = array();
	$d=NULL;
	$m=NULL;
	$Y=NULL;
	$sprtr = NULL;

	if(strpos($date, "-")!==FALSE){
		$c = explode("-", $date);
	}else{
		$c = explode("/", $date);
	};

	if(strlen($c[0]) >= 4){
		$d = $c[2];
		$m = $c[1];
		$Y = $c[0];
	}else if($c[1] >= 13){
		$d = $c[1];
		$m = $c[0];
		$Y = $c[2];
	}else{
		return $date;
	}

	return $d.$separator.$m.$separator.$Y;
}

function get_year($date){
	if(trim($date)==NULL){return NULL;};
	$res = NULL;
	$arrd = NULL;
	if(strpos($date, "-")!==FALSE){
		$arrd = explode("-", $date);
	}else{
		$arrd = explode("/", $date);
	};

	if(strlen($arrd[0]) >= 4){
		$res = $arrd[0];
	}else if($arrd[1] >= 13){
		$res = $arrd[2];
	}else{
		$res = $arrd[2];
	}
	
	return $res;
}

function get_month($date){
	if(trim($date)==NULL){return NULL;};
	$res = NULL;
	$arrd = NULL;
	if(strpos($date, "-")!==FALSE){
		$arrd = explode("-", $date);
	}else{
		$arrd = explode("/", $date);
	};

	if(strlen($arrd[0]) >= 4){
		$res = $arrd[1];
	}else if($arrd[1] >= 13){
		$res = $arrd[0];
	}else{
		$res = $arrd[1];
	}
	
	return $res;
}

function get_date($date){
	if(trim($date)==NULL){return NULL;};
	$res = NULL;
	$arrd = NULL;
	if(strpos($date, "-")!==FALSE){
		$arrd = explode("-", $date);
	}else{
		$arrd = explode("/", $date);
	};

	if(strlen($arrd[0]) >= 4){
		$res = $arrd[2];
	}else if($arrd[1] >= 13){
		$res = $arrd[1];
	}else{
		$res = $arrd[0];
	}
	
	return $res;
}

function get_day($date){
	if($date==NULL){return NULL;};
	
	$result = NULL;
	switch (date("w", mktime(0, 0, 0, get_month($date), get_date($date), get_year($date)))) {
		case '0':
			$result="Minggu";
			break;
		case '1':
			$result="Senin";
			break;
		case '2':
			$result="Selasa";
			break;
		case '3':
			$result="Rabu";
			break;
		case '4':
			$result="Kamis";
			break;
		case '5':
			$result="Jumat";
			break;
		case '6':
			$result="Sabtu";
			break;
		default:
			$result=NULL;
			break;
	};
	return $result;
};

function date_passed($date, $onequal = 1){
	if($date == NULL){return FALSE;};
	$date = format_date($date);

	$dY = date("Y");
	$dM = date("m");
	$dd = date("d");
	$nY = get_year($date);
	$nM = get_month($date);
	$nd = get_day($date);

	if($dY > $nY){return "1";};
	if($dM > $nM && $dY == $nY){return "1";};
	if($dd > $nd && $dM == $nM && $dY == $nY){return "1";};
	if($onequal == TRUE && $dd == $nd && $dM == $nM && $dY == $nY){return "1";};
	return "0";
}

function str_sentence($str){
	if($str==NULL) return NULL;
	$c = explode(" ", $str);
	$res = NULL;
	foreach ($c as $value) {
		if(strpos($value, "-")!==FALSE){
			$temp = explode("-", $str);
			foreach ($temp as $v) {
				if($v != NULL) $res .= strtoupper(substr($v, 0,1)).strtolower(substr($v, 1))."-";
			}
			$res = substr($res, 0, strlen($res) - 1);
		}else{
			$res .= strtoupper(substr($value, 0,1)).strtolower(substr($value, 1))." ";
		}
	};
	$res = trim($res);
	return $res;
};

function str_shortened($str, $lenght = 15, $ext = "..."){
	$res = NULL;
	if(strlen($str)>$lenght){
		$res = substr($str, 0, $lenght).$ext;
	}else{
		$res = $str;
	}
	return $res;
}

function increase_date($date, $increament){
	$d = strtotime("+$increament day", strtotime(get_year($date)."-".get_month($date)."-".get_day($date)));
	return date("d-m-Y", $d);
}

function escape_chars($text){
	$s = str_replace("\'", "", $text);
	$s = str_replace("\"", "", $text);
	$s = str_replace("\\", "", $text);
	$s = str_replace("'", "", $text);
	return $s;
}

function format_coma($t, $i=1){
	if($t==NULL)return 0;
	$arr = explode(".", format_number($t));
	$l = 0;
	if(count($arr)>=2){
		$l = $arr[1];
		if(strlen($l) > $i)$l = substr($l, 0, $i);
	};
	return $arr[0].".".$l;
}