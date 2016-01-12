<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>测试上传</h1>
<p>This is a paragraph.</p>
<form action="../index.php?act=upload" method="POST" enctype="multipart/form-data">
  上传文件:<br>
  <input type="file" name="file" value=""><br>
  自定义文件名:<br>
  <input type="text" name="lastname" value=""><br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>