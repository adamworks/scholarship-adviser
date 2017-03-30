<?php 
include('config.php');
require_once('fungsisave.php');

  date_default_timezone_set('Asia/Jakarta'); 
  $jam = date("H:");
  $grab = new yqlsearch($jam);

  //if($a==7 && $a==)
    $link = $grab->routing(2);
    $cetak = count($link);
    //echo $cetak;
    if(count($link) > 0){ 
    for ($row = 0; $row < count($link); $row++)
      {
       
            // save_konten($link[$row]['domain'],$link[$row]['id_domain'],$link[$row]['judul'], $link[$row]['deadline'],$link[$row]['jenjang'],$link[$row]['jurusanid'], $link[$row]['jurusan'], $link[$row]['negara'],$link[$row]['negara2'], $link[$row]['univ'],$link[$row]['konten'],$link[$row]['tipe'],$link[$row]['penyedia'],$link[$row]['pick'],$link[$row]['picb'],$link[$row]['openfor']);
            //          save_konten($link[$row]['domain'],$link[$row]['id_domain'],$link[$row]['judul'], $link[$row]['deadline'],
            //               $link[$row]['jenjang'],$link[$row]['jurusanid'], $link[$row]['jurusan'], 
            //               $link[$row]['negara'],$link[$row]['negara2'], $link[$row]['univ'],$link[$row]['konten'],$link[$row]['tipe'],
            //               $link[$row]['penyedia'],$link[$row]['pick'],$link[$row]['picb'],$link[$row]['openfor'],
            //               $link[$row]['ibt'],$link[$row]['pbt'],$link[$row]['ielts'],$link[$row]['ipk'],$link[$row]['more_url']);

        // save_konten($link[$row]['domain'],$link[$row]['id_domain'],$link[$row]['judul'], $link[$row]['deadline'],$link[$row]['jenjang'],$link[$row]['jurusanid'], $link[$row]['jurusan'], $link[$row]['negara'],$link[$row]['negara2'], $link[$row]['univ'],$link[$row]['konten'],$link[$row]['tipe'],$link[$row]['penyedia'],$link[$row]['pick'],$link[$row]['picb'],$link[$row]['openfor']);
                     save_konten($link[$row]['domain'],$link[$row]['id_domain'],$link[$row]['judul'], $link[$row]['deadline'],
                          $link[$row]['jenjang'],$link[$row]['jurusanid'], $link[$row]['jurusan'], 
                          $link[$row]['negara'],$link[$row]['negara2'], $link[$row]['univ'],$link[$row]['konten'],$link[$row]['tipe'],
                          $link[$row]['penyedia'],$link[$row]['pick'],$link[$row]['picb'],$link[$row]['openfor'],
                          $link[$row]['sertifikat'],$link[$row]['more_url']);

      } 
    }
  else{
      die("tidak ada url satu pun");
    }

class yqlsearch
{
  private $time;
  
  /*versi Scrapping manual*/
  public $web;
  public $webx;
  // private $jur;
  // private $neg;
  // private $kat;
  
  // public $page;
  // public $jmlh_page;
  // public $kat;
  
  public function __construct($jam)
  {
    $this->time = $jam;
    
    /*versi Scrapping manual*/
    $this->web = "2";
    $this->webx = "4";
    // $this->kat = $kat;
    // //$this->jur = $jur;
    // $this->jur = str_replace(" ","%20", $pro);
    // //$this->neg = $neg;
    // $this->neg = str_replace(" ","%20", $neg);
    // $this->page = $page;
    // $this->jmlh_page = $jmlh_page;
    
  }

  public function routing($i)
  {
    ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36');
    ini_set('max_execution_time', 0);
    ini_set('max_input_time', 0);
  
    ini_set('memory_limit', '1024M');
    //set_time_limit(0);
    
    /*versi Scrapping manual*/
    // if($i == 1){
    //   //$this->alamat_website_kategori(1)
    //   $result = $this->scholarshipdb();
    // }

    if($i == 2)
    {
      $result = $this->scholarpos();
    }
    else
    {
      die("situs tidak terdaftar");
    }
    return $result;
  }

function jurlist($id){
  $namax = array();
   $sql = mysql_query("SELECT * FROM db_katjurusan");
   // $row = mysql_fetch_array($sql);
   // //$jurusanlist = $row['nama_jurusan_en'];
   // $jurusanlist[] = $row['nama_jurusan'];

    while($rowx = mysql_fetch_array($sql)){
      //echo $row['nama_jurusan']."\n";
      if($id==2){
        $namax[] = $rowx["nama_jurusan"];
      }
      else{
        $namax[] = $rowx["nama_jurusan_en"];
        
      }
  }
  return $namax;
}

public function scholarpos()
  {
    $info = array(array('domain'=>'','id_domain'=>'','judul'=>'','deadline'=>'','jenjang'=>'','jurusan'=>'','negara'=>'','negara2'=>'','univ'=>'','tipe'=>'','penyedia'=>'','openfor'=>'','pick'=>'','picb'=>'','konten'=>''));

    $list = array(
      "satu" => "SELECT * FROM html WHERE url=\'http://scholarship-positions.com/category/international-phd-programmes/\' AND xpath=\'//div[@class=\"blog-item-holder\"]/div//h2\'",
      "dua" => "SELECT * FROM html WHERE url=\'http://scholarship-positions.com/category/scholarship-for-indonesia/\' AND xpath=\'//div[@class=\"blog-item-holder\"]/div//h2\'",
      "tiga" => "SELECT * FROM html WHERE url=\'http://www.beasiswapascasarjana.com/search/label/dalam%20negeri?updated-max=2015-04-25T06%3A35%3A00%2B07%3A00&max-results=14/\' AND xpath=\'//div[@id=\"Blog1\"]/div/div[position()>2]//h3\'",
      "empat" => "SELECT * FROM html WHERE url=\'http://www.beasiswapascasarjana.com/search/label/jerman?max-results=14\' AND xpath=\'//div[@id=\"Blog1\"]/div/div[position()>2]//h3\'",
      "lima" => "SELECT * FROM html WHERE url=\'http://www.scholars4dev.com/category/target-group/asians-scholarships/southeast-asians-scholarships/page/2/\' and xpath=\'//div[@class=\"maincontent\"]/div[@class=\"post clearfix\"]/div/h2/a\'"
    );

     // Tampilan QUERY selengkapnya
    $query = "SELECT * FROM yql.query.multi WHERE queries='" . implode(';', $list) . "'";
    $url = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query);
    $url .= "&format=json";
    $url .="&env=http://datatables.org/alltables.env";

    //set up the cURL
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
             
    // execute the cURL
    $rawdata = curl_exec($c);
    curl_close($c);
             
    // Convert the returned JSON to a PHP object
    $data = json_decode($rawdata);
    
    // PRINT R DATA TAMPILKAN SEMUA STRUKTUR OBJEK
      // echo "<pre>\n";
      // print_r($data) . "\n";
      // echo "</pre>";
  
  /*BEASISWA S3 
  TAMBHAKAN FUNGSI CRONJOBS
  ATAU FUNGSI PENCARIAN MANUAL OLEH USER
  */
 $sch1 = $data->query->results->results[0]->h2;
 $sch2 = $data->query->results->results[1]->h2;
 $sch3 = $data->query->results->results[2]->h3;
 $sch5 = $data->query->results->results[4]->a;


    echo $this->time;
    $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
         "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
         
    $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
         "Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September",
         "Oktober","Nopember","Desember");

    $pick = array('thumb2.jpg','thumb1.jpg','thumb3.jpg');
    $picb = array('i2.jpg','i3.jpg','i5.jpg');

if($this->time==10){
  /*BEASISWA S3 TAMBHAKAN FUNGSI CRONJOBSATAU FUNGSI PENCARIAN MANUAL OLEH USER
  BAGIAN INI SEBAGAI PENANDA BATAS SCRAPPING DATA PADA WEBSITE BEASISWA
  SCHOLARSHIP POSITION
*/
for ($i=0; $i< count($sch1); $i++){  
            $url2 = $sch1[$i]->a->href;
            $judul = $sch1[$i]->a->content;

            $link0 = stripslashes($url2);
            $judul0 = stripslashes($judul);
            $info[$i]['domain'] = $link0;
            $info[$i]["id_domain"] = $this->webx;
            $id= $this->webx;
            $info[$i]["judul"] = $judul0;
            //$link0 = "http://scholarship-positions.com/uoit-global-leadership-award-international-students-canada/2015/05/29/";

            /*YQL TAHAP 2 DETAIL BEASISWA*/
            // $path = "http://query.yahooapis.com/v1/public/yql?q=";
            // $path .= urlencode("SELECT * FROM htmlstring WHERE url='$link0' AND xpath='//*[@class=\"single-content\"]/p'");
            // $path .= "&format=json";
            // $path .="&env=http://datatables.org/alltables.env";
            /*END YQL*/


            $list = array(
"satu" => "SELECT * FROM htmlstring WHERE url=\'$link0\' AND xpath=\'//div[@class=\"single-content\"]/p\'",
"dua" => "SELECT * FROM html WHERE url=\'$link0\' AND xpath=\'//div[@class=\"single-content\"]/p[last()]\'"
);
 
// Tampilan QUERY selengkapnya
$query = "SELECT * FROM yql.query.multi WHERE queries='" . implode(';', $list) . "'";
$path = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query);
            $path .= "&format=json";
            $path .="&env=http://datatables.org/alltables.env";

            /*CURL TAHAP 2 DETAIL*/
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $path);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
            $rawdata = curl_exec($c);
            curl_close($c);

            $data = json_decode($rawdata);
            /*END CURL*/

            // Show us the data
            //echo "<pre>\n";
            //print_r($data);
            //echo "</pre>";

            //$find = $data->query->results->result;

            $find = $data->query->results->results[0]->result;
            $url_info = $data->query->results->results[1]->p->a->href;
            $info[$i]["more_url"] = $url_info;

    /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*0. Mencari tipe beasiswa*/
            $tipe = array();
             preg_match_all("#(scholarship|studentship|fellowship)#i",$find,$data);
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
                echo $valuey;
                
              }
            $ceko = array_unique($tipe);
            $info[$i]["tipe"] = $ceko;

    /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. Mencari Jenjang*/
            
            $jen = array();
            $jen2 = array();
            $jen3 = array();
              preg_match_all("#\b(magister|master(s)*|bachelor|diploma|doktor|doctoral|phd|ph.d|postgraduate|undergraduate|mba|msc)\b#i",$judul0,$data1);
              foreach(array_unique($data1[0]) as $value) {
                if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                  $jen3[] = "Master";
                }
                elseif(preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                  $jen3[] = "Sarjana";     
                }
                elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/phd/i",$value,$cetak) || preg_match("/ph.d/i",$value,$cetak) || preg_match("/\bdoktor\b/i",$value,$cetak)){
                  $jen3[] = "Doktor";     
                }
                
                
              }


               preg_match_all("#\b(magister|master(s)*|bachelor|diploma|doktor|doctoral|phd|ph.d|postgraduate|undergraduate|mba|msc)\b#i",$find,$data1);
              foreach(array_unique($data1[0]) as $value) {
                if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                  $jen[] = "Master";
                }
                elseif(preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                  $jen[] = "Sarjana";     
                }
                elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/phd/i",$value,$cetak) || preg_match("/ph.d/i",$value,$cetak)|| preg_match("/\bdoktor\b/i",$value,$cetak)){
                  $jen[] = "Doktor";     
                }
              
                
              }


              preg_match_all("#level\:\s*([^\;]+)\b(magister|master(s)*|bachelor|diploma|doktor|doctoral|phd|ph.d|postgraduate|undergraduate)\b#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                  $jen2[] = "Master";
                }
                elseif(preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                  $jen2[] = "Sarjana";     
                }
                elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/ph(.)*d(.)*/i",$value,$cetak) || preg_match("/ph.d/i",$value,$cetak)|| preg_match("/\bdoktor\b/i",$value,$cetak)){
                  $jen2[] = "Doktor";     
                }
                
              }     
                    /*JADIKAN ARRAY ATAU KOMA*/
                    $cekj = array_values(array_unique(array_merge($jen,$jen2,$jen3)));
                    //$info[$i]["jenjang"] = $cekj;
                    $info[$i]["jenjang"] = jenjangid($cekj);

    /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*2. Mencari JURUSAN*/
