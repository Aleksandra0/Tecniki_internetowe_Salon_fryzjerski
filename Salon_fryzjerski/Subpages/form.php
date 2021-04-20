<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="author" content="Aleksandra Borkowska"/>
        <link rel="stylesheet" href="../CSS/main_page.css">
        <link rel="stylesheet" href="../CSS/form.css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <title>Rejestracja na wizytę</title>
        <script src="../Scripts/form_validation.js"></script> 
    </head>
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

        $query_exists = "SELECT 1 FROM wizyty";
        $query_create = "CREATE TABLE wizyty (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            phone VARCHAR(15),
            date_of_visit VARCHAR(10),
            hour VARCHAR(5),
            type_of_visit VARCHAR(30)
            )";
        
        //Utworzenie tabeli Newsletter jeżeli nie istnieje
        if ($connection->query($query_exists) === FALSE) {
            if($connection->query($query_create) === FALSE)
            {
                print("Błąd tworzenia tabeli: ".$connection->error);
            }
        }  
        $query_taken = "SELECT date_of_visit, hour FROM wizyty";
        $result_taken = $connection->query($query_taken);
        $message="";
        if ($result_taken->num_rows > 0)
        {
        while($row = $result_taken->fetch_assoc())
        {
            $message = $message.$row['date_of_visit'].": ".$row['hour']."\n";
        }
        }
        else{
            $message="Brak zajętych terminów";
        }
    ?>
    <body>
        <div class="back">
            <button class="button"> <a href="../index.html"> Powrót do strony głównej </a></button>
        </div>
        <div class="subtitle">
            <h2> Zarejestruj się </h2>
        </div>
        <div id="form_area">
            <form method="get" action="<?php print($_SERVER['PHP_SELF']);?>">
                <div class="inputs">
                <div class="inputs_column">
                    <label> Imię: <input type="text" name="firstname" id="firstname"  value="<?php echo isset($_GET["firstname"]) ? $_GET["firstname"] : ''; ?>" required/> </label>
                    <label> Nazwisko: <input type="text" name="surname" id="surname" value="<?php echo isset($_GET["surname"]) ? $_GET["surname"] : ''; ?>"  required/> </label>
                    <label> Email: <input type="email" name="email" id="email" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : ''; ?>" required/> </label>
                    <label> Telefon kontaktowy: <input placeholder="bez +48" type="tel" name="phone" id="phone" value="<?php echo isset($_GET["phone"]) ? $_GET["phone"] : ''; ?>" required/> </label>
                </div>
                <div class="inputs_column">
                    <label> Data wizyty: <input type="date" name="date" id="date" value="<?php echo isset($_GET["date"]) ? $_GET["date"] : ''; ?>" required/> </label>
                    <label> Godzina wizyty:
                    <select name="hour" id="hour">
                        <option>08:00</option>
		                <option>10:00</option>
		                <option>12:00</option>
                        <option>14:00</option>
                        <option>16:00</option>
	                </select>
                    </label>
                    <label> Typ wizyty:
                    <select name="type" id="type">
                        <option> Strzyżenie </option>
		                <option> Koloryzacja </option>
		                <option> Strzyżenie i koloryzacja</option>
                        <option> Modelowanie </option>
                        <option> Inna </option>
	                </select>
                    </label>
                    <label> Zajęte terminy:
                    <textarea name="taken" readonly> <?=$message?> </textarea>
                    </label>
                </div>
                </div>
                <p>Uwaga: możesz zarejestrować się najwcześniej na jutro </p>
                <input type="submit" name="submit" value="Zarejestruj się" class="button_reverse" onclick="validation()"/>
                <input type="hidden" value="0" id="val" name="val">
            </form>
        </div>
        <div id="result"></div>
    </body>
    <?php 
       if(isset($_GET['submit']))
        {
            $czy = $_GET['val'];
            if($czy == 1)
            {
                $firstname = $_GET['firstname'];
                $surname = $_GET['surname'];
                $email = $_GET['email'];
                $phone = $_GET['phone'];
                $date_of_visit = $_GET['date'];
                $hour = $_GET['hour'];
                $type_of_visit = $_GET['type'];
                
                $query1 = "SELECT * FROM wizyty WHERE date_of_visit='$date_of_visit' AND hour='$hour'";
                $result = $connection->query($query1);
                error_reporting(0);
                if ($result->num_rows == 0)
                {
                    $query2 = "INSERT INTO wizyty (firstname,lastname,email,phone,date_of_visit,hour,type_of_visit) VALUES ('$firstname', '$surtname', '$email', '$phone', '$date_of_visit', '$hour', '$type_of_visit')";
                    if($connection->query($query2) === TRUE)
                     {
                        print('<script> clean() </script>');
                         print('<p style="font-weight: bold"> Twoja wizyta na : '.$date_of_visit.' '.$hour.' - '.$type_of_visit.' - została pomyślnie zapisana w bazie. </p>');
                         print('<p style="font-weight: bold"> Dziękujemy! </p>');
                     }
                     else
                     {
                     print("Nie udało się wykonać zapytania: ".$connection->error);
                     }   
                }
                else
                {
                    print('<p style="font-weight: bold; color: tomato;"> Niestety ten termin jest już zajęty. Proszę wybrać inny termin. </p>');
                }
            }
            else
            {
                echo '<script> validation() </script>';
            }
        }
    
    ?>
</html>
