<?php 
class Admin
{
	private $db;
	public function __construct()
	{
		try 
		{
			$conn = new PDO('mysql:host=localhost;dbname=pdo', 'root', '');
			$this->db = $conn;
		}
		catch(PDOException $e)
		{
			print $e->getMessage();
			die();
		}
	}
	public function login($user, $pass, $level)
	{
		$q = $this->db->prepare("SELECT * FROM user WHERE username = :user AND level = :level ");
		$q->bindParam(':user', $user);
		$q->bindParam(':level', $level);
		try
		{
			$q->execute();
			if($q->rowCount() > 0)
			{
				$row = $q->fetch(PDO::FETCH_ASSOC);
				$hashed = $row['password'];
				if( crypt($pass, $hashed) == $hashed )
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			print $e->getMessage();
			die();
		}
	}
	public function cekSession()
	{
			if(isset($_SESSION['id']) && $_SESSION['level'] == 1 )
			{
				print 'Selamat, Anda berhasil login sebagai superuser <br/>';
				print '<a href="index.php?logout">Logout</a>';
				return true;
			} 
			else if(isset($_SESSION['id']) && $_SESSION['level'] == 2 )
			{
				print 'Selamat, Anda berhasil login sebagai admin <br/>';
				print '<a href="index.php?logout">Logout</a>';
				return true;
			} 
			else
			{
				return false;
			}
	}
}


?>