$jurusan = array();
                //preg_match_all("#(subject(s))\:\s*([^\;]+)(any course)\b#i",$find,$data3);
                if(preg_match_all("#subject\(s\)\:\s*([^\;]+)(\n)(\s)(.)\b#i",$find,$data3)){
                //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                foreach(array_unique($data3[0]) as $valueX) {
                  //if(preg_match_all("/\b(any|course)\b/i", $find,$valuex2)){
                    //$valuex2 = "semua";
                 //$val= mysql_real_escape_string($valueX);
                    // $jurusan[] = mysql_real_escape_string((strtolower($valueX)));
                 $val =strtolower($valueX);
                 $value2 = ltrim(str_replace(array("(s)",":","\n","\r","</strong>","</p"," "),".",$val));
                      $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                      $valuex4 = str_replace("."," ", $valuex2);
                        $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                        $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                        $valuex7 =array_shift(explode('.', $valuex6));
                 //$val2 = preg_replace( "/\r|\n/", "", $valueX );
                    //}     
                  }
                }
                 //$info[$i]["jurusan"] = $jurusan;
                  //$info[$i]["jurusan2"] = $valuex7;
  //$jurusan = array();
                //preg_match_all("#(subject(s))\:\s*([^\;]+)(any course)\b#i",$find,$data3);
                if(preg_match_all("#eligibility\:\s*([^\;]+)\b#i",$find,$data3)){
                //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                foreach(array_unique($data3[0]) as $valueX) {
                  //if(preg_match_all("/\b(any|course)\b/i", $find,$valuex2)){
                    //$valuex2 = "semua";
                 //$val= mysql_real_escape_string($valueX);
                    // $jurusan[] = mysql_real_escape_string((strtolower($valueX)));
                 $val =strtolower($valueX);
                 $value2 = ltrim(str_replace(array("eligibility",":","\n","\r","</strong>","</p"," "),".",$val));
                      $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                      $valuex4 = str_replace("."," ", $valuex2);
                        $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                        $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                        $valuex8 =array_shift(explode('>', $valuex6));

                 // $valuex4 = str_replace("."," ", $valuex2);
                 //        $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                 //        //$valuex6 = preg_replace("/\r|\n/",".",$valuex5);
                 //        $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                 //        $valuex7 =array_shift(explode('.', $valuex6));  
                  }
                }

                 // $info[$i]["jurusan"] = $valuex7;
                 //  $info[$i]["jurusan2"] = $valuex8;

                   $jurcek = cekjurusan($valuex7,$id_url);
                   $jurcek2 = cekjurusan($valuex8,$id_url);
                  $jurfix = array_values(array_unique(array_merge($jurcek,$jurcek2)));
                  $jurnam = jurcon($jurfix,$id);
                  $cekju = jurusanid($jurfix,$id_url);
                  
                  $info[$i]["jurusanid"] = array_unique($cekju);
                  $info[$i]["jurusan"] = array_unique($jurnam);
                  //$info[$i]["jurusan"] = array_unique(jurx($jurfix,$id_url));

     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*3. Mencari Negara*/

                $negara = array();
                $negara2 = array();
                $univneg = array();
                //$negara2 = ceknegara($judul0,$id);
                if(preg_match_all("#at\:\s*([^\;]+)\b#i",$find,$data4)){
                  //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                  foreach(array_unique($data4[0]) as $valuex) {
                      //echo $value . "<br/>";
                      $value2 = str_replace(array("at",":","\n","\r","</strong>","</p"," "),".",$valuex);
                      $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                      $valuex4 = str_replace("."," ", $valuex2);
                      $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                        //$valuex6 = preg_replace("/\r|\n/",".",$valuex5);
                      $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                      $valuex7 =array_shift(explode('.', $valuex6));
                      $negara = ceknegara($valuex7,$id);
                       //$negara = ceknegara($valuex4,$id);

                    } 
                  } 
                        // /*JADIKAN ARRAY ATAU KOMA*/
                        //$cekn = array_unique($negara);
                        $cekn = array_values(array_unique(array_merge($negara,$negara2)));
                        $info[$i]["negara"] = negaraid($cekn,$id);

                         if(!empty($cekn)){
                            $info[$i]["negara2"] = $cekn;
                          }
                          else{
                            $univneg[]="internasional";
                            $info[$i]["negara2"] =array_unique($univneg) ;
                          }
                        //$info[$i]["negara"] = $cekn;
            
 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*4. Mencari Penyedia*/
      

                      $penyedia = array();
                      if(preg_match_all("#provider\:\s*([^\;]+)\b#i",$find,$data4)){
                        //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                        foreach(array_unique($data4[0]) as $valuex) {
                            //echo $value . "<br/>";
                            $value2 = str_replace(array("Provider",":","\n","\r","</strong>","</p"," ","<b>","</b>"),".",$valuex);
                            $valuex2 = preg_replace('/[^\x20-\x7E]\s+/','', $value2);
                            //$valuex3 = strstr($valuex2,">");
                            //$valuex3 = preg_match("/\b[a-z]{15}\b/i", $valuex2);
                            //$valuex4 = str_replace(array(">","\n","\r",".")," ", $valuex2);
                            $valuex4 = str_replace("."," ", $valuex2);
                            $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                            //$valuex6 = preg_replace("/\r|\n/",".",$valuex5);
                            $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                            $valuex7 =array_shift(explode('.', $valuex6));
                            //$valuex7 = preg_replace('/(.)*/i','', $valuex4);
                            //preg_match("/\b[a-z]\b/", subject)
                            //$negara[] = $valuex4;
                             $penyedia[] = $valuex7;
                          } 
                        } 
                              $cekp = array_unique($penyedia);
                              $info[$i]["penyedia"] = $cekp;
 
 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*5. Mencari Univ*/

                       
                        $univ = array();
                         $univ2 = array();
                         $uni = array();
                       
                        if(!empty($info[$i]['negara'])){

                        // preg_match_all("#at\:\s*([^\;]+)\b#i",$find,$data4);
                        //  if(preg_match_all("#(at)*\s[a-z]{5,15}\s+(university|collage)#i",$find,$data5a)){
                        // foreach(array_unique($data5a[0]) as $valueX) {
                        //     //echo $value . "<br/>";
                        //     $univ[] = ltrim(str_replace("at","",$valueX));     
                        //   }
                        // }
                        if(preg_match_all("#(university|universities|collage)+\s(of)*\s[a-z]{4,10}\w#i",$find,$data5a)){
                        foreach(array_unique($data5a[0]) as $valueX) {
                            //echo $value . "<br/>";
                            $univ2[] = $valueX;     
                          }
                        }
                        foreach($cekp as $value){

                         if(preg_match("#(university|universities|college)#i",$value)){
                          
                            $cek = ltrim(preg_replace("/(,)\s*\w{1,10}/i","",$value));
                            $univ[] = ltrim(str_replace(array("The","the"),"", $cek));      
                         
                          }
                        }
                             

                        }
                        $ceku = array_unique(array_merge($univ2,$univ));
                         // /*JADIKAN ARRAY ATAU KOMA*/
                        if(!empty($ceku)){
                              
                              //$ceku = array_unique($univ2);
                              $info[$i]["univ"] = $ceku;
                        // else{
                        //   $info[$i]["univ"] = array();
                        }
                        else{
                           $info[$i]["univ"] = $uni;
                        }

 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*6. Mencari openfor*/


                              $open = array();
                          $listu = array("applicants","candidates","students","foreign","citizens");
                            foreach($listu as $data){
                                $grouped_patterns[] = "(" . $data . ")";
                              }
                          $master_pattern = implode($grouped_patterns, "|");
                         preg_match_all("#\b(international|overseas|indonesia|indonesian)\s*(".$master_pattern.")\b#i",$find,$data5);
                         
                         foreach(array_unique($data5[0]) as $value) {
                            //echo $value . "<br/>";
                            //$univ0[] = strtolower($value);    
                            if(preg_match("/international/i",$value)){
                                $open[] = "semua negara";
                              }
                              elseif(preg_match("/indonesia/i",$value)){
                                $open[] = "indonesia";     
                              } 
                               elseif(preg_match("/overseas/i",$value)){
                                $open[] = "overseas";     
                              } 
                          }
                           $info[$i]["openfor"] = array_values(array_unique($open));
            
     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*7. Mencari Deadline*/  
                //preg_match_all("#(subject(s))\:\s*([^\;]+)(any course)\b#i",$find,$data3);
                            if(preg_match_all("#deadline\:\s*([^\;]+)\b#i",$find,$data3)){
                            //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                            foreach(array_unique($data3[0]) as $valueX) {
                              //if(preg_match_all("/\b(any|course)\b/i", $find,$valuex2)){
                                //$valuex2 = "semua";
                             //$val= mysql_real_escape_string($valueX);
                                // $jurusan[] = mysql_real_escape_string((strtolower($valueX)));
                             $val =strtolower($valueX);
                             $value2 = ltrim(str_replace(array("deadline",":","\n","\r","</strong>","</p"," "),".",$val));
                                  $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                                  $valuex4 = str_replace("."," ", $valuex2);
                                    $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                                    $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                                    $valuex7 =array_shift(explode('>', $valuex6));
                             //$val2 = preg_replace( "/\r|\n/", "", $valueX );
                                //}     
                              }
                            }
                           $deadline = array();
                           $deadlinex = array();
                           $my_date = array();
                           $my_date2 = array();
                           $my_date3 = array();
                            preg_match_all("#\b([0-9]|[1-2][0-9]|3[0-1])(th|rd|st)?\s*(january|febuary|march|april|may|june|july|august|september|october|november|december)(,)*\s+(2015|2016)*\b#i",$valuex6,$data6);
                            if(count($data6)>0){
                            foreach(array_unique($data6[0]) as  $valueX) {
                                $deadline[] = $valueX;     
                              }
                            } 
                            
                            if(!empty($deadline)){
                              foreach ($deadline as $value) {
                                    $split = preg_split('/\s+/', $value);
                                    echo $split ."<br>";
                                    $join = implode("-", $split);
                                    //echo $join;
                                    $hapus = str_replace(array("is","-")," ",$join);
                                    //echo $hapus;
                                    $my_date[] = date('Y-m-d',strtotime($hapus));
                                    //echo $my_date;
                                }
                              }

                            preg_match_all("#\b(january|febuary|march|april|may|june|july|august|september|october|november|december)\s*([0-9]|[1-2][0-9]|3[01])(th|rd|st|,)*\s(2015|2016)*\b#i",$valuex6,$data6a);
                            if(count($data6a)>0){
                            foreach(array_unique($data6a[0]) as  $valueX) {
                                $deadlinex[] = $valueX;     
                              }
                            } 
                            if(!empty($deadlinex)){
                              foreach ($deadlinex as $value) {
                                    $split = preg_split('/\s+/', $value);
                                    echo $split ."<br>";
                                    $joinx = implode("-", $split);
                                    //echo $join;
                                    $hapus = str_replace(array("is","-")," ",$joinx);
                                    //echo $hapus;
                                    $my_date2[] = date('Y-m-d',strtotime($hapus));
                                    //echo $my_date;
                                }
                              }  
                              
                                  // $cekd2 = array_unique($deadlinex);
                                  // $cekd = array_unique($deadline);
                             $tes = array_unique(array_merge($my_date,$my_date2));
                                  $info[$i]["deadline"] = $tes[0];
                                  //$info[$i]["deadline"] = $my_date;
                                  //$info[$i]["deadline"] = $cekd;
   /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*8. Mencari GAMBAR & konten*/     

    // if(preg_match_all("#(gpa|TOEFL|IBT|internet-based|internet based|PBT|Paper-based|Paper based|IELTS)#i",$find,$data2)){
    //           foreach(array_unique($data2[0]) as $value) {
    //             if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
    //              //$ibt = "ibt";
    //              $info[$i]["ibt"] = 1;
    //             }
    //             if(preg_match("/pbt|Paper-based/i",$value,$cetak2)){
    //               //$pbt = "pbt";
    //              $info[$i]["pbt"] = 1;
    //             }
    //             if(preg_match("/ielts/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $info[$i]["ielts"] = 1;
    //             } 
    //             if(preg_match("/GPA/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $result[$i]["ipk"] = 1;
    //             }
    //             if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt|internet-based|internet based|pbt|Paper-based|Paper based/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $info[$i]["ibt"] = 1;
    //               $info[$i]["pbt"] = 1;
    //             }
    //           }
    //         }
    //         else{
    //           $info[$i]["ibt"] = 0;
    //           $info[$i]["pbt"] = 0;
    //           $info[$i]["ielts"] = 0;
    //           $info[$i]["ipk"] = 0;
    //         }

    $ibt = array();
                            $pbt = array();
                            $ielts = array();
                            $ipk = array();

              preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
                 $ibt[] = "ibt";
                 //$info[$i]["ibt"] = 1;
                }
                if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
                  $pbt[] = "pbt";
                 //$info[$i]["pbt"] = 1;
                }
                if(preg_match("/ielts/i",$value,$cetak3)){
                  $ielts[] = "ielts";
                 //$info[$i]["ielts"] = 1;
                } 
                // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
                //   //$ielts = "ielts";
                //  $result[$i]["ipk"] = 1;
                // } 
               if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
                  $ibt[] = "ibt";
                  $pbt[] = "pbt";
                 // $info[$i]["ibt"] = 1;
                 //  $info[$i]["pbt"] = 1;
                }
              }
            
           preg_match_all("#GPA|ipk#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/GPA|ipk/i",$value,$cetak1)){
                 $ipk[] = "ipk";
                 //$info[$i]["ipk"] = "ipk";
                } 
              }
                          
               $ceks = array_values(array_unique(array_merge($ibt,$pbt,$ielts,$ipk)));

                                            //$id = $this->web;
            $info[$i]["sertifikat"] = $ceks;

                             shuffle($pick);
                            foreach($pick as $isi){
                              $info[$i]['pick'] = $isi;
                            }
                            shuffle($picb);
                            foreach ($picb as $isi) {
                              $info[$i]['picb'] = $isi;
                            }
                            //$info[$i]['konten'] = strip_tags($find,"<div><b><p><br>");
                            $info[$i]['konten'] = mysql_real_escape_string($find);
 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*9. CETAK HASIL EKSTRAKSI REGEX*/

                            /*CEK DATA*/
                            echo "<pre>\n";
                            echo "<h1>ini INTERNASIONAL</h1>\n";
                            print_r($info) ."\n";
                            echo "</pre>";      
        } /*END FOR PHD*/
      }/*end if*/
      //return $info;


