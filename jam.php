<!DOCTYPE html>
<html>
<head>
<title>MEMBUAT IGITAL SENDIRI</title>
<?php echo(1+3); ?>
<script type="text/javascript">
 window.onload = function() { jam(); }

 function jam() {
  var e = document.getElementById('jam'),
  d = new Date(), h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());

  e.innerHTML = h +':'+ m +':'+ s;

  setTimeout('jam()', 1000);
 }

 function set(e) {
  e = e < 10 ? '0'+ e : e;
  return e;
 }
</script>
</head>
<body>
<p>Hello Semua !,, Saya sedang belajar Git</p>
<p>Belajar git ternyata cukup menyenangkan</p>
<center>
<h4 style="font-size: 20px; font-family: verdana;" id="jam"></h4>
</center>
</body>
</html>
