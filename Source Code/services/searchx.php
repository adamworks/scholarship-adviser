
<?php
require_once ("config.php");
//require_once ("simple_html_dom.php"); // include library simple html dom
//require_once ("ambildata.php"); //include class pencari link	
//require_once ("ambildatak.php"); //include class pencari konten
require_once ("fungsidb.php"); 


if($_GET['act'] == 'grab')
{
	//declare domain
	// $domain = mysql_real_escape_string($_GET['d']);
	// if(!$domain_id = domain_exists($domain)) 
	// 	die('domain tidak ada'); //cek domain ada atau tidak di DB

	//declare kategori
	$kategori = mysql_real_escape_string($_GET['kat']);
	if(!$kategori_id = kategori_exists($kategori)) //cek kategori ada/tidak di DB
	{
		die('kategori tidak ada');
	}

	//declare kategori
	$program = mysql_real_escape_string($_GET['pro']);
	if(!$prodi_id = program_exists($program)) //cek kategori ada/tidak di DB
	{
		die('kategori tidak ada');
	}

	//declare kategori
	$negara = mysql_real_escape_string($_GET['neg']);
	if(!$negara_id = negara_exists($negara)) //cek kategori ada/tidak di DB
	{
		die('kategori tidak ada');
	}
	
	// //declare halaman/page
	// $p = (int)$_GET['p'];
	// if(!is_int($p) || $p=='') //cek input halaman
	// {
	// 	$p=1;
	// }
	
	// $p1 = (int)$_GET['p1'];
	// if(!is_int($p1) || $p1=='') //cek input halaman
	// {
	// 	$p1=1;
	// }
	
	//$update = $_GET['update'];
	
	ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36');
	ini_set('max_execution_time', 0);
	ini_set('max_input_time', 0);

	ini_set('memory_limit', '1024M');
	set_time_limit(0);

	//grablink data first
	//$web = $_GET['d'];
	$kat = $_GET['kat'];
	$pro = $_GET['pro'];
	$neg = $_GET['neg'];
	// $page = $p;
	// $jmlh_page = $p1;
	$update = $_GET['update'];

	//VERSI UPDATE (PENCARIAN MENGGUNAKAN DATABASE ATAU YQL)
	if($update == '0'){
		//$grab = new dbsearch($web, $kat, $page, $jmlh_page);
		//$link = $grab->routing();
		/* kode untuk mencari dan menampilkan */
		$beasiswa = filtersearch($kategori_id,$prodi_id,$negara_id);

		//header('Content-type: application/json');
		echo '{"items":'.json_encode($beasiswa).'}';
	}
	else if($update == '1'){
		$grab = new yqlsearch($kat,$pro,$neg);
		
		//$i = 1;
		//while ( $i<= 3) {
			$link = $grab->routing(2);
		// 	$i++;
		// }
		
	//}

		if(count($link) > 0){ 
		for ($row = 0; $row < count($link); $row++)
			{
					$beasiswa = save_konten($link[$row]['domain'],$kategori_id, $link[$row]['alamat'], $link[$row]['judul'], $link[$row]['deadline'], $link[$row]['univ'], $link[$row]['negara'],$link[$row]['konten'],$link[$row]['jurusan'],$link[$row]['thumb'],$link[$row]['image']);
						//save _img($result['image'],$imgName);
					
					//echo "sukses";
			}	

		$beasiswa = filtersearch($kategori_id,$prodi_id,$negara_id);
		$sukses = "sukses";

		//header('Content-type: application/json');
		echo '{"items":'.json_encode($beasiswa).'}';
		}

	}
	else{
			die("tidak ada url satu pun");
		}
}

	
class yqlsearch
{
	//protected $html_parser = null;
	//public $web;
	public $page;
	private $jur;
	private $neg;
	private $kat;
	//public $page;
	// public $jmlh_page;
	// public $kat;
	
	public function __construct($kat,$pro,$neg)
	{

		//untuk memanggil class simple html dom parser
		//$this->html_parser = new simple_html_dom(); 
		//$this->web = $web;
		$this->kat = $kat;
		//$this->jur = $jur;
		$this->jur = str_replace(" ","%20", $pro);
		//$this->neg = $neg;
		$this->neg = str_replace(" ","%20", $neg);
		// $this->page = $page;
		// $this->jmlh_page = $jmlh_page;
		
	}
	