/*BEASISWA S1 TAMBHAKAN FUNGSI CRONJOBSATAU FUNGSI PENCARIAN MANUAL OLEH USER
  BAGIAN INI SEBAGAI PENANDA BATAS SCRAPPING DATA PADA WEBSITE BEASISWA
  SCHOLARSHIP POSITION
*/

if($this->time==10){

  /*BEASISWA S3 TAMBHAKAN FUNGSI CRONJOBSATAU FUNGSI PENCARIAN MANUAL OLEH USER
  BAGIAN INI SEBAGAI PENANDA BATAS SCRAPPING DATA PADA WEBSITE BEASISWA
  SCHOLARSHIP POSITION
*/
   for ($i=0; $i< count($sch2); $i++){  
            $url2 = $sch2[$i]->a->href;
            $judul = $sch2[$i]->a->content;

            $link0 = stripslashes($url2);
            $judul0 = stripslashes($judul);
            $info[$i]['domain'] = $link0;
            $info[$i]["id_domain"] = $this->webx;
            $id= $this->webx;
            $info[$i]["judul"] = $judul0;
            
            /*YQL TAHAP 2 DETAIL BEASISWA*/
            $path = "http://query.yahooapis.com/v1/public/yql?q=";
            $path .= urlencode("SELECT * FROM htmlstring WHERE url='$link0' AND xpath='//*[@class=\"single-content\"]/p'");
            //$path .= urlencode("SELECT * FROM htmlstring WHERE url='http://www.beasiswapascasarjana.com/2015/05/beasiswa-pemerintah-jiangsu-china.html' AND xpath='//*[@class=\"post hentry\"]/div[2]/div[2]'");
            $path .= "&format=json";
            $path .="&env=http://datatables.org/alltables.env";
            /*END YQL*/

            /*CURL TAHAP 2 DETAIL*/
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $path);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
            $rawdata = curl_exec($c);
            curl_close($c);

            $data = json_decode($rawdata);
            /*END CURL*/

            // Show us the data
            //echo "<pre>\n";
            //print_r($data);
            //echo "</pre>";

            $find = $data->query->results->result;

    /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*0. Mencari tipe beasiswa*/
            $tipe = array();
             preg_match_all("#(scholarship|studentship|fellowship)#i",$find,$data);
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
                echo $valuey;
                
              }
            $ceko = array_unique($tipe);
            $info[$i]["tipe"] = $ceko;

    /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. Mencari Jenjang*/
            
            $jen = array();
            $jen2 = array();
            $jen3 = array();
              preg_match_all("#\b(magister|master(s)*|bachelor|diploma|doktor|doctoral|phd|ph.d|postgraduate|undergraduate|mba|msc)\b#i",$judul0,$data1);
              foreach(array_unique($data1[0]) as $value) {
                if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                  $jen3[] = "Master";
                }
                elseif(preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                  $jen3[] = "Sarjana";     
                }
                elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/phd/i",$value,$cetak) || preg_match("/ph.d/i",$value,$cetak) || preg_match("/\bdoktor\b/i",$value,$cetak)){
                  $jen3[] = "Doktor";     
                }
                
                
              }


               preg_match_all("#\b(magister|master(s)*|bachelor|diploma|doktor|doctoral|phd|ph.d|postgraduate|undergraduate|mba|msc)\b#i",$find,$data1);
              foreach(array_unique($data1[0]) as $value) {
                if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                  $jen[] = "Master";
                }
                elseif(preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                  $jen[] = "Sarjana";     
                }
                elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/phd/i",$value,$cetak) || preg_match("/ph.d/i",$value,$cetak)|| preg_match("/\bdoktor\b/i",$value,$cetak)){
                  $jen[] = "Doktor";     
                }
              
                
              }


              preg_match_all("#level\:\s*([^\;]+)\b(magister|master(s)*|bachelor|diploma|doktor|doctoral|phd|ph.d|postgraduate|undergraduate)\b#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                  $jen2[] = "Master";
                }
                elseif(preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                  $jen2[] = "Sarjana";     
                }
                elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/ph(.)*d(.)*/i",$value,$cetak) || preg_match("/ph.d/i",$value,$cetak)|| preg_match("/\bdoktor\b/i",$value,$cetak)){
                  $jen2[] = "Doktor";     
                }
                
              }     
                    /*JADIKAN ARRAY ATAU KOMA*/
                    $cekj = array_values(array_unique(array_merge($jen,$jen2,$jen3)));
                    //$info[$i]["jenjang"] = $cekj;
                    $info[$i]["jenjang"] = jenjangid($cekj);

    /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*2. Mencari JURUSAN*/
