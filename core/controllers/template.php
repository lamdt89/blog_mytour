<?php

/** 
 * Class template
 * NQH - 20140917
 * Get path theme, load js, css...
 **/

class Template_v2 {
   /** path theme **/
   public   $path_theme;
   /** charset **/
   public   $charset       =  '';
   /** meta tag **/
   public   $meta_tag      =  '';
   /** meta property **/
   public   $meta_property =  '';
   /** meta other **/
   public   $meta_other    =  '';
   /** load js, css head **/
   public   $load_head     =  '';
   /** load js footer **/
   public   $load_footer   =  '';
   /** Default CSS **/
   public   $default_css   =  array('mytour.main');
   /** Default JS **/
   public   $default_js_head     =  array('jquery');
   public   $default_js_footer   =  array('mytour.min');
   
   /**
    * Template::Template()
    * Init class
    * @param boolean $check_index
    * @return void
    */
   function Template() {
      //Get exactly folder
      $get_path   =  '/';
      if (getURL(0, 1, 0, 0) == '/index.php') $get_path  =  '';
      
      $this->path_theme =  $get_path . 'themes/';
      
   }
   
   /**
    * Template::pathCSS()
    * NQH
    * @return string path css
    */
   function pathCSS() {
      return $this->path_theme . 'css/';
   }
   
   /**
    * Template::pathJS()
    * NQH
    * @return string path j
    */
   function pathJS() {
      return $this->path_theme . 'js/';
   }
   
   /**
    * Template::pathImage()
    * NQH
    * @return string path image
    */
   function pathImage() {
      return $this->path_theme . 'images/';
   }
   
   
   /**
    * Template::loadHead()
    * NQH - 20140917
    * @return string load js and css
    */
   function loadHead() {
      $str_load   =  $this->setMetaCharset();
      $str_load   .= $this->setFavicon();
      //$this->setMetaTag();
      //$this->setMetaProperty();
      $str_load   .= $this->meta_tag;
      $str_load   .= $this->meta_property;
      $str_load   .= $this->meta_other;
      //Start
      $str_load   .= '<link type="application/rss+xml" title="Mytour.vn - Đặt phòng khách sạn trực tuyến tại Việt Nam" href="http://mytour.vn/vn/hotel/rss/" />';
      $str_load   .= '<script>var datepicker_regional = "vn";</script>';
      //Load head js and css
      $arr_load   =  array(
                           'js' => $this->default_js_head,
                           'css' => $this->default_css
                           );
      
      //Load
      foreach ($arr_load as $type => $arr_file) {
         switch ($type) {
            case 'js':
               foreach ($arr_file as $file) {
                  $str_load   .= '<script type="text/javascript" src="' . $this->path_theme . 'js/' . $file . '.js"></script>';
               }
               break;
               
            case 'css':
               foreach ($arr_file as $file) {
                  $str_load   .= '<link rel="stylesheet" type="text/css" href="' . $this->path_theme . 'css/' . $file . '.css" />';
               }
               break;
         }
      }
      
      return $str_load;
   }
   
   /**
    * Template::setHead()
    * NQH
    * @param mixed $arr_load = array('js' => array(file1, file2), 'css' => array(file1, file2))
    * @return
    */
   function setHead($add_file = array()) {
      //Add js and css
      if (isset($add_file['js']) && !empty($add_file['js'])) $this->default_js_head    =  array_merge($this->default_js_head, $add_file['js']);
      if (isset($add_file['css']) && !empty($add_file['css'])) $this->default_css      =  array_merge($this->default_css, $add_file['css']);
   }
   
   
   /**
    * Template::setMetaTag()
    * NQH
    * @param mixed $arr_meta_tag ( array(title, keywords, description) ) )
    * @return
    */
   function setMetaTag($arr_meta_tag = array()) {
      
      $this->meta_tag   = '';
      
      //Default
      if (!isset($arr_meta_tag['title']) || $arr_meta_tag['title'] == '') {
         $arr_meta_tag['title']  =  'Đặt phòng khách sạn, resort hàng đầu tại Việt Nam - Mytour.vn';
      }
      if (!isset($arr_meta_tag['keywords']) || $arr_meta_tag['keywords'] == '') {
         $arr_meta_tag['keywords']  =  'dat phong khach san, đặt phòng khách sạn, dat phong khach san truc tuyen, đặt phòng khách sạn trực tuyến, dat phong resort, đặt phòng resort, dat phong resort truc tuyen, đặt phòng resort trực tuyến';
      }
      if (!isset($arr_meta_tag['description']) || $arr_meta_tag['description'] == '') {
         $arr_meta_tag['description']  =  'Hơn 5000 khách sạn, resort tại 63 tỉnh thành. TIẾT KIỆM ĐẾN 70%. 150.000 đánh giá từ khách hàng. HOÀN TIỀN NẾU KHÔNG HÀI LÒNG. Hỗ trợ qua điện thoại.';
      }
      
      //Generate meta tag
      $this->meta_tag .= '<title>' . $arr_meta_tag['title'] . '</title>';
      $this->meta_tag .= '<meta name="keywords" content="' . $arr_meta_tag['keywords'] . '" />';
      $this->meta_tag .= '<meta name="description" content="' . $arr_meta_tag['description'] . '" />';
      
      return $this->meta_tag;
   }
   
   /**
    * Template::setMetaProperty()
    * VDT
    * @param mixed $arr_meta_property ( array(og:title, og:type , og:image, og:url) )
    * @return
    */
   function setMetaProperty($arr_meta_property = array()) {
      
      $this->meta_property = '';
      
      if(count($arr_meta_property)){
         foreach($arr_meta_property as $key => $value){
            $this->meta_property .= $value;
         }
      }
      else{
         $this->meta_property .= '<meta property="og:title" content="Mytour.vn - Đặt phòng khách sạn, resort trực tuyến" />';
         $this->meta_property .= '<meta property="og:type" content="Hotel" />';
         $this->meta_property .= '<meta property="og:url" content="http://mytour.vn" />';
         $this->meta_property .= '<meta property="og:image" content="http://mytour.vn:8080/pictures/city/rtm1410926750.JPG" />';
      }
      
      return $this->meta_property;
   }
   
   /**
    * Template::setMetaCharset()
    * NQH
    * @return string charset head
    */
   function setMetaCharset() {
      
      $this->charset = '';
      
      $this->charset =  '<meta http-equiv="content-type" content="text/html;charset=utf-8" />';
      return $this->charset;
   }
   
   /**
    * Template::setFavicon()
    * NQH
    * @return
    */
   function setFavicon() {
      $favicon    =  '<link href="' . $this->pathImage() . 'favicon.ico" rel="icon" type="image/x-icon" />' . chr(13);
      $favicon    .= '<link href="' . $this->pathImage() . 'favicon.ico" rel="shortcut icon" />' . chr(13);
      
      return $favicon;
   }
   
   
   /**
    * Template::setFooter()
    * NQH - set js load footer
    * @param mixed $arr_file = array(file1, file2)
    * @return
    */
   function setFooter($arr_file = array()) {
      
      //Load default
      if (!empty($arr_file)) $this->default_js_footer =  array_merge($this->default_js_footer, $arr_file);
      
   }
   
   
   /**
    * Template::loadFooter()
    * NQH - 20140917
    * @return load js footer
    */
   function loadFooter() {
      //Load
      foreach ($this->default_js_footer as $file) {
         $this->load_footer   .= '<script type="text/javascript" src="' . $this->path_theme . 'js/' . $file . '.js"></script>';
      }
      //Return string load js and css
      return $this->load_footer;
   }
   
}