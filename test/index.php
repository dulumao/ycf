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
  <input type="text" name="dfsCdn" value="cd5"><br><br>
  <input type="text" name="cityCode" value="100100"><br>六位数字字符<br>
  <input type="text" name="productId" value="232323"><br>酒景id<br>
  <input type="text" name="dfsPrivate" value="1"><br>是否公开<br>
  <input type="text" name="dfsTag" value='{"scenic":故宫,"className":"景点"}'><br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>