$jurusan = array();
                //preg_match_all("#(subject(s))\:\s*([^\;]+)(any course)\b#i",$find,$data3);
                if(preg_match_all("#subject\(s\)\:\s*([^\;]+)(\n)(\s)(.)\b#i",$find,$data3)){
                //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                foreach(array_unique($data3[0]) as $valueX) {
                  //if(preg_match_all("/\b(any|course)\b/i", $find,$valuex2)){
                    //$valuex2 = "semua";
                 //$val= mysql_real_escape_string($valueX);
                    // $jurusan[] = mysql_real_escape_string((strtolower($valueX)));
                 $val =strtolower($valueX);
                 $value2 = ltrim(str_replace(array("(s)",":","\n","\r","</strong>","</p"," "),".",$val));
                      $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                      $valuex4 = str_replace("."," ", $valuex2);
                        $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                        $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                        $valuex7 =array_shift(explode('.', $valuex6));
                 //$val2 = preg_replace( "/\r|\n/", "", $valueX );
                    //}     
                  }
                }
                 //$info[$i]["jurusan"] = $jurusan;
                  //$info[$i]["jurusan2"] = $valuex7;
  //$jurusan = array();
                //preg_match_all("#(subject(s))\:\s*([^\;]+)(any course)\b#i",$find,$data3);
                if(preg_match_all("#eligibility\:\s*([^\;]+)\b#i",$find,$data3)){
                //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                foreach(array_unique($data3[0]) as $valueX) {
                  //if(preg_match_all("/\b(any|course)\b/i", $find,$valuex2)){
                    //$valuex2 = "semua";
                 //$val= mysql_real_escape_string($valueX);
                    // $jurusan[] = mysql_real_escape_string((strtolower($valueX)));
                 $val =strtolower($valueX);
                 $value2 = ltrim(str_replace(array("eligibility",":","\n","\r","</strong>","</p"," "),".",$val));
                      $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                      $valuex4 = str_replace("."," ", $valuex2);
                        $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                        $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                        $valuex8 =array_shift(explode('>', $valuex6));

                 // $valuex4 = str_replace("."," ", $valuex2);
                 //        $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                 //        //$valuex6 = preg_replace("/\r|\n/",".",$valuex5);
                 //        $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                 //        $valuex7 =array_shift(explode('.', $valuex6));  
                  }
                }

                 // $info[$i]["jurusan"] = $valuex7;
                 //  $info[$i]["jurusan2"] = $valuex8;

                   $jurcek = cekjurusan($valuex7,$id_url);
                   $jurcek2 = cekjurusan($valuex8,$id_url);
                  $jurfix = array_values(array_unique(array_merge($jurcek,$jurcek2)));
                  $jurnam = jurcon($jurfix,$id);
                  $cekju = jurusanid($jurfix,$id_url);
                  
                  $info[$i]["jurusanid"] = array_unique($cekju);
                  $info[$i]["jurusan"] = array_unique($jurnam);
                  //$info[$i]["jurusan"] = array_unique(jurx($jurfix,$id_url));

     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*3. Mencari Negara*/

                $negara = array();
                $negara2 = array();
                $univneg = array();
                //$negara2 = ceknegara($judul0,$id);
                if(preg_match_all("#taken\sat\:\s*([^\;]+)\b#i",$find,$data4)){
                  //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                  foreach(array_unique($data4[0]) as $valuex) {
                      //echo $value . "<br/>";
                      $value2 = str_replace(array("taken","at",":","\n","\r","</strong>","</p"," "),".",$valuex);
                      $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                      $valuex4 = str_replace("."," ", $valuex2);
                      $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                        //$valuex6 = preg_replace("/\r|\n/",".",$valuex5);
                      $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                      $valuex7 =array_shift(explode('>', $valuex6));
                      $negara = ceknegara($valuex7,$id);
                       //$negara = ceknegara($valuex4,$id);

                    } 
                  } 
                        // /*JADIKAN ARRAY ATAU KOMA*/
                        //$cekn = array_unique($negara);
                        $cekn = array_values(array_unique($negara));
                        $info[$i]["negara"] = negaraid($cekn,$id);

                         if(!empty($cekn)){
                            $info[$i]["negara2"] = $cekn;
                          }
                          else{
                            $univneg[]="internasional";
                            $info[$i]["negara2"] =array_unique($univneg) ;
                          }
                        //$info[$i]["negara"] = $cekn;
            
 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*4. Mencari Penyedia*/
      

                      $penyedia = array();
                      if(preg_match_all("#provider\:\s*([^\;]+)\b#i",$find,$data4)){
                        //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                        foreach(array_unique($data4[0]) as $valuex) {
                            //echo $value . "<br/>";
                            $value2 = str_replace(array("Provider",":","\n","\r","</strong>","</p"," ","<b>","</b>"),".",$valuex);
                            $valuex2 = preg_replace('/[^\x20-\x7E]\s+/','', $value2);
                            //$valuex3 = strstr($valuex2,">");
                            //$valuex3 = preg_match("/\b[a-z]{15}\b/i", $valuex2);
                            //$valuex4 = str_replace(array(">","\n","\r",".")," ", $valuex2);
                            $valuex4 = str_replace("."," ", $valuex2);
                            $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                            //$valuex6 = preg_replace("/\r|\n/",".",$valuex5);
                            $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                            $valuex7 =array_shift(explode('.', $valuex6));
                            //$valuex7 = preg_replace('/(.)*/i','', $valuex4);
                            //preg_match("/\b[a-z]\b/", subject)
                            //$negara[] = $valuex4;
                             $penyedia[] = $valuex7;
                          } 
                        } 
                              $cekp = array_unique($penyedia);
                              $info[$i]["penyedia"] = $cekp;
 
 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*5. Mencari Univ*/

                       
                        $univ = array();
                         $univ2 = array();
                         $uni = array();
                       
                        if(!empty($info[$i]['negara'])){

                        // preg_match_all("#at\:\s*([^\;]+)\b#i",$find,$data4);
                        //  if(preg_match_all("#(at)*\s[a-z]{5,15}\s+(university|collage)#i",$find,$data5a)){
                        // foreach(array_unique($data5a[0]) as $valueX) {
                        //     //echo $value . "<br/>";
                        //     $univ[] = ltrim(str_replace("at","",$valueX));     
                        //   }
                        // }
                        if(preg_match_all("#(university|universities|collage)+\s(of)*\s[a-z]{4,10}\w#i",$find,$data5a)){
                        foreach(array_unique($data5a[0]) as $valueX) {
                            //echo $value . "<br/>";
                            $univ2[] = $valueX;     
                          }
                        }
                        foreach($cekp as $value){

                         if(preg_match("#(university|universities|college)#i",$value)){
                          
                            $cek = ltrim(preg_replace("/(,)\s*\w{1,10}/i","",$value));
                            $univ[] = ltrim(str_replace(array("The","the"),"", $cek));      
                         
                          }
                        }
                             

                        }
                        $ceku = array_unique(array_merge($univ2,$univ));
                         // /*JADIKAN ARRAY ATAU KOMA*/
                        if(!empty($ceku)){
                              
                              //$ceku = array_unique($univ2);
                              $info[$i]["univ"] = $ceku;
                        // else{
                        //   $info[$i]["univ"] = array();
                        }
                        else{
                           $info[$i]["univ"] = $uni;
                        }

 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*6. Mencari openfor*/


                              $open = array();
                          $listu = array("applicants","candidates","students","foreign","citizens");
                            foreach($listu as $data){
                                $grouped_patterns[] = "(" . $data . ")";
                              }
                          $master_pattern = implode($grouped_patterns, "|");
                         preg_match_all("#\b(international|overseas|indonesia|indonesian)\s*(".$master_pattern.")\b#i",$find,$data5);
                         
                         foreach(array_unique($data5[0]) as $value) {
                            //echo $value . "<br/>";
                            //$univ0[] = strtolower($value);    
                            if(preg_match("/international/i",$value)){
                                $open[] = "semua negara";
                              }
                              elseif(preg_match("/indonesia/i",$value)){
                                $open[] = "indonesia";     
                              } 
                               elseif(preg_match("/overseas/i",$value)){
                                $open[] = "overseas";     
                              } 
                          }
                           $info[$i]["openfor"] = array_values(array_unique($open));
            
     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*7. Mencari Deadline*/  
                //preg_match_all("#(subject(s))\:\s*([^\;]+)(any course)\b#i",$find,$data3);
                            if(preg_match_all("#deadline\:\s*([^\;]+)\b#i",$find,$data3)){
                            //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                            foreach(array_unique($data3[0]) as $valueX) {
                              //if(preg_match_all("/\b(any|course)\b/i", $find,$valuex2)){
                                //$valuex2 = "semua";
                             //$val= mysql_real_escape_string($valueX);
                                // $jurusan[] = mysql_real_escape_string((strtolower($valueX)));
                             $val =strtolower($valueX);
                             $value2 = ltrim(str_replace(array("deadline",":","\n","\r","</strong>","</p"," "),".",$val));
                                  $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                                  $valuex4 = str_replace("."," ", $valuex2);
                                    $valuex5 = preg_replace('/\s\s+/','', $valuex4);
                                    $valuex6 = str_replace(array("<br>","<br/>"),".",$valuex5);
                                    $valuex7 =array_shift(explode('>', $valuex6));
                             //$val2 = preg_replace( "/\r|\n/", "", $valueX );
                                //}     
                              }
                            }
                           $deadline = array();
                           $deadlinex = array();
                           $my_date = array();
                           $my_date2 = array();
                           $my_date3 = array();
                            preg_match_all("#\b([0-9]|[1-2][0-9]|3[0-1])(th|rd|st)?\s*(january|febuary|march|april|may|june|july|august|september|october|november|december)(,)*\s+(2015|2016)*\b#i",$valuex6,$data6);
                            if(count($data6)>0){
                            foreach(array_unique($data6[0]) as  $valueX) {
                                $deadline[] = $valueX;     
                              }
                            } 
                            
                            if(!empty($deadline)){
                              foreach ($deadline as $value) {
                                    $split = preg_split('/\s+/', $value);
                                    echo $split ."<br>";
                                    $join = implode("-", $split);
                                    //echo $join;
                                    $hapus = str_replace(array("is","-")," ",$join);
                                    //echo $hapus;
                                    $my_date[] = date('Y-m-d',strtotime($hapus));
                                    //echo $my_date;
                                }
                              }

                            preg_match_all("#\b(january|febuary|march|april|may|june|july|august|september|october|november|december)\s*([0-9]|[1-2][0-9]|3[01])(th|rd|st|,)*\s(2015|2016)*\b#i",$valuex6,$data6a);
                            if(count($data6a)>0){
                            foreach(array_unique($data6a[0]) as  $valueX) {
                                $deadlinex[] = $valueX;     
                              }
                            } 
                            if(!empty($deadlinex)){
                              foreach ($deadlinex as $value) {
                                    $split = preg_split('/\s+/', $value);
                                    echo $split ."<br>";
                                    $joinx = implode("-", $split);
                                    //echo $join;
                                    $hapus = str_replace(array("is","-")," ",$joinx);
                                    //echo $hapus;
                                    $my_date2[] = date('Y-m-d',strtotime($hapus));
                                    //echo $my_date;
                                }
                              }  
                              
                                  // $cekd2 = array_unique($deadlinex);
                                  // $cekd = array_unique($deadline);
                             $tes = array_unique(array_merge($my_date,$my_date2));
                                  $info[$i]["deadline"] = $tes[0];
                                  //$info[$i]["deadline"] = $my_date;
                                  //$info[$i]["deadline"] = $cekd;
   /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*8. Mencari GAMBAR & konten*/     

    // if(preg_match_all("#(GPA|TOEFL|IBT|internet-based|internet based|PBT|Paper-based|Paper based|IELTS)#i",$find,$data2)){
    //           foreach(array_unique($data2[0]) as $value) {
    //             if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
    //              //$ibt = "ibt";
    //              $info[$i]["ibt"] = 1;
    //             }
    //             if(preg_match("/pbt|Paper-based/i",$value,$cetak2)){
    //               //$pbt = "pbt";
    //              $info[$i]["pbt"] = 1;
    //             }
    //             if(preg_match("/ielts/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $info[$i]["ielts"] = 1;
    //             } 
    //             if(preg_match("/gpa/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $result[$i]["ipk"] = 1;
    //             }
    //             if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt|internet-based|internet based|pbt|Paper-based|Paper based/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $info[$i]["ibt"] = 1;
    //               $info[$i]["pbt"] = 1;
    //             }
    //           }
    //         }
    //         else{
    //           $info[$i]["ibt"] = 0;
    //           $info[$i]["pbt"] = 0;
    //           $info[$i]["ielts"] = 0;
    //           $info[$i]["ipk"] = 0;
    //         }

    // $ibt = array();
    //                         $pbt = array();
    //                         $ielts = array();
    //                         $ipk = array();

    //           preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2);
    //           foreach(array_unique($data2[0]) as $value) {
    //             if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
    //              $ibt[] = "ibt";
    //              //$info[$i]["ibt"] = 1;
    //             }
    //             if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
    //               $pbt[] = "pbt";
    //              //$info[$i]["pbt"] = 1;
    //             }
    //             if(preg_match("/ielts/i",$value,$cetak3)){
    //               $ielts[] = "ielts";
    //              //$info[$i]["ielts"] = 1;
    //             } 
    //             // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
    //             //   //$ielts = "ielts";
    //             //  $result[$i]["ipk"] = 1;
    //             // } 
    //            if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
    //               $ibt[] = "ibt";
    //               $pbt[] = "pbt";
    //              // $info[$i]["ibt"] = 1;
    //              //  $info[$i]["pbt"] = 1;
    //             }
    //           }
            
    //        preg_match_all("#GPA|ipk#i",$find,$data2);
    //           foreach(array_unique($data2[0]) as $value) {
    //             if(preg_match("/GPA|ipk/i",$value,$cetak1)){
    //              $ipk[] = "ipk";
    //              //$info[$i]["ipk"] = "ipk";
    //             } 
    //           }
                    $ibt = array();
                            $pbt = array();
                            $ielts = array();
                            $ipk = array();

              preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
                 $ibt[] = "ibt";
                 //$info[$i]["ibt"] = 1;
                }
                if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
                  $pbt[] = "pbt";
                 //$info[$i]["pbt"] = 1;
                }
                if(preg_match("/ielts/i",$value,$cetak3)){
                  $ielts[] = "ielts";
                 //$info[$i]["ielts"] = 1;
                } 
                // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
                //   //$ielts = "ielts";
                //  $result[$i]["ipk"] = 1;
                // } 
               if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
                  $ibt[] = "ibt";
                  $pbt[] = "pbt";
                 // $info[$i]["ibt"] = 1;
                 //  $info[$i]["pbt"] = 1;
                }
              }
            
           preg_match_all("#GPA|ipk#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/GPA|ipk/i",$value,$cetak1)){
                 $ipk[] = "ipk";
                 //$info[$i]["ipk"] = "ipk";
                } 
              }
                          
               $ceks = array_values(array_unique(array_merge($ibt,$pbt,$ielts,$ipk)));

                                            //$id = $this->web;
            $info[$i]["sertifikat"] = $ceks;      
              

                            // $ipk = array();
                            //    preg_match_all("#(ipk)(:)*\s*(minimal|minimum)*\s*([2-4])(.|,)*([0-9])\b#i",$find,$data6);
                            //     foreach(array_unique($data6[0]) as $valueX) {
                            //         //echo $valueX . "<br/>";
                            //         $ipk[] = $valueX;     
                            //       }
                            //       if(!empty($ipk)){
                            //       foreach ($ipk as $value) {
                            //             $data = ltrim(preg_replace("/(ipk|:|minimum|minimal)/i"," ",$value));
                            //        if(preg_match("/,/",$data)){
                            //               $data2 = (float)str_replace(",",".",$data);
                            //             }
                            //             else{
                            //               $data2 = $data;
                            //             }
                            //         }
                            //          $info[$i]["ipk"] = $data2;
                            //       }
                            //       else{
                            //          $info[$i]["ipk"] = 0;
                            //       }

                             shuffle($pick);
                            foreach($pick as $isi){
                              $info[$i]['pick'] = $isi;
                            }
                            shuffle($picb);
                            foreach ($picb as $isi) {
                              $info[$i]['picb'] = $isi;
                            }
                            //$info[$i]['konten'] = strip_tags($find,"<div><b><p><br>");
                            $info[$i]['konten'] = mysql_real_escape_string($find);

 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*9. CETAK HASIL EKSTRAKSI REGEX*/

    /*9. cetak hasil*/

                                  /*CEK DATA*/
                                  echo "<pre>\n";
                                  echo "<h1>ini INDONESIA</h1>\n";
                                  print_r($info) ."\n";
                                  echo "</pre>";      
        } ///*END FOR PHD*/
      }//END IF

