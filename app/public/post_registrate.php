<?php
class UserRegistration
{
    private $name;
    private $email;
    private $password;

    private $errors = [];

    public function __construct($name, $email, $password)
    {
        $this -> name = $this->validateName($name);
        $this -> email = $this->validateEmail($email);
        $this -> password = $this->validatePassword($password);
    }


    public function getName()
    {
        return $this->name;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getErrors()
    {
        return $this->errors;
    }


    public function validateName($name)
    {
        $str = strlen($name);
        $pattern = "/^[a-zA-z]*$/";
        if ($str == 0 && $str < 2 ){
            $this->errors['name'] = "Error! You didn't enter the Name.";
        }elseif (!preg_match ($pattern, $name)){
            $this->errors['name'] = "Error! You didn't enter the Name.";
        }else {
            return $name;
        }


    }

    public function validateEmail($email)
    {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        if (!preg_match ($pattern, $email)){
            $this->errors['email'] = "Error! Email is not valid.";
        } else {
            return $email;
        }
    }

    public function validatePassword($password)
    {
        $len = strlen($password);
        if ($len < 4)
        {
            $this->errors['password'] = "Password is not valid";
        } else {
            return $password;
        }
    }

    public function addUserToDataBase()
    {
        if (empty($this->errors))
        {
            $pdo = new PDO("pgsql:host=db;dbname=postgres", "testuser", "qwerty");
            $pdo->exec("insert into users(name, email, password) values('$this->name','$this->email','$this->password')");
            echo "Nice";
        }
    }


}
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['psw'];

$user = new UserRegistration($name, $email, $password);
$user -> addUserToDataBase();


?>

<form>
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="name"><b>name</b></label>
        <label style="color: red">
            <b>
                <?php
                    if (!isset($user->getErrors()['name'])){
                        echo "successful";
                    }else {
                        echo $user->getErrors()['name'];
                    }

                ?>
            </b>
        </label>
        <input type="text" placeholder="Enter name" name="name" id="name" required>

        <label for="email"><b>Email</b></label>
        <label style="color: red">
            <b>
                <?php
                    if (!isset($user->getErrors()['email']))
                    {
                        echo "Successful";
                    } else {
                        echo $user->getErrors()['email'];
                    }
                ?>
            </b>
        </label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="psw"><b>Password</b></label>
        <label style="color: red">
            <b>
               <?php
                   if (!isset($user->getErrors()['password']))
                   {
                       echo "Successful";
                   } else {
                       echo $user->getErrors()['password'];
                   }
               ?>
            </b>
        </label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
        <hr>

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>

<style>
    {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>









