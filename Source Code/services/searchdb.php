<?php 
include('config.php');
      require_once('fungsidb.php');
      require_once ("fungsisave.php"); 
      //include()
// if($_GET['act'] == 'grab')
// {
// 	$kategori = mysql_real_escape_string($_GET['kat']);
// 	if(!$kategori_id = kategori_exists($kategori)) //cek kategori ada/tidak di DB
// 	{
// 		die('kategori tidak ada');
// 	}

// 	//declare kategori
// 	$program = mysql_real_escape_string($_GET['pro']);
// 	if(!$prodi_id = program_exists($program)) //cek kategori ada/tidak di DB
// 	{
// 		die('kategori tidak ada');
// 	}

// 	//declare kategori
// 	$negara = mysql_real_escape_string($_GET['neg']);
// 	if(!$negara_id = negara_exists($negara)) //cek kategori ada/tidak di DB
// 	{
// 		die('kategori tidak ada');
//     //$negara_id = NULL;
// 	}

// // $kat = "sarjana";
// // $pro = "Economics";
// // $neg = "Australia";

// 	$kat = $_GET['kat'];
// 	$pro = $_GET['pro'];
// 	$neg = $_GET['neg'];
// 	$tipe = $_GET['tipe'];
// 	$dead = $_GET['deadline'];
// 	$page = $p;
// 	$jmlh_page = $p1;
// 	$update = $_GET['update'];

// 	//VERSI UPDATE (PENCARIAN MENGGUNAKAN DATABASE ATAU YQL)
// 	if($update == '0'){
// 		//$grab = new dbsearch($web, $kat, $page, $jmlh_page);
// 		//$link = $grab->routing();
// 		/* kode untuk mencari dan menampilkan */
// 		//$beasiswa = filtersearch($kategori_id,$prodi_id,$negara_id);
// 		$beasiswa = filtersearch($kategori_id,$prodi_id,$negara_id,$tipe,$dead);
//     //$beasiswa = filtersearch($kategori_id,$prodi_id,$neg,$tipe,$dead);

// 		//header('Content-type: application/json');
// 		echo '{"items":'.json_encode($beasiswa).'}';
// 	}

// 	elseif($update == '1'){
// 	  	$grab = new yqlsearch($kat,$pro,$neg);
// 	    $link = $grab->routing(2);
// 	    $cetak = count($link);
// 	    //echo $cetak;
// 	    if(count($link) > 0){    
// 	    for ($row = 0; $row < count($link); $row++)
// 	      {
// 	        // echo $link[$row]['domain'];
// 	        // echo "<br/>";
// 	          //save_konten($link[$row]['domain'],$link[$row]['id_domain'],$link[$row]['judul'], $link[$row]['deadline'], $link[$row]['jenjang'], $link[$row]['jurusan'], $link[$row]['negara'], $link[$row]['univ'],$link[$row]['konten'],$link[$row]['tipe'],$link[$row]['penyedia']);
// 	          save_kontenx($link[$row]['domain'],$link[$row]['id_domain'],$link[$row]['judul'], $link[$row]['deadline'],$link[$row]['jenjang'],$link[$row]['jurusanid'], $link[$row]['jurusan'], $link[$row]['negara'], $link[$row]['univ'],$link[$row]['konten'],$link[$row]['tipe'],$link[$row]['penyedia'],$link[$row]['pick'],$link[$row]['picb']);
	           
//              //save_kontenz($link[$row]['domain'],$link[$row]['id_domain'],$link[$row]['judul'], $link[$row]['deadline'],$link[$row]['jenjang'],$link[$row]['jurusanid'], $link[$row]['jurusan'], $link[$row]['negara'],$link[$row]['negara2'], $link[$row]['univ'],$link[$row]['konten'],$link[$row]['tipe'],$link[$row]['penyedia'],$link[$row]['pick'],$link[$row]['picb'],$link[$row]['openfor']);
//               //save _img($result['image'],$imgName);
	          
// 	          //echo "sukses";
// 	      }

// 	    $beasiswa = filtersearch($kategori_id,$prodi_id,$negara_id,$negara_id,$tipe,$dead);
// 		//$sukses = "sukses";
// 		header('Content-type: application/json');
// 		echo '{"items":'.json_encode($beasiswa).'}';
// 	    }
// 	}
// 	else{
// 	      die("tidak ada url satu pun");
// 	}
// }

// class yqlsearch
// {
  
//   public $web;
//   public $page;
//   private $jur;
//   private $neg;
//   private $kat;
//   //public $page;
//   // public $jmlh_page;
//   // public $kat;
  
//   public function __construct($kat,$pro,$neg)
//   {