/*BEASISWA S1 TAMBHAKAN FUNGSI CRONJOBSATAU FUNGSI PENCARIAN MANUAL OLEH USER
  BAGIAN INI SEBAGAI PENANDA BATAS SCRAPPING DATA PADA WEBSITE BEASISWA
 PASCA SARJANA DALAM NEGERI
*/

    if($this->time==10){
    
                              //* ini DALAM NEGERI*//
                              for ($i=0; $i< count($sch3); $i++){  
                                $url2 = $sch3[$i]->a->href;
                                $judul = $sch3[$i]->a->content;
                                
                                $link0 = stripslashes($url2);
                                $judul0 = stripslashes($judul);
                                
                                /*PRE STEP 0 DOMAIN DAN JUDUL*/
                                $info[$i]["domain"] = $link0;
                                $info[$i]["id_domain"] = $this->web;
                                $id_url = $this->web;
                                $info[$i]["judul"] = $judul0;
                              //   //echo $link0 .'<br />';
                            //$bads = array("Cara","Berlangganan","Daftar","Menulis");

                            //foreach ($bads as $bad) {
                             //if (strpos($judul0,$bad) == true) {  
                             if (!preg_match('/^(cara|daftar|peluangnya|lihat)/i', $judul)){ 
                                $negara = array();
                                $univ = array();
                                $deadline = array();
    
                              $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
                                   "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                                   
                              $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
                                   "Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September",
                                   "Oktober","Nopember","Desember");

                              $pick = array('thumb2.jpg','thumb1.jpg','thumb3.jpg');
                              $picb = array('i2.jpg','i3.jpg','i5.jpg');
                               
                                           // $info['domain'] = stripslashes($link);
                              // $info['judul'] = 'china beasiswa';

                              /*YQL TAHAP 2 DETAIL BEASISWA*/
                              $path = "http://query.yahooapis.com/v1/public/yql?q=";
                              $path .= urlencode("SELECT * FROM htmlstring WHERE url='$link0' AND xpath='//*[@class=\"post-body entry-content\"]/div[position()>1]'");
                              //$path .= urlencode("SELECT * FROM htmlstring WHERE url='http://www.beasiswapascasarjana.com/2015/05/beasiswa-pemerintah-jiangsu-china.html' AND xpath='//*[@class=\"post hentry\"]/div[2]/div[2]'");
                              $path .= "&format=json";
                              $path .="&env=http://datatables.org/alltables.env";
                              /*END YQL*/

                              /*CURL TAHAP 2 DETAIL*/
                              $c = curl_init();
                              curl_setopt($c, CURLOPT_URL, $path);
                              curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                              curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                              curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
                              $rawdata = curl_exec($c);
                              curl_close($c);

                              $data = json_decode($rawdata);
                              /*END CURL*/

                              // // Show us the data
                              // echo "<pre>\n";
                              // print_r($data) . "\n";
                              // echo "</pre>";

                              $find = $data->query->results->result;
                              
                              //$find = $data['query']['results']['result'];
                              //$info['konten'] = $find;

                                      /*REGEX PREG_MATCH*/
  /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI TIPE*/
            
                                $tipe = array();
                                 preg_match_all("#(beasiswa|pertukaran pelajar|pertukaran profesional|pertukaran pemuda|fellowship)#i",$find,$data);
                                  foreach(array_unique($data[0]) as $valuey) {
                                    if(preg_match("/\bbeasiswa\b/i",$valuey,$cetak)){
                                      $tipe[] = "Beasiswa";
                                    }
                                    if(preg_match("/(pertukaran pelajar|pertukaran profesional|pertukaran pemuda)/i",$valuey,$cetak)) {
                                      $tipe[] = "pertukaran";
                                    }
                                    if(preg_match("/fellowship/i",$valuey,$cetak)) {
                                      $tipe[] = "fellowship";
                                    }
                                    echo $valuey;
                                    
                                  }
                                $ceko = array_unique($tipe);
                                $info[$i]["tipe"] = $ceko;

  /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*2. CARI PENYEDIA*/
                                 $penyedia = array();
                                 preg_match_all("/\b(pemerintah|kementerian|lpdp|bidik misi|erasmus mundus)\b/i",$find,$datapx);
                                  foreach(array_unique($datapx[0]) as $valuey) {
                                    // $penyediax = preg_grep("#(kementerian|pemerintah|yayasan)\s+[a-z]{5,15}\s*[a-z]{3,15}\s*[a-z]{2,6}#i",$datapx);
                                    
                                    if(preg_match("/\b(pemerintah|kementerian)\b/i",$valuey,$cetak)){
                                      $penyedia[] = "pemerintah";
                                    }
                                    else{
                                     $penyedia[] = strtolower($valuey);
                                    }
                                    
                                 }

                                 $penyedia2 = array();
                                 preg_match_all("/\b(pemerintah|kementerian|university|lpdp|bidik misi|erasmus mundus)\b/i",$judul,$datapx);
                                  foreach(array_unique($datapx[0]) as $valuey) {
                                    // $penyediax = preg_grep("#(kementerian|pemerintah|yayasan)\s+[a-z]{5,15}\s*[a-z]{3,15}\s*[a-z]{2,6}#i",$datapx);
                                    
                                    if(preg_match("/\b(pemerintah|kementerian)\b/i",$valuey,$cetak)){
                                      $penyedia2[] = "pemerintah";
                                    }
                                    else{
                                     $penyedia2[] = strtolower($valuey);
                                    }
                                    
                                 }

                                $cekpn = array_values(array_unique(array_merge($penyedia,$penyedia2)));
                                $info[$i]["penyedia"] = $cekpn;

     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*3. CARI JENJANG*/
                                      $s1arr = array();
                                      //$s2arr = array();
                                      preg_match_all("#\b(magister|pascasarjana|master|sarjana|diploma|doktor|doktoral|s1|s2|s3|phd|ph.d)\b#i",$find,$data2);
                                      foreach(array_unique($data2[0]) as $value) {
                                        if(preg_match("/program s2/i",$value,$cetak)||preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak)){
                                          $s1arr[] = "Master";
                                        }
                                        elseif(preg_match("/program s1/i",$value,$cetak)|| preg_match("/s1/i",$value,$cetak) || preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) ){
                                          $s1arr[] = "Sarjana";     
                                        }
                                        elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak)|| preg_match("/s3/i",$value,$cetak) || preg_match("/ph(.)*d(.)*/i",$value,$cetak) || preg_match("/\bdoktor\b/i",$value,$cetak)){
                                          $s1arr[] = "Doktor";     
                                        }
                                        // else{
                                        //   $s1arr[] = "kategori lainnya";
                                        // }
                                        
                                      }     
                                            /*JADIKAN ARRAY ATAU KOMA*/
                                            //if(!empty($s1arr)){
                                            $cekj = array_values(array_unique($s1arr));

                                            //$id = $this->web;
                                             $info[$i]["jenjang"] = jenjangid($cekj);
                                             //$info[$i]["jenjang2"] = $cekj;
                                           //}
     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI JURUSAN*/
                                      $jurusan = array();
                                      $jurf = array();
                                      $jurx = $this->jurlist($id_url);
                                      //$pecah = explode(",", $jurx);
                                      $gabung = implode("|", $jurx);

                                      //preg_match_all("#\b(ekonomi|akuntansi|manajemen|teknik|ilmu komputer|teknologi informasi)\b#i",$find,$data3);
                                       preg_match_all("#\b(".$gabung.")\b#i",$find,$data3);
                                      //preg_match_all("#\b(ekonomi|akuntansi|manajemen|teknik|ilmu komputer|teknologi informasi)\b#i",$find,$data3);
                                      //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                                      foreach(array_unique($data3[0]) as $valueX) {
                                          //echo $value . "<br/>";
                                          $jurusan[] = strtolower($valueX);     
                                        }
                                          if(!empty($jurusan)){
                                            // /*JADIKAN ARRAY ATAU KOMA*/
                                            $jurcek = cekjurusan($find,$id_url);
                                            $jurfix = array_values(array_unique($jurcek));
                                            $cekju = jurusanid($jurfix,$id_url);
                                            $info[$i]["jurusanid"] = $cekju;
                                            $info[$i]["jurusan"] = $jurfix;
                                          }
                                          else{
                                            $jurf[] ="semua jurusan";
                                            $cekju = jurusanid($jurf,$id_url);
                                            $info[$i]["jurusanid"] = $cekju;
                                            $info[$i]["jurusan"] =$jurf;
                                          }
     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI NEGARA*/
                                      // /*JADIKAN ARRAY ATAU KOMA*/
                                      $negaracek = ceknegara("indonesia",$id_url);
                                      $cekn = array_unique($negaracek);
                                      $info[$i]["negara"] = negaraid($cekn,$id_url);
                                      $info[$i]["negara2"] = $cekn;
     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. UNIV*/

                                    $univ0 = array();
                                    $univ2 = array();
                                    $univ3 = array();

                                     $listu = array("indonesia","brawijaya","diponogoro","gadjah mada","padjajaran","teknologi sepuluh november","teknologi bandung","pertanian bogor","airlangga","negeri jakarta","negeri malang","padjadjaran","diponegoro");
                                    foreach($listu as $data){
                                        $grouped_patterns[] = "(" . $data . ")";
                                      }
                                      $master_pattern = implode($grouped_patterns, "|");
                                     preg_match_all("#\b(universitas|institut|itb|its|ipb)\s*(".$master_pattern.")\b#i",$find,$data5);
                                     
                                     foreach(array_unique($data5[0]) as $valueX) {
                                        //echo $value . "<br/>";
                                        $univ0[] = $valueX;     
                                      }
                                    //  preg_match_all("#\b(universitas|itb|its|ipb)\s*(negeri|(a|d|sr|i|p[a-z]{6,15}))\s*[a-z]{4,15}\b#i",$find,$data5);
                                    // //preg_match_all("#\b(indonesia|uk|inggris|jerman|usa|amerika|australia|china|bali)\b#i",$find,$data4);
                                    // //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                                    // foreach(array_unique($data5[0]) as $valueX) {
                                    //     //echo $value . "<br/>";
                                    //     $univ[] = $valueX;     
                                    // }

                                      if(preg_match_all("#(university|universities|collage)+\s(of)\s[a-z]{2,15}#i",$find,$data5a)){
                                    foreach(array_unique($data5a[0]) as $valueX) {
                                        //echo $value . "<br/>";
                                        $univ2[] = $valueX;     
                                      }
                                    }

                                    if(preg_match_all("#[a-z]{5,15}(of)\s+(university|universities|collage)#i",$find,$data5a)){
                                    foreach(array_unique($data5a[0]) as $valueX) {
                                        //echo $value . "<br/>";
                                        $univ3[] = $valueX;    
                                      }
                                    }
                                      
                                          // /*JADIKAN ARRAY ATAU KOMA*/
                                          //$ceku = array_unique($univ);
                                          $ceku = array_unique(array_merge($univ,$univ0,$univ2,$univ3));
                                          //$info[$i]["univ"] = univid($ceku);
                                          $info[$i]["univ"] = $ceku;
     /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI DEADLINE*/
                               $my_date = array();
                               preg_match_all("#(lambat|hingga|pendaftaran|ditutup|-)\s*([0-9]|[1-2][0-9]|3[01])\s+(januari|febuari|maret|april|mei|juni|juli|agustus|september|oktober|november|desember)\s*(2015|2016)*#i",$find,$data6);
                               //preg_match_all("#(lambat|hingga|pendaftaran|ditutup|-)\s*(30)\s+(oktober)\s*(2015|2016)*#i",$find,$data6);
                                foreach(array_unique($data6[0]) as $valueX) {
                                    //echo $value . "<br/>";
                                    $deadline[] = $valueX;     
                                  }
                                  if(!empty($deadline)){
                                  foreach ($deadline as $value) {
                                        $split = preg_split('/\s+/', $value);
                                        echo $split ."<br>";
                                        $join = implode("-", $split);
                                        echo $join;
                                        $hapus = ltrim(str_replace(array("lambat",".","hingga",":","pada","tanggal","-","/","","pendaftaran","ditutup")," ",$join));
                                        $hapus2 = str_replace($id, $en, $hapus);
                                        echo $hapus;
                                        $my_date[] = date('Y-m-d',strtotime($hapus2));
                                        echo $my_date;
                                        //echo $my_date;
                                    }
                                  }


    // if(preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2)){
    //           foreach(array_unique($data2[0]) as $value) {
    //             if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
    //              //$ibt = "ibt";
    //              $info[$i]["ibt"] = 1;
    //             }
    //             if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
    //               //$pbt = "pbt";
    //              $info[$i]["pbt"] = 1;
    //             }
    //             if(preg_match("/ielts/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $info[$i]["ielts"] = 1;
    //             } 
    //             // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
    //             //   //$ielts = "ielts";
    //             //  $result[$i]["ipk"] = 1;
    //             // } 
    //             if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
    //               //$ielts = "ielts";
    //              $info[$i]["ibt"] = 1;
    //               $info[$i]["pbt"] = 1;
    //             }
    //           }
    //         }
    //         else{
    //           $info[$i]["ibt"] = 0;
    //           $info[$i]["pbt"] = 0;
    //           $info[$i]["ielts"] = 0;
    //           //$info[$i]["ipk"] = 0;
    //         }


                          
    //           if(preg_match_all("#ipk#i",$find,$data2)){
    //           foreach(array_unique($data2[0]) as $value) {
    //             if(preg_match("/ipk/i",$value,$cetak1)){
    //              //$ibt = "ibt";
    //              $info[$i]["ipk"] = 1;
    //             } 
    //           }
    //         }
    //           else{
    //             $info[$i]["ipk"] = 0;
    //           }   

