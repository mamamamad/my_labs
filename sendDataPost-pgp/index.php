<?php
// minimal, safe fixes only
$name = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['data'])) {
    $name = $_POST['data'];
    if (empty($name)) {
        $message = "Name is empty";
    } else {
        $message = $name;
    }
}

// JSON POST handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['data'] ?? '';
    $response = array("message" => "Hello $name (JSON)");
    echo json_encode($response);
    die();
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Send Data</title>
</head>
<body>

<h1>Send Data</h1>

<?php
if ($message !== '') {
    echo '<p>' . $message . '</p>';
}
?>

<!-- URL-encoded form -->
<form method="POST" action="index.php">
  Name: <input type="text" name="data">
  <input type="submit" value="urlencode">
</form>

<!-- Multipart form -->
<form method="POST" action="index.php" enctype="multipart/form-data">
  Name: <input type="text" name="data">
  <input type="submit" value="multipart">
</form>

<h1>Send JSON Data (JavaScript)</h1>

<div>
    Name: <input type="text" id="js" name="javascript">
    <input type="button" value="Send JSON" onclick="sendJson()">
</div>
<p class="name"></p>

<script>
function sendJson() {
    const xx = document.getElementById("js").value;
    const data = { "data": xx };

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            console.log(response.message)
            document.getElementsByClassName('name')[0].innerHTML = response.message;
        }
    };
    xhr.send(JSON.stringify(data));
}
</script>

</body>
</html>