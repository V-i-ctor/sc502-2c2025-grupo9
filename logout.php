<?php
// ==========================
// logout.php
// Página de cierre de sesión
//   ╱|、
//  (˚ˎ 。7  
//  |、˜〵          
//  じしˍ,)ノ
// ==========================

session_start();
session_unset(); 
session_destroy(); 
header("Location: index.php"); 
exit();
?>