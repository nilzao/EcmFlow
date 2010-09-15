<?php
header("Content-type: text/xml; charset=UTF-8");
header("pragma: no-cache");
header("cache-control: no-cache");
$total=$knl_helper->getVar("total");
print '<?xml version="1.0" encoding="UTF-8"?>';
echo '<pendencias>
<total id="totalpendencias">'.$total.'</total>
</pendencias>';
?>