//     //untuk memanggil class simple html dom parser
//     //$this->html_parser = new simple_html_dom(); 
//     $this->web = "1";
//     $this->kat = $kat;
//     //$this->jur = $jur;
//     $this->jur = str_replace(" ","%20", $pro);
//      //$this->jur = $pro;
//     //$this->neg = $neg;
//     $this->neg = str_replace(" ","%20", $neg);
//     //$this->neg =$neg;
    
//   }
  
//   public function routing($i)
//   {
//     ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36');
//     ini_set('max_execution_time', 0);
//     ini_set('max_input_time', 0);
  
//     ini_set('memory_limit', '1024M');
//     set_time_limit(0);
    
//     // if($i == 1){
//     //   //$this->alamat_website_kategori(1)
//     //   $result = $this->scholarshipdb();
//     // }
//     if($i == 2)
//     {
//       $result = $this->scholarpos();
//     }
//     else
//     {
//       die("situs tidak terdaftar");
//     }
//     return $result;
//   }

// public function scholarpos()
//   {
  $kat = "Sarjana";
//   // //$kat = $_GET['kat'];
    $jur = "Economics";
    $neg = "Australia";
    $page = 1;
    $jmlh_page = 2;
    //$result = array(array('domain'=>'','id_domain'=>'','judul'=>'','deadline'=>'','jenjang'=>'','jurusan'=>'','negara'=>'','univ'=>'','konten'=>'','tipe'=>'','penyedia'=>'','openfor'=>'','pick'=>'','picb'=>''));
     $info = array(array('domain'=>'','id_domain'=>'','judul'=>'','deadline'=>'','jenjang'=>'','jurusan'=>'','negara'=>'','negara2'=>'','univ'=>'','konten'=>'','tipe'=>'','penyedia'=>'','openfor'=>'','pick'=>'','picb'=>''));
    //$result = array(array('domain'=>'','alamat'=>'','judul'=>'','deadline'=>'','univ'=>'','negara'=>'','konten'=>'','jurusan'=>'','thumb'=>'','image'=>''));
    
  //   while($page<=$jmlh_page)
  //   {
      
  //     //if($kat == 'Sarjana')
  //       if($kat == 'Sarjana')
  //     {
  //       //if($this->jur!== null || $this->neg!== null){
  //       $url = array();
  //       for ($i = 1; $i <= $page; ++$i) {
  //           $url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Undergraduate?q=".$jur."$l=".$neg."&page=" .$i. "&st=listed'";
  //           //$url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Undergraduate?q=".$this->jur."$l=".$this->neg."&page=" .$i. "&st=listed'";
  //       }
  //         $query = "select * from html where url in (" . implode(', ', $url) . ") and xpath='//*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[1]/h4 | //*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[2]/*'";
  //         $url = 'http://query.yahooapis.com/v1/public/yql?format=json&q=' . urlencode($query);

  //         //set up the cURL
  //         $c = curl_init();
  //         curl_setopt($c, CURLOPT_URL, $url);
  //         curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  //         curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  //         curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
           
  //         // execute the cURL
  //         $rawdata = curl_exec($c);
  //         curl_close($c);
           
  //         // Convert the returned JSON to a PHP object
  //         $data = json_decode($rawdata);
  // // Show us the data
  //   // echo "<pre>\n";
  //   // print_r($data) . "\n";
  //   // echo "</pre>";
  //     $sch = $data->query->results->h4;
  //           $univ = $data->query->results->span;
                
  //         // $sch = $data->query->results->h4;
  //         //   $univ = $data->query->results->span;
                
  //         for ($i=0; $i< count($sch); $i++){  
  //                 $url2 = $sch[$i]->a->href;
  //           $link0 = stripslashes($url2);
  //           $result[$i]['domain'] = $link0;
           $link0 = '/scholarships-in-Australia/Flinders-University-Ra-Simpson-International-Scholarship-Flinders-University=WoQ583MG5RGUNwAlkGUTnw.html';
            // $link2 = '\'/scholarships-in-United-Kingdom/Economics-Esrc-Funded-Ph-D-Studentship-Labour-Economics-Swansea-University=PIiQ2t3f5BGUNgAlkGUTnw.html/\'';

            $list = array(
            "satu" => "SELECT * from html WHERE url=\'http://scholarshipdb.net/".$link0."\' AND xpath=\'//div[@class=\"position-details\"]/div[1] | //div[@class=\"position-details\"]/div[@class=\"row\"]/div[1]//a | //div[@class=\"position-details\"]/div[3]/span\'",
            "dua" => "SELECT * from htmlstring WHERE url=\'http://scholarshipdb.net/".$link0."\' AND xpath=\'//div[@class=\"description\"]/div[1]/div[1]\'"
            ); 
            // Tampilan QUERY selengkapnya
            $query = "SELECT * FROM yql.query.multi WHERE queries='" . implode(';', $list) . "'";
            $yqlurl = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query);
            $yqlurl .= "&format=json";
            $yqlurl .="&env=http://datatables.org/alltables.env";

            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $yqlurl);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
             
            // // execute the cURL
            $rawdata = curl_exec($c);
            curl_close($c);
            //$new = strip_tags($rawdata);
            $data = json_decode($rawdata);

            // // Show us the data
            // echo "<pre>\n";
            // print_r($data) . "\n";
            // echo "</pre>";

            //$result[$i]['domain'] = $this->alamat_website_kategori(1);
            $id_url = "1";
            $result[$i]['id_domain'] = $id_url;

            //ARRAY OBJECT TIAP DATA
            $judul = $data->query->results->results[0]->div->h1->content;
            $judul2 = mysql_escape_string($judul);
            $result[$i]['judul'] = $judul2;

            $univ2 = array();
            $univ = $data->query->results->results[0]->a[0]->content;
            $univ2[] = mysql_escape_string($univ);
            $result[$i]['univ'] = $univ2;
            $result[$i]['penyedia'] = $univ2;

           
            $negarauniv2 = array();
            $negarauniv = $data->query->results->results[0]->a[1]->content;
            $negarauniv2[] = mysql_escape_string($negarauniv);
            $result[$i]['negara'] = negaraid($negarauniv2,$id_url);
            $result[$i]['negara2'] = $negarauniv2;

            $isi = $data->query->results->results[1]->result;
            $isi2 = mysql_escape_string($isi);
            //$isi3 = strip_tags($isi2,"<div><b><p><br>");
            //$result[$i]['konten'] = $isi2;
            



            //$result[$i]['domain'] = $this->alamat_website_kategori(1);
            // $id_url = "1";
            // $result[$i]['id_domain'] = $id_url;

            //CEK JENJANG
            $jen = array();
            $jen2 = array();
            
            $jen2[] = $kat;
             preg_match_all("#\b(magister|master(s)*|bachelor|diploma|doktor|doctoral|phd|postgraduate|undergraduate|mba|msc)\b#i",$isi,$data1);
              foreach(array_unique($data1[0]) as $value) {
                if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                  $jen[] = "Master";
                }
                elseif(preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                  $jen[] = "Sarjana";     
                }
                elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/phd/i",$value,$cetak) || preg_match("/\bdoktor\b/i",$value,$cetak)){
                  $jen[] = "Doktor";     
                }
              
                
              }
              /*JADIKAN ARRAY ATAU KOMA*/
                    $cekj = array_values(array_unique(array_merge($jen,$jen2)));
                    //$result[$i]["jenjang"] = $cekj;
                    $result[$i]["jenjang"] = jenjangid($cekj);
            
            //CEK JURUSAN ID DAN NAMA JURUSAN
            $jurcekz = str_replace("%20"," ",$jur);
            $jurcekx = cekjurusan($jurcekz,$id_url);
            
            $jurcek = cekjurusan($isi,$id_url);
            $jurfix = array_values(array_unique(array_merge($jurcek,$jurcekx)));
            $jurnam = jurcon($jurfix,$id_url);
            $cekju = jurusanid($jurfix,$id_url);
            $result[$i]["jurusanid"] = $cekju;
            $result[$i]["jurusan"] = $jurfix;
            //$result[$i]['jurusan'] = $jurnam;
            

            //CEK DEADLINE
            $my_date2 = array();
            $deadlinex = array();
            
            $deadline = $data->query->results->results[0]->span[2]->content;
            $deadline2 = mysql_escape_string($deadline);

            preg_match_all("#\bclosing date:([^\n]+)\b#i",$isi2,$data6);
            foreach(array_unique($data6[0]) as $valueX) {
                  //if(preg_match_all("/\b(any|course)\b/i", $find,$valuex2)){
                    //$valuex2 = "semua";
                 //$val= mysql_real_escape_string($valueX);
                    // $jurusan[] = mysql_real_escape_string((strtolower($valueX)));
                 $val =strtolower($valueX);
                 $value2 = ltrim(str_replace(array("closing",":","\n","\r","date","dates"," "),".",$val));
                      $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                      $valuex4 = str_replace("."," ", $valuex2);
                        $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                        $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                        $valuex7 =array_shift(explode('\n', $valuex6));
                        $cekdate = date('Y-m-d',strtotime($valuex7));
                        $arr[] = $cekdate;

                        $valuex8 =array_shift(explode('.', $valuex6));
                         //$valuex8 = str_replace(array("\t", "\n"), "", $valuex7);
                        $valuex9 =explode('\n', $valuex8);
                        foreach ($valuex9 as $key => $value) {
             
                        preg_match_all("#\b([0-9]|[1-2][0-9]|3[0-1])(th|rd|st)*\s*(january|febuary|march|april|may|june|july|august|september|october|november|desember)\s*(2015)*\b#i",$value,$data6);
                        //if(count($data6)>0){
                        foreach(array_unique($data6[0]) as  $valueX) {
                            $cekdate = $valueX;
                            $date = date('Y-m-d',strtotime($cekdate));     
                         }
                        } 
                        
                        $arr2[] = $date;
                        $cek[] = array_merge($arr,$arr2);
                         $result[$i]['deadline2'] = array_merge($arr,$arr2);
                    //}     
                  }
                //}
            //} 

            if(!empty($deadline2)){
              //foreach ($deadline2 as $value) {
                    $split = preg_split('/\s+/', $deadline2);
                    //echo $split ."<br>";
                    $joinx = implode("-", $split);
                    //echo $join;
                    $hapus = ltrim(str_replace(array("Deadline","-",":")," ",$joinx));
                    //echo $hapus;
                    $my_date2 = date('Y-m-d',strtotime($hapus));
                    //echo $my_date;
                    $result[$i]['deadline'] =$my_date2;
                //}
              }
              //$cekdate = date('Y-m-d',strtotime($hapus));    
            else{
            foreach ($cek as $key => $value) {
              //$cex='1970-01-01';
              foreach ($value as $val) {
                echo $val ."<br/>";
                if(!empty($val) && $val!=='1970-01-01'){
                $result[$i]["deadline"] = $val;
              }
              }
              
            }
             //$result[$i]["deadline"] = array_unique(array_merge($deadlinex,$deadline2));
          }

        //   if(!empty($deadline)){
        // foreach ($deadline as $value) {
        //       $split = preg_split('/\s+/', $value);
        //       echo $split ."<br>";
        //       $join = implode("-", $split);
        //       //echo $join;
        //       $hapus = str_replace(array("is","-")," ",$join);
        //       //echo $hapus;
        //       $my_date[] = date('Y-m-d',strtotime($hapus));
        //       //echo $my_date;
        //   }
        // }


            $tipe = array();
             preg_match_all("#(scholarship|studentship|fellowship)#i",$isi,$data);
              foreach(array_unique($data[0]) as $valuey) {
                if(preg_match("/\bscholarship\b/i",$valuey,$cetak)){
                  $tipe[] = "Beasiswa";
                }
                if(preg_match("/fellowship/i",$valuey,$cetak)) {
                  $tipe[] = "fellowship";
                }
                if(preg_match("/studentship/i",$valuey,$cetak)) {
                  $tipe[] = "studentship";
                }
               // echo $valuey;
                
              }
            $ceko = array_unique($tipe);
            $result[$i]["tipe"] = $ceko;



            

             //CEK GAMBAR
            $result[$i]['pick'] = 'thumb3.jpg';
            $result[$i]['picb'] = 'i3.jpg';


             $open = array();
             // preg_match_all("#(Aboriginal|australian|Indigenous|international)*\s*(citizen|citizens|descent|scholarship|students|applicants|candidates)#i",$isi,$data);
             preg_match_all("#\b(international|overseas)*\s*(citizen|citizens|descent|scholarship|students|applicants|candidates)\b#i",$isi,$data);
              foreach(array_unique($data[0]) as $valuey) {
                // if(preg_match("/\binter\b/i",$valuey,$cetak)){
                //   $tipe[] = "Beasiswa";
                // }
                if(preg_match("/(international|overseas)/i",$valuey,$cetak)) {
                  $open[] = "semua negara";
                }
                // if(!preg_match("/international/i",$valuey,$cetak)) {
                else{
                  $open[] = "native";
                }
               // echo $valuey;   
              }
           

            $result[$i]['openfor'] = array_unique($open);
            //$jurnew2 = mysql_escape_string($jurnew);
            
            //$result[$i]['jurusan'] = $this->jur; 
            /*CEK DATA*/
            echo "<pre>\n";
            echo "<h1>ini s2</h1>\n";
            print_r($result) ."\n";
            echo "</pre>";      
  //         }//end for
  //         //return $result;
  //       }//end if s1
  //         $page++;
      
  // }//end while
//   return $result;
// }//end function
// }//end cllass
?>
