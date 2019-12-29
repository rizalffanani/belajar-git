<?php
$IP  = "192.168.1.201"; //isi dengan ip fingerprint
$Key = "0";

$Connect = fsockopen($IP, "4370", $errno, $errstr, 1);
if ($Connect) {
  $soap_request = "<GetAttLog>
    <ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
    <Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
  </GetAttLog>";

  $newLine = "\r\n";
  fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
  fputs($Connect, "Content-Type: text/xml".$newLine);
  fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
  fputs($Connect, $soap_request.$newLine);
  $buffer = "";
  while($Response = fgets($Connect, 1024)) {
    $buffer = $buffer.$Response;
  }
} else echo "Koneksi Gagal";

$buffer = Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
$buffer = explode("\r\n",$buffer);
print_r($buffer);

for ($a=0; $a<count($buffer); $a++) {
  $data=Parse_Data($buffer[$a],"<Row>","</Row>");

  $export[$a]['1'] = Parse_Data($data,"","");
  $export[$a]['2'] = Parse_Data($data,"","");
  $export[$a]['3'] = Parse_Data($data,"","");
}
echo '<pre>';
print_r($export);

function Parse_Data ($data,$p1,$p2) {
  print($data);
  $data = " ".$data;
  $hasil = "";
  $awal = strpos($data,$p1);
  if ($awal != "") {
    $akhir = strpos(strstr($data,$p1),$p2);
    if ($akhir != ""){
      $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
    }
  }
  return $hasil;    
}
?>