$ibt = array();
                            $pbt = array();
                            $ielts = array();
                            $ipk = array();

              preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
                 $ibt[] = "ibt";
                 //$info[$i]["ibt"] = 1;
                }
                if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
                  $pbt[] = "pbt";
                 //$info[$i]["pbt"] = 1;
                }
                if(preg_match("/ielts/i",$value,$cetak3)){
                  $ielts[] = "ielts";
                 //$info[$i]["ielts"] = 1;
                } 
                // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
                //   //$ielts = "ielts";
                //  $result[$i]["ipk"] = 1;
                // } 
               if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
                  $ibt[] = "ibt";
                  $pbt[] = "pbt";
                 // $info[$i]["ibt"] = 1;
                 //  $info[$i]["pbt"] = 1;
                }
              }
            
           preg_match_all("#GPA|ipk#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/GPA|ipk/i",$value,$cetak1)){
                 $ipk[] = "ipk";
                 //$info[$i]["ipk"] = "ipk";
                } 
              }
                          
               $ceks = array_values(array_unique(array_merge($ibt,$pbt,$ielts,$ipk)));

                                            //$id = $this->web;
            $info[$i]["sertifikat"] = $ceks;


                              // $ipk = array();
                              //  preg_match_all("#(ipk)(:)*\s*(minimal|minimum)*\s*([2-4])(.|,)*([0-9])\b#i",$find,$data6);
                              //   foreach(array_unique($data6[0]) as $valueX) {
                              //       //echo $valueX . "<br/>";
                              //       $ipk[] = $valueX;     
                              //     }
                              //     if(!empty($ipk)){
                              //     foreach ($ipk as $value) {
                              //           $data = ltrim(preg_replace("/(ipk|:|minimum|minimal)/i"," ",$value));
                              //      if(preg_match("/,/",$data)){
                              //             $data2 = (float)str_replace(",",".",$data);
                              //           }
                              //           else{
                              //             $data2 = $data;
                              //           }
                              //       }
                              //        $info[$i]["ipk"] = $data2;
                              //     }
                              //     else{
                              //        $info[$i]["ipk"] = 0;
                              //     }




                                      // /*JADIKAN ARRAY ATAU KOMA*/
                                          $cekd = array_unique($my_date);
                                          $info[$i]["deadline"] = $cekd[0];

                              

/*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI OPENFOR FOTO DAN KONTEN*/   $open[] = "indonesia";
                                          $info[$i]['openfor'] = array_unique($open);
                                          shuffle($pick);
                                          foreach($pick as $isi){
                                            $info[$i]['pick'] = $isi;
                                          }
                                          shuffle($picb);
                                          foreach ($picb as $isi) {
                                            $info[$i]['picb'] = $isi;
                                          }
                                          //$info[$i]['konten'] = $find;
                                          $info[$i]['konten'] = strip_tags($find,"<div><b><p><br>");
                                          //$info[$i]['konten'] = mysql_real_escape_string($find);
                                          echo "<pre>\n";
                                          echo "<h1>ini PASCA SARJANA dalam negri</h1>\n";
                                          print_r($info) ."\n";
                                          echo "</pre>";
                                    }//if
                                }/*END FOR*/
                              }//AKHIR END IF TIME


/*BEASISWA S1 TAMBHAKAN FUNGSI CRONJOBSATAU FUNGSI PENCARIAN MANUAL OLEH USER
  BAGIAN INI SEBAGAI PENANDA BATAS SCRAPPING DATA PADA WEBSITE BEASISWA
 BEASISWAPASCASARJANA LUAR NEGERI
*/


      if ($this->time==9){
        $sch4 = $data->query->results->results[3]->h3;
                                for ($i=0; $i< count($sch4); $i++){  
                                  $url2 = $sch4[$i]->a->href;
                                  $judul = $sch4[$i]->a->content;
                                  
                                  $link0 = stripslashes($url2);
                                  $judul0 = stripslashes($judul);
                                  
                                  /*PRE STEP 0 DOMAIN DAN JUDUL*/
                                  $info[$i]["domain"] = $link0;
                                  $info[$i]["id_domain"] = $this->web;
                                  //$id_url = $this->web;
                                  $id_url = "3";
                                  $info[$i]["judul"] = $judul0;
                                //   //echo $link0 .'<br />';
                              //$bads = array("Cara","Berlangganan","Daftar","Menulis");

                              //foreach ($bads as $bad) {
                               //if (strpos($judul0,$bad) == true) {  
                               if (!preg_match('/^(cara|daftar)/i', $judul)){ 
                                  $negara = array();
                                  $univ = array();
                                  $deadline = array();
                                  
                                  $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
                                       "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                                       
                                  $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
                                       "Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September",
                                       "Oktober","Nopember","Desember");

                                  $pick = array('thumb2.jpg','thumb1.jpg','thumb3.jpg');
                                  $picb = array('i2.jpg','i3.jpg','i5.jpg');
                                   
                                  //$link0= "http://www.beasiswapascasarjana.com/2015/05/beasiswa-s2-bidik-misi-keluarga-tak-mampu.html";
                                  // $info['domain'] = stripslashes($link);
                                  // $info['judul'] = 'china beasiswa';

                                  /*YQL TAHAP 2 DETAIL BEASISWA*/
                                  $path = "http://query.yahooapis.com/v1/public/yql?q=";
                                  $path .= urlencode("SELECT * FROM htmlstring WHERE url='$link0' AND xpath='//*[@class=\"post-body entry-content\"]/div[position()>1]'");
                                  //$path .= urlencode("SELECT * FROM htmlstring WHERE url='http://www.beasiswapascasarjana.com/2015/05/beasiswa-pemerintah-jiangsu-china.html' AND xpath='//*[@class=\"post hentry\"]/div[2]/div[2]'");
                                  $path .= "&format=json";
                                  $path .="&env=http://datatables.org/alltables.env";
                                  /*END YQL*/

                                  /*CURL TAHAP 2 DETAIL*/
                                  $c = curl_init();
                                  curl_setopt($c, CURLOPT_URL, $path);
                                  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                                  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                                  curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
                                  $rawdata = curl_exec($c);
                                  curl_close($c);

                                  $data = json_decode($rawdata);
                                  /*END CURL*/

                                  // // Show us the data
                                  // echo "<pre>\n";
                                  // print_r($data) . "\n";
                                  // echo "</pre>";

                                  $find = $data->query->results->result;
                                  
                                  //$find = $data['query']['results']['result'];
       /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI TIPE*/
                                          
                                          $tipe = array();
                                           preg_match_all("#(beasiswa|pertukaran pelajar|pertukaran profesional|pertukaran pemuda|fellowship)#i",$find,$data);
                                            foreach(array_unique($data[0]) as $valuey) {
                                              if(preg_match("/\bbeasiswa\b/i",$valuey,$cetak)){
                                                $tipe[] = "Beasiswa";
                                              }
                                              if(preg_match("/(pertukaran pelajar|pertukaran profesional|pertukaran pemuda)/i",$valuey,$cetak)) {
                                                $tipe[] = "pertukaran";
                                              }
                                              if(preg_match("/fellowship/i",$valuey,$cetak)) {
                                                $tipe[] = "fellowship";
                                              }
                                              echo $valuey;
                                              
                                            }
                                          $ceko = array_unique($tipe);
                                          $info[$i]["tipe"] = $ceko;
/*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI PENYEDIA*/
                                           $penyedia = array();
                                           preg_match_all("/\b(pemerintah|kementerian|bidik misi|djarum|sampoerna|erasmus mundus|Monbukagakusho|nuffic nesso|studned|fullbright|chevening)\b/i",$find,$datapx);
                                            foreach(array_unique($datapx[0]) as $valuey) {
                                              // $penyediax = preg_grep("#(kementerian|pemerintah|yayasan)\s+[a-z]{5,15}\s*[a-z]{3,15}\s*[a-z]{2,6}#i",$datapx);
                                              
                                              if(preg_match("/\b(pemerintah|kementerian)\b/i",$valuey,$cetak)){
                                                $penyedia[] = "pemerintah";
                                              }
                                              else{
                                               $penyedia[] = strtolower($valuey);
                                              }
                                              
                                           }

                                         $penyedia2 = array();
                                           preg_match_all("/\b(pemerintah|kementerian|university|lpdp|bidik misi|djarum|sampoerna|erasmus mundus|Monbukagakusho|nuffic nesso|studned|fullbright|daad|chevening)\b/i",$judul,$datapx);
                                            foreach(array_unique($datapx[0]) as $valuey) {
                                              // $penyediax = preg_grep("#(kementerian|pemerintah|yayasan)\s+[a-z]{5,15}\s*[a-z]{3,15}\s*[a-z]{2,6}#i",$datapx);
                                              
                                              if(preg_match("/\b(pemerintah|kementerian)\b/i",$valuey,$cetak)){
                                                $penyedia2[] = "pemerintah";
                                              }
                                              elseif(preg_match("/\b(university)\b/i",$valuey,$cetak)){
                                                $penyedia[] = "universitas";
                                              }
                                              else{
                                               $penyedia2[] = strtolower($valuey);
                                              }
                                              
                                           }

                                          $cekpn = array_values(array_unique(array_merge($penyedia,$penyedia2)));
                                          $info[$i]["penyedia"] = $cekpn;

   /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI JENJANG*/
                                          $s1arr = array();
                                          //$s2arr = array();
                                          preg_match_all("#\b(magister|pascasarjana|master|sarjana|diploma|doktor|doktoral|s1|s2|s3|phd|ph.d)\b#i",$find,$data2);
                                          foreach(array_unique($data2[0]) as $value) {
                                            if(preg_match("/program s2/i",$value,$cetak)||preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak)){
                                              $s1arr[] = "Master";
                                            }
                                            elseif(preg_match("/program s1/i",$value,$cetak)|| preg_match("/s1/i",$value,$cetak) || preg_match("/bachelor/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) ){
                                              $s1arr[] = "Sarjana";     
                                            }
                                            elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak)|| preg_match("/s3/i",$value,$cetak) || preg_match("/ph(.)*d(.)*/i",$value,$cetak) || preg_match("/\bdoktor\b/i",$value,$cetak)){
                                              $s1arr[] = "Doktor";     
                                                    }
                                            
                                            
                                          }     
                                                /*JADIKAN ARRAY ATAU KOMA*/
                                                //if(!empty($s1arr)){
                                                $cekj = array_values(array_unique($s1arr));

                                                //$id = $this->web;
                                                 $info[$i]["jenjang"] = jenjangid($cekj);
                                                 //$info[$i]["jenjang2"] = $cekj;
   /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI JURUSAN*/

                                          $jurusan = array();
                                          $jurf = array();
                                          $jurx = $this->jurlist($id_url);
                                          foreach ($jurx as $key => $value) {
                                            //echo $value . "<br/>";
                                            $pecah[] = $value;
                                            //$pecah = explode(",", $value);
                                            //echo $pecah . "<br/>";
                                            $gabung = implode("|", array_unique($pecah));
                                            //echo $gabung . "<br/>";
                                          }
                                          // $pecah = explode(",", $jurx);
                                          //$gabung = implode("|", $pecah);
                                          $gabungx = str_replace(",", "|", $gabung);
                                          //echo "<br/>";
                                          echo $gabungx . "<br/>";

                                          //preg_match_all("#\b(ekonomi|akuntansi|manajemen|teknik|ilmu komputer|teknologi informasi)\b#i",$find,$data3);
                                           preg_match_all("/\b(".$gabungx."sains|teknik|mipa)\b/i",$find,$data3);
                                          //preg_match_all("#\b(ekonomi|akuntansi|manajemen|teknik|ilmu komputer|teknologi informasi)\b#i",$find,$data3);
                                          //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                                          foreach(array_unique($data3[0]) as $valueX) {
                                              echo $valueX . "<br/>";
                                              // $jurusan[] = strtolower($valueX);
                                              // if(preg_match("/\b(sains|mipa)\b/i",$valueX,$cetak)){
                                              //   $jurusan[] = "pyhsics|chemistry|mathematics|biology";
                                              // }  
                                              // // if(preg_match("/\b(teknik)\b/i",$valueX,$cetak)){
                                              // //   $jurusan[] = "civil engineering|electrical|mechanical|architectural";
                                              // // }     
                                              // else{
                                                $jurusan[] = strtolower($valueX);
                                              //}
                                            }

                  //                           $jurnam = jurcon($jurfix,$id);
                  // $cekju = jurusanid($jurfix,$id_url);
                  
                  // $info[$i]["jurusanid"] = array_unique($cekju);
                  // $info[$i]["jurusan"] = array_unique($jurnam);

                                              if(!empty($jurusan)){
                                                // /*JADIKAN ARRAY ATAU KOMA*/
                                                $jurcek = cekjurusan($find,$id_url);
                                                $jurfix = array_values(array_unique($jurcek));
                                                $jurnam = jurcon($jurfix,$id_url);
                                                $cekju = jurusanid($jurfix,$id_url);
                                                $info[$i]["jurusanid"] = array_unique($cekju);
                                                $info[$i]["jurusan"] = array_unique($jurnam);
                                              }
                                              else{
                                                $jurf[] ="any subject";
                                                $jurnam = jurcon($jurf,$id_url);
                                                $cekju = jurusanid($jurf,$id_url);
                                                $info[$i]["jurusanid"] = $cekju;
                                                $info[$i]["jurusan"] = array_unique($jurnam);
                                              }

                  
                                  /*END STEP 2*/
                                  /*STEP 3 CARI NEGARA*/
                                  /*ARAY NEGARA*/
                                   // $negara = array();
                                          
 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI NEGARA*/

                                          $negaracek0 = ceknegarax($judul,$id_url);
                                          $negaracek = ceknegara($find,$id_url);
                                          $cekn = array_values(array_unique(array_merge($negaracek,$negaracek0)));
                                          $info[$i]["negara"] = array_unique(negaraid($cekn,$id_url));
                                          if(!empty($cekn)){
                                            $info[$i]["negara2"] = $cekn;
                                          }
                                          else{
                                            $univneg[]="internasional";
                                            $info[$i]["negara2"] =array_unique($univneg) ;
                                          }
