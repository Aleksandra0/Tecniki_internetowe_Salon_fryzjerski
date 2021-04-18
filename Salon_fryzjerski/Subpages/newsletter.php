<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="author" content="Aleksandra Borkowska"/>
        <link rel="stylesheet" href="../CSS/main_page.css">
        <link rel="stylesheet" href="../CSS/newsletter.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <title>Zapis do newslettera</title>
    </head>
    <body>
        <div class="back">
            <button class="button"> <a href="../index.html"> Powrót do strony głównej </a></button>
        </div>
        <div class="subtitle">
            <h2> Newsletter </h2>
        </div>
        <p> Zapisz się aby otrzymać 10% zniżki </p>
        <form method="get" action="<?php print($_SERVER['PHP_SELF']); ?>">
        <div class="sign_up">
            <label> Email: <input type="email" name="email"/> </label>
            <input type="submit" name="submit" value="Zapisz się" class="button_reverse"/>
        </div>
        </form>
    </body>
    <?php 
         $servername = "localhost";
         $username = "admin";
         $password = "zaq1@WSX";
         $dbName = "albion";
  
        $connection = new mysqli($servername,$username,$password);
        if($connection->connect_error)
        {
            die("Connect failed: ".$connection->connect_error);
        }
        
        //Utworzenie bazy danych jeśli nie istnieje
        $sql = "CREATE DATABASE IF NOT EXISTS albion";
        if ($connection->query($sql) === FALSE) {
            echo "Error creating database: " . $conn->error;
        } 

        $connection->close();

        //Połączenie z bazą danych
        $connection = new mysqli($servername,$username,$password,$dbName);
        if($connection->connect_error)
        {
            die("Connect failed: ".$connection->connect_error);
        }
        

        $query_exists = "SELECT 1 FROM Newsletter";
        $query_create = "CREATE TABLE Newsletter (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(50)
            )";
        
        //Utworzenie tabeli Newsletter jeżeli nie istnieje
        if ($connection->query($query_exists) === FALSE) {
            if($connection->query($query_create) === FALSE)
            {
                print("Błąd tworzenia tabeli: ".$connection->error);
            }
        } 

        if(isset($_GET['submit']))
        {
            $email = $_GET['email'];
            
            $email_pattern = "/^[a-zA-Z0-9](.*)@[a-zA-Z0-9](.*)\.[a-zA-Z0-9]/";
            if(!preg_match($email_pattern, $email))
            {
                print('<p> Wprowadzony email jest niepoprawny </p>');
            }
            else
            {
                $query1 = "SELECT * FROM Newsletter WHERE email='$email'";
                $result = $connection->query($query1);
                error_reporting(0);
                if ($result->num_rows == 0)
                {
                   $query2 = "INSERT INTO Newsletter (email) VALUES ('$email')";
                   if($connection->query($query2) === TRUE)
                    {
                        print('<p> Twój email został zapisany. Dziękujemy! </p>');
                    }
                    else
                    {
                    print("Nie udało się wykonać zapytania: ".$connection->error);
                    }   
                }
                else
                {
                    print('<p> Jesteś już zapisany. Dziękujemy! </p>');
                }
            }
        }

        $connection->close();
    ?>
</html>