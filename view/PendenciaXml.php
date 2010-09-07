<?php
header("Content-type: text/xml; charset=ISO-8859-1");
header("pragma: no-cache");
header("cache-control: no-cache");
$total=$knl_helper->getVar("total");
print '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<pendencias>
<total id="totalpendencias">'.$total.'</total>
</pendencias>';
?>