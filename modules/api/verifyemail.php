<?php
	include '../../../library/config.php';

	if(isset($_GET['email']) && !empty($_GET['email'])) {

		$email = $_GET['email'];

		$q = $connection->prepare('SELECT * FROM users WHERE email = ?');

        $q->execute([$email]);

        $count = $q->rowCount();

        if($count == 1) {
      
			$statement = $connection->prepare("UPDATE users SET is_verified = 1 WHERE email = :email");
			$statement->bindValue(':email', $email);
			$statement->execute();
			echo "<script> alert('Email verified successfully! Please verify to continue!')
							var link = '../../../index.php?mod=login'
							window.location.href = link
				 </script>";
		
        }
        	echo "<script> alert('User does not exist')
        					var link = '../../../index.php'
							window.location.href = link
        		 </script>";
  
	}




?>