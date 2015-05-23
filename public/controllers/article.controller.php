<?
class Article {
	
	/**
	* @str chuỗi giá trị nhập vào
	* @len số ký tự muốn lấy
	*/
	function subText($str, $len){
	$str = trim($str);
	  if (strlen($str) <= $len) return $str;
	  $str = substr($str, 0, $len);
	  if ($str != "") {
	      if (!substr_count($str, " ")) return $str." ...";
	      while (strlen($str) && ($str[strlen($str) - 1] != " ")) $str = substr($str, 0, -1);
	      $str = substr($str, 0, -1)." ...";
	  }
	  return $str;
	}

	function removeTag($text){
		return strip_tags($text);
	}
    function removeTagHtml($string){
        $string = preg_replace ('/<script.*?\>.*?<\/script>/si', ' ', $string);
        $string = preg_replace ('/<style.*?\>.*?<\/style>/si', ' ', $string);
        $string = preg_replace ('/<.*?\>/si', ' ', $string);
        $string = str_replace ('&nbsp;', ' ', $string);
        $string = html_entity_decode ($string);
        return $string;
    }

	public function breadcrum($table1,$table2,$id_field_tb1,$id_field_tb2,$id_field_get,$pos_id,$parent_id_tb2){	

	$detail = new db_query("SELECT * FROM ".$table1." INNER JOIN ".$table2." ON ".$id_field_tb1." = ".$id_field_tb2." WHERE ".$id_field_get." = ".$pos_id);
	$row = mysql_fetch_assoc($detail->result);	
		$Post = new db_query("SELECT * FROM ".$table1." WHERE ".$id_field_get." = ".$pos_id);
		$rowp = mysql_fetch_assoc($Post->result);
		$Cat = new db_query("SELECT * FROM ".$table2." WHERE ".$id_field_tb2." = ".$row[$id_field_tb2]);
		$row2 = mysql_fetch_assoc($Cat->result);
		$parent = $row2[$parent_id_tb2];
		$id = $row2[$id_field_tb2];
		$Menu = new menu();
		return $this->result = $Menu->getAllParent($table2,$id_field_tb2,$parent_id_tb2,$id);
	}

	public function multimenu($data, $parent){
      echo '<ul class="dropdown-menu">';
      foreach ($data as $value) {
      	$ncat = $this->removeTitle($value['cat_name']);
         if($value['cat_parent_id'] == $parent){
            echo '<li class="c1"><a href="http://'.$_SERVER['HTTP_HOST'].'/c'.$value['cat_id'].'-'.$ncat.'/">'.$value['cat_name'].'</a>';
            $id = $value['cat_id'];
            $this->submenu($data, $id);
            echo '</li>';
         }
      }
      echo '</ul>';
   }

   public function submenu($data, $parent){
      echo '<ul class="submenu">';
      foreach ($data as $value) {
      	$ncat = $this->removeTitle($value['cat_name']);
         if($value['cat_parent_id'] == $parent){
            echo '<li><a href="http://'.$_SERVER['HTTP_HOST'].'/c'.$value['cat_id'].'-'.$ncat.'/" class="c1">'.$value['cat_name'].'</a>';
            $id = $value['cat_id'];
            $this->submenu($data, $id);
            echo '</li>';
         }
      }
      echo '</ul>';
   }

   public function removeTitle($string, $keyReplace = "-", $keySearch = "/"){
	  $string = removeAccent($string);
	  $string =  trim(preg_replace("/[^A-Za-z0-9]/i"," ",$string)); // khong dau
	  $string =  str_replace(" ",$keyReplace,$string);
	  $string = str_replace($keyReplace . $keyReplace,$keyReplace,$string);
	  $string = str_replace($keyReplace . $keyReplace,$keyReplace,$string);
	  $string = str_replace($keyReplace . $keyReplace,$keyReplace,$string);
	  $string = str_replace($keyReplace . $keyReplace,$keyReplace,$string);
	  $string = str_replace($keyReplace . $keyReplace,$keyReplace,$string);
	  $string = str_replace($keyReplace . $keyReplace,$keyReplace,$string);
	  $string = str_replace($keySearch,$keyReplace,$string);
	  return strtolower($string);
	}				 

	public function removeAccent($mystring){
	   $marTViet=array(
	      // Chữ thường
	      "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	      "è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	      "ì","í","ị","ỉ","ĩ",
	      "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	      "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	      "ỳ","ý","ỵ","ỷ","ỹ",
	      "đ","Đ","'",
	      // Chữ hoa
	      "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	      "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	      "Ì","Í","Ị","Ỉ","Ĩ",
	      "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	      "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	      "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	      "Đ","Đ","'"
	      );
	   $marKoDau=array(
	      /// Chữ thường
	      "a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
	      "e","e","e","e","e","e","e","e","e","e","e",
	      "i","i","i","i","i",
	      "o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
	      "u","u","u","u","u","u","u","u","u","u","u",
	      "y","y","y","y","y",
	      "d","D","",
	      //Chữ hoa
	      "A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
	      "E","E","E","E","E","E","E","E","E","E","E",
	      "I","I","I","I","I",
	      "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
	      "U","U","U","U","U","U","U","U","U","U","U",
	      "Y","Y","Y","Y","Y",
	      "D","D","",
	      );
	   return str_replace($marTViet, $marKoDau, $mystring);
	}	
	public function fix($str) {
		return str_replace("'", "\'", $str);
	}
}


// class phân trang
class pagination {
	public $page;
	public $totalPage;
	public $totalRow;
	public $rowPerPage;
	public $firstRow;
	
	function totalRow($table_name,$mem_id){
		$Page = new db_query("SELECT * FROM ".$table_name." WHERE pos_mem_id =".$mem_id);
		$this->totalRow = mysql_num_rows($Page->result);
	}
	function totalPage($rowPerPage){
			return $this->totalPage = ceil($this->totalRow/$rowPerPage);
	}
	function firstRow($page, $rowPerPage){
		$this->firstRow = $page * $rowPerPage;
		return $this->firstRow;
	}
	function page(){		
		if(isset($_GET['page'])){
			$this->page = $_GET['page'];
		}
		else{
			$this->page = 0;	
		}
		return $this->page;
	}

}

?>