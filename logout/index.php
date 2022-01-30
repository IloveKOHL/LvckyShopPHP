<?php
// Start the session
session_name('lwshop');
session_start();
?>
<?php
session_destroy();
header("Location: ../");
?>