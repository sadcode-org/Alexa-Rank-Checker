<?php
function alexaRank($url)
{
 $alexaData = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
 $alexa['globalRank'] =  isset($alexaData->SD->POPULARITY) ? $alexaData->SD->POPULARITY->attributes()->TEXT : 0 ;
 $alexa['CountryRank'] =  isset($alexaData->SD->COUNTRY) ? $alexaData->SD->COUNTRY->attributes() : 0 ;
 return json_decode(json_encode($alexa), TRUE);
}
 
if(isset($_GET['siteinfo']))
{
 $url = $_GET['siteinfo'];
 $alexa = alexaRank($url);
 $globalRank ="Global Alexa Rank of ".$_GET['siteinfo']." is : ".$alexa['globalRank'][0];
 $countryRank ="Alexa Rank In ".$alexa['CountryRank']['@attributes']['NAME']." is : ".$alexa['CountryRank']['@attributes']['RANK'];
}
?>
 
<html>
<head>
<title>Alexa Rank Checker By SadCode</title>
<style>
body
{
 text-align:center;
 width:100%;
 margin:0 auto;
 padding:0px;
 font-family:helvetica;
 background-color:#424242;
}
#wrapper
{
 text-align:center;
 margin:0 auto;
 padding:0px;
 width:995px;
}
#rank_form p
{
 color:white;
 font-size:16px;
 font-weight:bold;
}
#rank_form input[type="text"]
{
 width:250px;
 height:40px;
 border:none;
 padding-left:10px;
 font-size:16px;
}
#rank_form input[type="submit"]
{
 background-color:#2E2E2E;
 height:42px;
 border:none;  
 color:white;
 width:50px;
 font-size:16px;
}
.rank_para
{
 color:white;
}
 </style>
 
</head>
<body>
<div id="wrapper">
 
 <form method="get" id="rank_form">
  <p>Website Yang Mau Di Cek</p>
  <input type="text" name="siteinfo" placeholder="https://example.com" required="required"/>
  <input type="submit" value="Find">
</form>
 
 <p class="rank_para"><?php echo $globalRank; ?></p>
 <p class="rank_para"><?php echo $countryRank;?></p>
 
</div>
</body>
<center>Copyright By SadCode</center>
</html>