/*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI UNIV*/

                                        $univ0 = array();
                                        $univ2 = array();
                                        $univ3 = array();

                                         $listu = array("MIT","harvard","stanford");
                                        foreach($listu as $data){
                                            $grouped_patterns[] = "(" . $data . ")";
                                          }
                                          $master_pattern = implode($grouped_patterns, "|");
                                         preg_match_all("#\b(universitas|institut|itb|its|ipb)\s*(".$master_pattern.")\b#i",$find,$data5);
                                         
                                         foreach(array_unique($data5[0]) as $valueX) {
                                            //echo $value . "<br/>";
                                            $univ0[] = $valueX;     
                                          }
                                        //  preg_match_all("#\b(universitas|itb|its|ipb)\s*(negeri|(a|d|sr|i|p[a-z]{6,15}))\s*[a-z]{4,15}\b#i",$find,$data5);
                                        // //preg_match_all("#\b(indonesia|uk|inggris|jerman|usa|amerika|australia|china|bali)\b#i",$find,$data4);
                                        // //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                                        // foreach(array_unique($data5[0]) as $valueX) {
                                        //     //echo $value . "<br/>";
                                        //     $univ[] = $valueX;     
                                        // }

                                        //   if(preg_match_all("#[a-z]{5,15}(of)*\s+(university|universities|collage)#i",$judul,$data5a)){
                                        // foreach(array_unique($data5a[0]) as $valueX) {
                                        //     //echo $value . "<br/>";
                                        //     $univ[] = $valueX;    
                                        //   }
                                        // }

                                          if(preg_match_all("#(university|universities|collage)+\s(of)\s[a-z]{2,15}#i",$find,$data5a)){
                                        foreach(array_unique($data5a[0]) as $valueX) {
                                            //echo $value . "<br/>";
                                            $univ2[] = $valueX;     
                                          }
                                        }

                                        if(preg_match_all("#[a-z]{5,15}(of)\s+(university|universities|collage)#i",$find,$data5a)){
                                        foreach(array_unique($data5a[0]) as $valueX) {
                                            //echo $value . "<br/>";
                                            $univ3[] = $valueX;    
                                          }
                                        }
                                          
                                              // /*JADIKAN ARRAY ATAU KOMA*/
                                              //$ceku = array_unique($univ);
                                              $ceku = array_unique(array_merge($univ,$univ0,$univ2,$univ3));
                                              //$info[$i]["univ"] = univid($ceku);
                                              $info[$i]["univ"] = $ceku;
 /*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI DEADLINE*/
                                   $my_date = array();
                                   preg_match_all("#(lambat|hingga|pendaftaran|ditutup|berakhir|sebelum)\s*([0-9]|[1-2][0-9]|3[01])\s+(januari|febuari|maret|april|mei|juni|juli|agustus|september|oktober|november|desember)\s*(2015|2016)*#i",$find,$data6);
                                    foreach(array_unique($data6[0]) as $valueX) {
                                        //echo $value . "<br/>";
                                        $deadline[] = $valueX;     
                                      }
                                      if(!empty($deadline)){
                                      foreach ($deadline as $value) {
                                            $split = preg_split('/\s+/', $value);
                                            echo $split ."<br>";
                                            $join = implode("-", $split);
                                            echo $join;
                                            $hapus = ltrim(str_replace(array("lambat",".","hingga",":","pada","tanggal","-","/","","pendaftaran","ditutup","berakhir")," ",$join));
                                            $hapus2 = str_replace($id, $en, $hapus);
                                            echo $hapus;
                                            $my_date[] = date('Y-m-d',strtotime($hapus2));
                                            echo $my_date;
                                            //echo $my_date;
                                        }
                                      }

            //                   if(preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2)){
            //   foreach(array_unique($data2[0]) as $value) {
            //     if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
            //      //$ibt = "ibt";
            //      $info[$i]["ibt"] = 1;
            //     }
            //     if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
            //       //$pbt = "pbt";
            //      $info[$i]["pbt"] = 1;
            //     }
            //     if(preg_match("/ielts/i",$value,$cetak3)){
            //       //$ielts = "ielts";
            //      $info[$i]["ielts"] = 1;
            //     } 
            //     // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
            //     //   //$ielts = "ielts";
            //     //  $result[$i]["ipk"] = 1;
            //     // } 
            //    if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
            //       //$ielts = "ielts";
            //      $info[$i]["ibt"] = 1;
            //       $info[$i]["pbt"] = 1;
            //     }
            //   }
            // }
            // else{
            //   $info[$i]["ibt"] = 0;
            //   $info[$i]["pbt"] = 0;
            //   $info[$i]["ielts"] = 0;
            //   //$info[$i]["ipk"] = 0;
            // }

            //                           if(preg_match_all("#GPA|ipk#i",$find,$data2)){
            //   foreach(array_unique($data2[0]) as $value) {
            //     if(preg_match("/GPA|ipk/i",$value,$cetak1)){
            //      //$ibt = "ibt";
            //      $info[$i]["ipk"] = 1;
            //     } 
            //   }
            // }
            //   else{
            //     $info[$i]["ipk"] = 0;
            //   }
                            $ibt = array();
                            $pbt = array();
                            $ielts = array();
                            $ipk = array();

              preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
                 $ibt[] = "ibt";
                 //$info[$i]["ibt"] = 1;
                }
                if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
                  $pbt[] = "pbt";
                 //$info[$i]["pbt"] = 1;
                }
                if(preg_match("/ielts/i",$value,$cetak3)){
                  $ielts[] = "ielts";
                 //$info[$i]["ielts"] = 1;
                } 
                // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
                //   //$ielts = "ielts";
                //  $result[$i]["ipk"] = 1;
                // } 
               if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
                  $ibt[] = "ibt";
                  $pbt[] = "pbt";
                 // $info[$i]["ibt"] = 1;
                 //  $info[$i]["pbt"] = 1;
                }
              }
            
           preg_match_all("#GPA|ipk#i",$find,$data2);
              foreach(array_unique($data2[0]) as $value) {
                if(preg_match("/GPA|ipk/i",$value,$cetak1)){
                 $ipk[] = "ipk";
                 //$info[$i]["ipk"] = "ipk";
                } 
              }
                          
               $ceks = array_values(array_unique(array_merge($ibt,$pbt,$ielts,$ipk)));

                                            //$id = $this->web;
            $info[$i]["sertifikat"] = $ceks;

                              
                              // $ipk = array();
                              //  preg_match_all("#(ipk)(:)*\s*(minimal|minimum)*\s*([2-4])(.|,)*([0-9])\b#i",$find,$data6);
                              //   foreach(array_unique($data6[0]) as $valueX) {
                              //       //echo $valueX . "<br/>";
                              //       $ipk[] = $valueX;     
                              //     }
                              //     if(!empty($ipk)){
                              //     foreach ($ipk as $value) {
                              //           $data = ltrim(preg_replace("/(ipk|:|minimum|minimal)/i"," ",$value));
                              //      if(preg_match("/,/",$data)){
                              //             $data2 = (float)str_replace(",",".",$data);
                              //           }
                              //           else{
                              //             $data2 = $data;
                              //           }
                              //       }
                              //        $info[$i]["ipk"] = $data2;
                              //     }
                              //     else{
                              //        $info[$i]["ipk"] = 0;
                              //     }

                                          // /*JADIKAN ARRAY ATAU KOMA*/
                                          $cekd = array_unique($my_date);
                                          $info[$i]["deadline"] = $cekd[0];
