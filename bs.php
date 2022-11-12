<!DOCTYPE html>
<html lang="ko">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col bg-primary">col</div>
    </div>
    <div class="row">
        <div class="col text-danger">col</div>
    </div>
    <div class="row">
        <div class="col-3">col</div>
        <div class="col-4">col</div>
        <div class="col col-md-4 bg-danger">col</div>
        <div class="col col-md-1 bg-success">col</div>
    </div>
    <div class="row">
        <div class="col-2 text-center">ID</div>
        <div class="col">
            <input type="text" name="id" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-2 text-end">PW</div>
        <div class="col">
            <input type="password" name="pass" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <button type="button" class="btn btn-primary">로그인</button>    

        </div>
    </div>
    <div class="row">
        <div class="col">col</div>
    </div>
</div>

</body>
</html>