	public function routing($i)
	{
		ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36');
		ini_set('max_execution_time', 0);
		ini_set('max_input_time', 0);
	
		ini_set('memory_limit', '1024M');
		set_time_limit(0);
		
		if($i == 1){
			//$this->alamat_website_kategori(1)
			$result = $this->scholarshipdb();
		}
		elseif($i == 2)
		{
			$result = $this->scholars4dev();
		}
		elseif($i == 3)
		{
			$result = $this->afterschool();
		}
		else
		{
			die("situs tidak terdaftar");
		}
		return $result;
	}

	function alamat_website_kategori($id_website){
		// $query_kategori = mysql_query('SELECT alamat_website FROM tb_kategori_website WHERE id_kategori='.$this->kategori_web.' AND id_website='.$id_website)or die(mysql_error());
		// $baris = mysql_fetch_array($query_kategori);

		$sql = mysql_query("SELECT id_url FROM db_url WHERE id_url = '$id_website'");
		if(mysql_num_rows($sql) == 1){      
			$row = mysql_fetch_row($sql);
			return $row[0];
		}
		else{
			return false;
		}
		// if(!$domain_id = domain_exists($id_website)) 
		// die('domain tidak ada'); //cek domain ada atau tidak di DB

		// return $baris['alamat_website'];			
	}

