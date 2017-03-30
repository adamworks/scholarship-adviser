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



        return $info;
  }//END FUNCTION
}//END CLASS
?>