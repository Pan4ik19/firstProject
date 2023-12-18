
    <div class="container">
        <div class="card">
            <h2>Login Form</h2>
            <form action="/login" method="post">
                <label for="username">Username</label>

                <input type="text" id="username" name="email" placeholder="Enter your username">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">

                <button type="submit" >Login</button>

                <label for="username" style="color: red">
                    <?php
                    if(isset($loginFlag)){
                        if(!$loginFlag ){
                            echo "Error username is not found";
                        }
                    }
                    ?>
                </label>
            </form>
            <div class="switch">Don't have an account? <a href="/registrate" >Register here</a></div>
        </div>
    </div>


<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .card {
        width: 300px;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h2 {
        color: #007BFF;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        text-align: left;
        margin-bottom: 5px;
    }

    input {
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        padding: 10px;
        background-color: #04AA6D;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .switch {
        margin-top: 15px;
        font-size: 14px;
    }

    .switch a {
        color: #007BFF;
        text-decoration: none;
    }

</style>