/*REGEX PREG_MATCH TAHAP EKSTRAKSI*/
    /*1. CARI OPENFOR,FOTO,KONTEN*/ 
                                          $open[] = "indonesia";
                                          $info[$i]['openfor'] = array_unique($open);
                                          //$info[$i]['openfor'] = "indonesia";
                                          shuffle($pick);
                                          foreach($pick as $isi){
                                            $info[$i]['pick'] = $isi;
                                          }
                                          shuffle($picb);
                                          foreach ($picb as $isi) {
                                            $info[$i]['picb'] = $isi;
                                          }
                                          $info[$i]['konten'] = mysql_real_escape_string($find);
                                          $info[$i]['picb'] = $isi;
                                          //$info[$i]['konten'] = strip_tags($find,"<div><b><p><br>");
                                          echo "<pre>\n";
                                          echo "<h1>ini PASCA SARJANA LUAR negri</h1>\n";
                                          print_r($info) ."\n";
                                          echo "</pre>";
                                    }//if
                                }/*END FOR*/
                              }//AKHIR END IF TIME

         if ($this->time==10){
           for ($i=0; $i< count($sch5); $i++){  
                  $url2 = $sch5[$i]->href;
                  $judul = $sch5[$i]->content;

            $link0 = stripslashes($url2);
            $judul0 = stripslashes($judul);
            $id_url = $this->webx;
            $info[$i]["id_domain"] = 5;
            $info[$i]['domain'] = $link0;
            $info[$i]["judul"] = $judul0;

            if (!preg_match('/^(top|link)/i', $judul)){ 
            $en=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
                                       "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                                       
                                  $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
                                       "Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September",
                                       "Oktober","Nopember","Desember");

                                  $pick = array('thumb2.jpg','thumb1.jpg','thumb3.jpg');
                                  $picb = array('i2.jpg','i3.jpg','i5.jpg');


                $list = array(
                      "satu" => "SELECT * from html WHERE url=\'$link0\' and xpath=\'//div[@class=\"entry clearfix\"]/div\'",
                      "dua" => "SELECT * FROM htmlstring WHERE url=\'$link0\' and xpath=\'//div[@class=\"entry clearfix\"]/p\'"
                    );

                    // Tampilan QUERY selengkapnya
                    $query = "SELECT * FROM yql.query.multi WHERE queries='" . implode(';', $list) . "'";
                    $path = 'http://query.yahooapis.com/v1/public/yql?q=' . urlencode($query);
                    $path .= "&format=json";
                    $path .="&env=http://datatables.org/alltables.env";

                  //set up the cURL
                  $c = curl_init();
                  curl_setopt($c, CURLOPT_URL, $path);
                  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                  curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
                           
                  // execute the cURL
                  $rawdata = curl_exec($c);
                  curl_close($c);
                           
                  // Convert the returned JSON to a PHP object
                  $data = json_decode($rawdata);

                    // Show us the data
                    // echo "<pre>\n";
                    // print_r($data). "\n";
                    // echo "</pre>";

                  $pen = $data->query->results->results[0]->div[0]->p->em;
                  $univ = $data->query->results->results[0]->div[0]->p->em->content;
                  $jenj = $data->query->results->results[0]->div[0]->p->content;
                  $deadloc = $data->query->results->results[0]->div[1]->p->content;
                  $isi = $data->query->results->results[1]->result;
              
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
                                echo $valuey;
                                
                              }
                            $ceko = array_unique($tipe);
                            $info[$i]["tipe"] = $ceko;

                /*STEP  CARI JENJANG*/
                
                   $jen = array();
                    $jen2 = array();
                    $jen3 = array();
                      /*ARRAY CEK JENJANG */
                      

                      preg_match_all("#\b(magister|master(s)*|bachelor(s)*|diploma|doktor|doctoral|phd|postgraduate|undergraduate|mba|msc)\b#i",$jenj,$data1);
                      foreach(array_unique($data1[0]) as $value) {
                        if(preg_match("/s2/i",$value,$cetak) || preg_match("/magister/i",$value,$cetak) || preg_match("/master/i",$value,$cetak) || preg_match("/\bpascasarjana\b/i",$value,$cetak) || preg_match("/postgraduate/i",$value,$cetak)){
                          $jen3[] = "Master";
                        }
                        elseif(preg_match("/bachelor(s)*/i",$value,$cetak) || preg_match("/undergraduate/i",$value,$cetak) || preg_match("/\bsarjana\b/i",$value,$cetak) || preg_match("/\bs1\b/i",$value,$cetak)){
                          $jen3[] = "Sarjana";     
                        }
                        elseif(preg_match("/doctoral/i",$value,$cetak) || preg_match("/postdocotral/i",$value,$cetak) || preg_match("/phd/i",$value,$cetak) || preg_match("/\bdoktor\b/i",$value,$cetak)){
                          $jen3[] = "Doktor";     
                        }
                        
                      }
                       
                            /*JADIKAN ARRAY ATAU KOMA*/
                            $cekj = array_unique($jen3);
                             
                             $info[$i]["jenjang"] = jenjangid($cekj);
                             

                 /*STEP  CARI UNIV*/

                 $univ2 = array();
                 $univ3 = array();
                 $uni = array();
                 if(preg_match("#(university|universities|college)#i",$univ) && !(preg_match("/press/i",$univ))){
                  $univ2[] = $univ;                      
                  // $info[$i]["univ"] = array_unique($univ2);   
                  }
                 if(empty($univ2[0])){
                    if(preg_match_all("#(university|universities|collage)+\s(of)*\s[a-z]{4,10}\w#i",$isi,$data5a)){
                                        foreach(array_unique($data5a[0]) as $valueX) {
                                            //echo $value . "<br/>";
                                            $univ3[] = $valueX;     
                                          }
                                        }
                  $info[$i]["univ"] = array_unique($univ3);
                  }
                  else{
                  $info[$i]["univ"] = array_unique($univ2);
                  }
                

                 $by = array();
                 $by2 = array();
                 $byx = array();
                 $by[] = $univ;
                 //$info[$i]["penyedia2"] = $pen; 
                 
                 if(!is_object($pen)){
                  $byx[]=$pen;
                  $info[$i]["penyedia"] = $byx;
                   //$byx = $data->query->results->results[0]->div[0]->p->em;
                   //$by2 = $byx;
                   //$info[$i]["penyedia"] = $by2; 
                 }
                 else{
                  $info[$i]["penyedia"] = $by; 
                 }
                 
                /*STEP  CARI JURUSAN*/

                   $jurusan = array();
                                          $jurf = array();
                                          $jurx = $this->jurlist($id_url);
                                          foreach ($jurx as $key => $value) {
                                            //echo $value . "<br/>";
                                            $pecah[] = $value;
                                            //$pecah = explode(",", $value);
                                            //echo $pecah . "<br/>";
                                            $gabung = implode("|", array_unique($pecah));
                                            //echo $gabung . "<br/>";
                                          }
                                          // $pecah = explode(",", $jurx);
                                          //$gabung = implode("|", $pecah);
                                          $gabungx = str_replace(",", "|", $gabung);
                                          //echo "<br/>";
                                          echo $gabungx . "<br/>";

                                           preg_match_all("/\b(".$gabungx.")\b/i",$isi,$data3);
                                          foreach(array_unique($data3[0]) as $valueX) {
                                              echo $valueX . "<br/>";
                                        
                                                $jurusan[] = strtolower($valueX);
                                              //}
                                            }

                                              if(!empty($jurusan)){
                                                // /*JADIKAN ARRAY ATAU KOMA*/
                                                $jurcek = cekjurusan($isi,$id_url);
                                                $jurfix = array_values(array_unique($jurcek));
                                                $jurnam = jurcon($jurfix,$id_url);
                                                $cekju = jurusanid($jurfix,$id_url);
                                                $info[$i]["jurusanid"] = array_unique($cekju);
                                                $info[$i]["jurusan"] = array_unique($jurnam);
                                              }
                                              else{
                                                $jurf[] ="any subject";
                                                $jurnam = jurcon($jurf,$id_url);
                                                $cekju = jurusanid($jurf,$id_url);
                                                $info[$i]["jurusanid"] = $cekju;
                                                $info[$i]["jurusan"] = array_unique($jurnam);
                                              }


     
                 /*STEP 3 CARI NEGARA*/
                 
                 $jurusan = array();
                    $listjur = array("economics","computer","engineer","law","any course");
                    //$listjurx = array("Engineer","Computer");
                    foreach ($listjur as $pattern)
                {
                  if(preg_match("/".$pattern."/i", $isi))
                  {
                    $jurusan[] = strtolower($pattern);
                    //$jurusan = cekjurusan($list);
                    // break;    
                  }elseif(preg_match("/\b".$pattern."\b/i", $isi)){
                    $jurusan[] = strtolower($pattern);
                  }
                  
                  // else
                  //   $jurusan[] = "" 
                }
                            // /*JADIKAN ARRAY ATAU KOMA*/
                            $cekju = array_unique($jurusan);
                            //$cekju2 = jurusanid($jurusan,$id_url);
                             //$info[$i]["jurusan2"] = $cekju;
                             //$info[$i]["jurusanid2"] = jurusanid($cekju,$id_url);

                //     /*END STEP 2*/

                    /*STEP 3 CARI NEGARA*/
                    /*ARAY NEGARA*/
                      $negara = array();
                      if(preg_match_all("#in\:\s*([^\;]+)\b#i",$deadloc,$data4)){
                      //preg_match_all("#\b(non|semua)\b#i",$find,$data3);
                      foreach(array_unique($data4[0]) as $valuex) {
                          //echo $value . "<br/>";
                          $value2 = str_replace(array("in",":","\n","\r","</strong>","</p"," "),".",$valuex);
                          $valuex2 = preg_replace('/[^\x20-\x7E]/','', $value2);
                          $valuex4 = str_replace("."," ", $valuex2);
                          //$valuex4 = preg_replace('/^\>[\n]/','', $valuex2);
                          //preg_match("/\b[a-z]\b/", subject)
                          //$negara[] = $valuex4;
                          $negara = ceknegara($valuex4,$id_url);
                          //$negara[] = $valuex;
                      } 
                      } 
                            // /*JADIKAN ARRAY ATAU KOMA*/
                            $cekn = array_unique($negara);
                            $info[$i]["negara"] = negaraid($cekn,$id_url);
                            $info[$i]["negara2"] = $cekn;
                    /*END STEP 3*/
                    
                    /*STEP 4 OPENFOR*/

                            $open = array();
                      if(preg_match_all("#(international|indonesia|All nationalities|overseas)\b#i",$isi,$data4)){
                      foreach(array_unique($data4[0]) as $value) {
                          echo $value . "<br/>";
                          if(preg_match("/international/i",$value)){
                                                $open[] = "semua negara";
                                              }
                                              elseif(preg_match("/indonesia/i",$value)){
                                                $open[] = "indonesia";     
                                              } 
                                               elseif(preg_match("/overseas/i",$value)){
                                                $open[] = "overseas";     
                                              } 
                                              elseif(preg_match("/all nationalities/i",$value)){
                                                $open[] = "overseas";     
                                              } 
                        } 
                      } 
                            $cekop = array_unique($open);
                            $info[$i]["openfor"] = $cekop;
                    /*END STEP 4*/

                    /*STEP 5 CARI DEADLINE*/
                    /*ARAY DEADLINE*/
                     $deadline = array();
                     //$my_date = array();
                      preg_match_all("#\b([0-9]{1}|[1-2]{1}[0-9]{1}|3[0-1]{1})\s*(january|jan|feb|febuary|mar|march|april|may|june|july|august|aug|september|sep|sept|october|oct|november|nov|des|desember|dec)\s*(2015|2016)*\b#i",$deadloc,$data6);
                      foreach(array_unique($data6[0]) as  $valueX) {
                          echo $valueX . "<br/>";
                          $deadline[] = $valueX;     
                        }
                        //$info[$i]["deadline3"] = $deadline;
                         if(count($deadline)>1){
                            $split = preg_split('/\s+/', $deadline[1]);
                                                    echo $split ."<br>";
                                                    $join = implode("-", $split);
                                                    //echo $join;
                                                    $hapus = str_replace(array("is","-")," ",$join);
                                                    //echo $hapus;
                                                    $my_date = date('Y-m-d',strtotime($hapus));
                                                    //echo $my_date;
                                                    $info[$i]["deadline"] = $my_date;
                         }
                         else{
                         if(!empty($deadline[0])){
                                                    $split = preg_split('/\s+/', $deadline[0]);
                                                    echo $split ."<br>";
                                                    $join = implode("-", $split);
                                                    //echo $join;
                                                    $hapus = str_replace(array("is","-")," ",$join);
                                                    //echo $hapus;
                                                    $my_date = date('Y-m-d',strtotime($hapus));
                                                    //echo $my_date;
                                                    $info[$i]["deadline"] = $my_date;
                                                }
                           }
                           //$info[$i]["deadline1"] = $deadline;
                           

                     /*STEP 5 CARI SERTIFIKAT*/
                    /*ARAY DEADLINE*/        
                   $ibt = array();
                                            $pbt = array();
                                            $ielts = array();
                                            $ipk = array();

                              preg_match_all("#(IBT|internet-based|internet based|PBT|Paper-based|Paper based|ITP|IELTS)#i",$find,$data2);
                              foreach(array_unique($data2[0]) as $value) {
                                if(preg_match("/(ibt|internet-based)/i",$value,$cetak1)){
                                 $ibt[] = "ibt";
                                 //$info[$i]["ibt"] = 1;
                                }
                                if(preg_match("/pbt|Paper-based|itp/i",$value,$cetak2)){
                                  $pbt[] = "pbt";
                                 //$info[$i]["pbt"] = 1;
                                }
                                if(preg_match("/ielts/i",$value,$cetak3)){
                                  $ielts[] = "ielts";
                                 //$info[$i]["ielts"] = 1;
                                } 
                                // if(preg_match("/IPK|gpa/i",$value,$cetak3)){
                                //   //$ielts = "ielts";
                                //  $result[$i]["ipk"] = 1;
                                // } 
                               if(preg_match("/TOEFL/i",$value,$cetak3) && !preg_match("/ibt/i",$value,$cetak3)  && !preg_match("/pbt/i",$value,$cetak3)){
                                  $ibt[] = "ibt";
                                  $pbt[] = "pbt";
                                 // $info[$i]["ibt"] = 1;
                                 //  $info[$i]["pbt"] = 1;
                                }
                              }
                            
                           preg_match_all("#GPA|ipk#i",$find,$data2);
                              foreach(array_unique($data2[0]) as $value) {
                                if(preg_match("/GPA|ipk/i",$value,$cetak1)){
                                 $ipk[] = "ipk";
                                 //$info[$i]["ipk"] = "ipk";
                                } 
                              }
                                          
                               $ceks = array_values(array_unique(array_merge($ibt,$pbt,$ielts,$ipk)));

                                                            //$id = $this->web;
                            $info[$i]["sertifikat"] = $ceks;

                /*STEP 5 CARI FOTO DAN ISI*/
                    /*ARAY */  
                            shuffle($pick);
                                            foreach($pick as $pisi){
                                              $info[$i]['pick'] = $pisi;
                                            }
                                            shuffle($picb);
                                            foreach ($picb as $pisi) {
                                              $info[$i]['picb'] = $pisi;
                                            }
                                           
                              $hasil = array();

                              preg_match_all('/\b(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)[-A-Z0-9+&@#\/%=~_|$?!:,.]*[A-Z0-9+&@#\/%=~_|$]/i', $isi, $result, PREG_PATTERN_ORDER);
                              if(!empty($result[0])){
                                foreach ($result[0] as $value) {
                                  if(!preg_match("/scholars4dev/i" ,$value)){
                                  $hasil[] = $value;
                                  //$info[$i]['url2'] = array_unique($hasil);
                                  }
                                }
                              }
                              else{
                                $info[$i]['more_url'] = $url2;
                              }
                              if(count($hasil)>1){
                                $idx = count($hasil)-1;
                              $info[$i]['more_url'] = $hasil[$idx];
                               }
                               else{
                               if(!empty($hasil)){
                                $info[$i]['more_url'] = $hasil[0];      
                               }
                              }
                              // $result = array_unique($result[0]);
                              // $info[$i]['url'] =$result;

                               //$info[$i]['konten'] = strip_tags($find,"<div><b><p><br>");
                              
                              $info[$i]['konten'] = mysql_real_escape_string($isi);
                            
                              /*CEK DATA*/
                              echo "INI SCHOLARS4DEV" . "\n";
                              echo "<pre>\n";
                              print_r($info) ."\n";
                              echo "</pre>";
                              }//AKHIR IF PREG MATCH
                              }//AKHIR END FOR

                              }//AKHIR END IF TIME

        return $info;
  }//END FUNCTION
}//END CLASS
?>