<html>
<head>
	<title>Upload Form</title>
</head>
<body>

<?php echo $error; ?>

<?php echo form_open_multipart('upload/do_upload'); ?>

<input type="file" name="userFiles[]" size="20" multiple />
<br/><br/>

<input type="submit" value="upload" />

</form>

</body>
</html>