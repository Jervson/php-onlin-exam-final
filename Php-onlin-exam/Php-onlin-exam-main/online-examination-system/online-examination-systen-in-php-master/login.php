session_start();

if(isset($_SESSION["email"])){
    session_destroy();
}

include_once 'dbConnection.php';
$ref= (isset($_GET['q'])? $_GET['q']: 'index.php');
$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($con,"SELECT name FROM users WHERE email = '$email'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    if(password_verify($password, $row['password'])){
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        header("location:account.php?q=1");
    }else{
        header("location:$ref?w=Wrong Username or Password");
    }
}else{
    header("location:$ref?w=Wrong Username or Password");
}