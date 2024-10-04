<?php 

class Database {

  public $pdo;

    public function __construct($db = "inlog", $user = "root", $pwd = "", $host = "localhost")
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }

    public function insertInto($email, $wachtwoord) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $sql = "INSERT INTO userInformatie(email, wachtwoord) VALUES (?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $hashedPassword]);
        header("location:inlog.php");
      }
    }

    public function inlog($email, $wachtwoord) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        session_start();
        $sql = "SELECT * FROM userInformatie WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $storedInfo = $stmt->fetch();

        if (password_verify($wachtwoord, $storedInfo['wachtwoord'])) {
          $_SESSION['email'] = $email;
          echo " <br> U bent ingelogged";
          echo " <br> $email";
        } else {
          echo "<br> incorrect informatie";
        }
      }
    }

    public function uitloggen() {
      session_start();
      session_unset();
      session_destroy();

      header("location:inlog.php");
    }
    public function Select($id = NULL) {
        if ($id) {
            $sql = "SELECT * FROM userInformatie WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
        } else {
            $sql = "SELECT * FROM userInformatie";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        }

        $table = $stmt->fetchAll();

        if ($table) {
            foreach($table as $row) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['wachtwoord']}</td>";
                echo "<td><a href='update.php?id={$row['id']}' name='update' class='btn btn-primary btn-sm'>Edit</a> <a href='delete.php?id={$row['id']}' name='delete' class='btn btn-danger btn-sm'>Delete</a></td>";
                echo "</tr>";
            } 
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------
    //nieuw code
    public function delete($id) {
      $sql = "DELETE FROM userInformatie WHERE id = ?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$id]);
    }

    public function update($email, $wachtwoord, $id) {
      $sql = "UPDATE userInformatie SET email = ?, wachtwoord = ? WHERE id = ?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$email, $wachtwoord, $id]);
      header("location:index.php");
    }
}

$db = new Database();

?>