	public function scholarshipdb()
	{
		//$result = array();
		//$this->alamat_website_kategori(1)
		$kat = $_GET['kat'];
		// $jur = $_GET['jur'];
		// $neg = $_GET['neg'];
		$page = 1;
		$jmlh_page = 2;
		$result = array(array('domain'=>'','alamat'=>'','judul'=>'','deadline'=>'','univ'=>'','negara'=>'','konten'=>'','jurusan'=>'','thumb'=>'','image'=>''));
		
		while($page<=$jmlh_page)
		{
			
			if($kat == 's1')
			{
				//if($this->jur!== null || $this->neg!== null){
				$url = array();
				for ($i = 1; $i <= $page; ++$i) {
				    //$url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Undergraduate?q=".$jur."$l=".$neg."&page=" .$i. "&st=listed'";
				    $url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Undergraduate?q=".$this->jur."$l=".$this->neg."&page=" .$i. "&st=listed'";
				}
					$query = "select * from html where url in (" . implode(', ', $url) . ") and xpath='//*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[1]/h4 | //*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[2]/*'";
					$url = 'http://query.yahooapis.com/v1/public/yql?format=json&q=' . urlencode($query);

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
					
					$sch = $data->query->results->h4;
				    $univ = $data->query->results->span;
				        
			    for ($i=0; $i< count($sch); $i++){  
			            $url2 = $sch[$i]->a->href;
						$link0 = stripslashes($url2);
						$result[$i]['alamat'] = $link0;
						// $link = '/scholarships-in-United-Kingdom/Economics-Esrc-Funded-Ph-D-Studentship-Labour-Economics-Swansea-University=PIiQ2t3f5BGUNgAlkGUTnw.html';
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

						// // // Show us the data
						// echo "<pre>\n";
						// print_r($data) . "\n";
						// echo "</pre>";

						//ARRAY OBJECT TIAP DATA
						$judul = $data->query->results->results[0]->div->h1->content;
						$judul2 = mysql_escape_string($judul);
						$result[$i]['judul'] = $judul2;

						$univ = $data->query->results->results[0]->a[0]->content;
						$univ2 = mysql_escape_string($univ);
						$result[$i]['univ'] = $univ2;

						$negarauniv = $data->query->results->results[0]->a[1]->content;
						$negarauniv2 = mysql_escape_string($negarauniv);
						$result[$i]['negara'] = $negarauniv2;

						$deadline = $data->query->results->results[0]->span[2]->content;
						$deadline2 = mysql_escape_string($deadline);
						$result[$i]['deadline'] = $deadline2;

						$isi = $data->query->results->results[1]->result;
						$isi2 = mysql_escape_string($isi);
						//$isi3 = strip_tags($isi2,"<div><b><p><br>");
						$result[$i]['konten'] = $isi2;
						
						$result[$i]['domain'] = $this->alamat_website_kategori(1);
						
						$jurnew =str_replace("%20"," ",$this->jur);
						$result[$i]['jurusan'] = $jurnew;
						$result[$i]['thumb'] = 'thumb3.jpg';
						$result[$i]['image'] = 'i3.jpg';
						//$jurnew2 = mysql_escape_string($jurnew);
						
						//$result[$i]['jurusan'] = $this->jur; 
					}//end for
					//return $result;
				}//end if s1
			elseif($kat == 's2')
			{
				$url = array();
				for ($i = 1; $i <= $page; ++$i) {
				    //$url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Undergraduate?q=".$jur."$l=".$neg."&page=" .$i. "&st=listed'";
				    $url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Master?q=".$this->jur."$l=".$this->neg."&page=" .$i. "&st=listed'";
				}
					$query = "select * from html where url in (" . implode(', ', $url) . ") and xpath='//*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[1]/h4 | //*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[2]/*'";
					$url = 'http://query.yahooapis.com/v1/public/yql?format=json&q=' . urlencode($query);

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
					
					$sch = $data->query->results->h4;
				    $univ = $data->query->results->span;
				        
			    for ($i=0; $i< count($sch); $i++){  
			            $url2 = $sch[$i]->a->href;
						$link0 = stripslashes($url2);
						$result[$i]['alamat'] = $link0;
						// $link = '/scholarships-in-United-Kingdom/Economics-Esrc-Funded-Ph-D-Studentship-Labour-Economics-Swansea-University=PIiQ2t3f5BGUNgAlkGUTnw.html';
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

						// // // Show us the data
						// echo "<pre>\n";
						// print_r($data) . "\n";
						// echo "</pre>";

						//ARRAY OBJECT TIAP DATA
						//ARRAY OBJECT TIAP DATA
						$judul = $data->query->results->results[0]->div->h1->content;
						$judul2 = mysql_escape_string($judul);
						$result[$i]['judul'] = $judul2;

						$univ = $data->query->results->results[0]->a[0]->content;
						$univ2 = mysql_escape_string($univ);
						$result[$i]['univ'] = $univ2;

						$negarauniv = $data->query->results->results[0]->a[1]->content;
						$negarauniv2 = mysql_escape_string($negarauniv);
						$result[$i]['negara'] = $negarauniv2;

						$deadline = $data->query->results->results[0]->span[2]->content;
						$deadline2 = mysql_escape_string($deadline);
						$result[$i]['deadline'] = $deadline2;

						$isi = $data->query->results->results[1]->result;
						$isi2 = mysql_escape_string($isi);
						//$isi3 = strip_tags($isi2,"<div><b><p><br>");
						$result[$i]['konten'] = $isi2;
						
						$result[$i]['domain'] = $this->alamat_website_kategori(1);
						
						$jurnew =str_replace("%20"," ",$this->jur);
						$result[$i]['jurusan'] = $jurnew;
						$result[$i]['thumb'] = 'thumb2.jpg';
						$result[$i]['image'] = 'i2.png';
					}//end for
					
				}//end if s1
			elseif($kat == 's3')
			{
				$url = array();
				for ($i = 1; $i <= $page; ++$i) {
				    //$url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Undergraduate?q=".$jur."$l=".$neg."&page=" .$i. "&st=listed'";
				    $url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-PhD?q=".$this->jur."$l=".$this->neg."&page=" .$i. "&st=listed'";
				}
					$query = "select * from html where url in (" . implode(', ', $url) . ") and xpath='//*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[1]/h4 | //*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[2]/*'";
					$url = 'http://query.yahooapis.com/v1/public/yql?format=json&q=' . urlencode($query);

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
					
					$sch = $data->query->results->h4;
				    $univ = $data->query->results->span;
				        
			    for ($i=0; $i< count($sch); $i++){  
			            $url2 = $sch[$i]->a->href;
						$link0 = stripslashes($url2);
						$result[$i]['alamat'] = $link0;
						// $link = '/scholarships-in-United-Kingdom/Economics-Esrc-Funded-Ph-D-Studentship-Labour-Economics-Swansea-University=PIiQ2t3f5BGUNgAlkGUTnw.html';
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

						// // // Show us the data
						// echo "<pre>\n";
						// print_r($data) . "\n";
						// echo "</pre>";

						//ARRAY OBJECT TIAP DATA
						$judul = $data->query->results->results[0]->div->h1->content;
						$judul2 = mysql_escape_string($judul);
						$result[$i]['judul'] = $judul2;

						$univ = $data->query->results->results[0]->a[0]->content;
						$univ2 = mysql_escape_string($univ);
						$result[$i]['univ'] = $univ2;

						$negarauniv = $data->query->results->results[0]->a[1]->content;
						$negarauniv2 = mysql_escape_string($negarauniv);
						$result[$i]['negara'] = $negarauniv2;

						$deadline = $data->query->results->results[0]->span[2]->content;
						$deadline2 = mysql_escape_string($deadline);
						$result[$i]['deadline'] = $deadline2;

						$isi = $data->query->results->results[1]->result;
						$isi2 = mysql_escape_string($isi);
						//$isi3 = strip_tags($isi2,"<div><b><p><br>");
						$result[$i]['konten'] = $isi2;
						
						$result[$i]['domain'] = $this->alamat_website_kategori(1);
						
						$jurnew =str_replace("%20"," ",$this->jur);
						$result[$i]['jurusan'] = $jurnew;
						$result[$i]['thumb'] = 'thumb1.jpg';
						$result[$i]['image'] = 'i5.jpg';
					}//end for
					
				}//end if s3
			$page++;
			
			
		}//end while
		return $result;
	}//end scholarships scraping
	public function scholars4dev(){
		//$result = array();
		//$this->alamat_website_kategori(1)
		$kat = $_GET['kat'];
		// $jur = $_GET['jur'];
		// $neg = $_GET['neg'];
		$page = 1;
		$jmlh_page = 2;
		$result = array(array('domain'=>'','alamat'=>'','judul'=>'','deadline'=>'','univ'=>'','negara'=>'','konten'=>'','jurusan'=>'','thumb'=>'','image'=>''));
		
		while($page<=$jmlh_page)
		{
			
			if($kat == 's1')
			{
				//if($this->jur!== null || $this->neg!== null){
				$url = array();
				for ($i = 1; $i <= $page; ++$i) {
				    //$url[$i] = "'http://scholarshipdb.net/scholarships/Category-Scholarship/Program-Undergraduate?q=".$jur."$l=".$neg."&page=" .$i. "&st=listed'";
				    $url[$i] = "'http://www.scholars4dev.com/category/level-of-study/undergraduate-scholarships/page/".$i."/'";
				}
					//$query = "select * from html where url in (" . implode(', ', $url) . ") and xpath='//*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[1]/h4 | //*[@class=\"col-xs-12 col-sm-9\"]/ul[@class=\"list-unstyled\"]/li/div[2]/*'";
					$query = "select * from html where url in (" . implode(', ', $url) . ") and xpath='//*[@class=\"maincontent\"]/div[@class="post clearfix"]//*[@class=\"maincontent\"]/div[@class=\"post clearfix\"]'";

					$url = 'http://query.yahooapis.com/v1/public/yql?format=json&q=' . urlencode($query);

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
					
					$sch = $data->query->results->h4;
				    $univ = $data->query->results->span;
				        
			    for ($i=0; $i< count($sch); $i++){  
			            $url2 = $sch[$i]->a->href;
						$link0 = stripslashes($url2);
						$result[$i]['alamat'] = $link0;
						// $link = '/scholarships-in-United-Kingdom/Economics-Esrc-Funded-Ph-D-Studentship-Labour-Economics-Swansea-University=PIiQ2t3f5BGUNgAlkGUTnw.html';
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

						// // // Show us the data
						// echo "<pre>\n";
						// print_r($data) . "\n";
						// echo "</pre>";

						//ARRAY OBJECT TIAP DATA
						$judul = $data->query->results->results[0]->div->h1->content;
						$judul2 = mysql_escape_string($judul);
						$result[$i]['judul'] = $judul2;

						$univ = $data->query->results->results[0]->a[0]->content;
						$univ2 = mysql_escape_string($univ);
						$result[$i]['univ'] = $univ2;

						$negarauniv = $data->query->results->results[0]->a[1]->content;
						$negarauniv2 = mysql_escape_string($negarauniv);
						$result[$i]['negara'] = $negarauniv2;

						$deadline = $data->query->results->results[0]->span[2]->content;
						$deadline2 = mysql_escape_string($deadline);
						$result[$i]['deadline'] = $deadline2;

						$isi = $data->query->results->results[1]->result;
						$isi2 = mysql_escape_string($isi);
						//$isi3 = strip_tags($isi2,"<div><b><p><br>");
						$result[$i]['konten'] = $isi2;
						
						$result[$i]['domain'] = $this->alamat_website_kategori(1);
						
						$jurnew =str_replace("%20"," ",$this->jur);
						$result[$i]['jurusan'] = $jurnew;
						$result[$i]['thumb'] = 'thumb3.jpg';
						$result[$i]['image'] = 'i3.jpg';
						//$jurnew2 = mysql_escape_string($jurnew);
						
						//$result[$i]['jurusan'] = $this->jur; 
					}//end for
					//return $result;
				}//end if s1
		
	} 
	}//end class
?>