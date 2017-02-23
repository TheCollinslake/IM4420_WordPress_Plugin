<?php 
global $wpdb;

echo"<h2>Stats Plugin</h2>";

echo'<form action=" ' . esc_url( $_SERVER['REQUEST_URI']) . '"method="post">';
echo"<input type='text' name='stats'/>";
echo"<button type='submit'>Submit</button>";
echo"</form>";

if(isset($_POST['stat'])) {
    echo $_POST['stat'];
}
?>