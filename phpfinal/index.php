<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
            <?php endif; ?>
	<div class="box">
		<form autocomplete="off" method="post" action="login.php">
			<h2>Login</h2>
            <?php
                        if (isset($_GET['error'])) {
                            echo '<div class="alert alert-danger" role="alert">Invalid username or password.</div>';
                        }
                        ?>
			<div class="inputBox form-group">
				<input type="text" class="form-control" id="username" name="username" required>
				<span>Userame</span>
				<i></i>
			</div>
			<div class="inputBox form-group">
				<input type="password"  class="form-control" id="password" name="password" required>
				<span>Password</span>
				<i></i>
			</div>
            <br>
			<input type="submit" value="Login">
    </form>
		</form>
	</div>
</body>
</html>