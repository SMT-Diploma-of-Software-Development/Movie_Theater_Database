<?php
require_once '../../private/initialize.php';
require SHARED_PATH . '/page_header.php';
?>
<img src='./chart.png' style='width:100%' onclick='onClick(this)' class='w3-hover-opacity' alt='Top ten Chart'>

</body>
</html>
<?php
db_disconnect($db);
?>