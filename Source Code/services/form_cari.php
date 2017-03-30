
<!DOCTYPE HTML>
<html>
<head>
	<title>TEST HYBRID</title>
	
	<script src="jquery-1.4.js"></script>							<!-- memanggil script js jquery min-->
	<script type="js/javascript">
		$(document).ready(function(){
			$("form#search-form").submit(function(){
				$("#search-text").animate({"width":"230px"});
				$.ajax({
					type :'POST',
					url : 'http://localhost/skripsiku/scholar/Scholarapp/services/cari.php',
					data : $(this).serizialize(),
					succes:function(data){
						$("#hasilnya").html(data);
						$("#hasilnya").fadeIn();
						$("#search-text").html("<a href='#' id='search-again'> cari lagi </a>");
					}
				});
				return false;
			});
			$("#search-again").live("click",function(){
				$("#search-text").html("pencarian");
				$("#search-text").animate({"width":"230px"});
				$("#search-form").fadeIn();
			});
		});
	</script>
</head>

<body>
		<div id="container">	
		<!--bagian Header dokumen htmlnya -->
		<!-- bagian konten login htmlnya -->
			<div id="search-box">	
				<span id="search-text"></span>
				<form id="search-form">
				<!--input type="search" name="search" id="search" placeholder="Search for content..."-->
					<input type="text" name="kata" id="input-text" />
				</form>
			</div>
			
			<div id="hasilnya"></div>
		
		</div>
</body>
</html>
