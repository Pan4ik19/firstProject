<form>
<div class="image-container">
    <div class="text"><h1>404</h1></div>
    <i class="ph-flying-saucer sticker"></i>
    <div class="content">
        <h2>Oops!</h2>
        <p>Are you lost in space?</p>
        <button>Back To Home</button>
    </div>
</div>
</form>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

    *{
        margin: 0;
        padding: 0;
    }
    body {
        font-family: "Poppins" ,Arial, Helvetica, sans-serif;
    }

    .image-container {
        background-image: url(https://cdn.eso.org/images/screen/eso1132e.jpg);
        position: relative;
        height: 100vh;
        width: 100%;
        overflow: hidden;
    }
    .text {
        background-color: white;
        color: black;
        font-size: 10vw;
        width: 100%;
        height: 100%;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        mix-blend-mode: screen;

    }

    .text h1{
        font-size: 24vw;
        font-weight: 500;
        position: absolute;
        bottom:0%;
        left: 50%;
        transform: translate(-50%, 30%);
    }
    .content{
        text-align: center;
        position: absolute;

        top: 35%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .content h2{
        font-size: 3vw;
    }
    button{
        width: 100%;
        margin: 20px 0;
        background-color:rgba(255, 255, 255, 0);
        border: none;
        border-radius: 8px;
        color: #000;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .sticker{
        color: rgba(0, 0, 0, 0.05);
        font-size: 250px;
        position: absolute;
        top: 50px;
        transform: rotate(-10deg);
        animation: alian 15s ease infinite;
    }
    @keyframes alian {
        0% {
            transform: rotate(-10deg);
            right: 0;
            top: 40px;
        }
        5% {
            transform: rotate(0deg);
            top: 40px
        }
        10% {
            transform: rotate(-5deg);
            top: 40px
        }
        15% {
            transform: rotate(10deg);
            top: 40px
        }
        20% {
            transform: rotate(5deg);
            right: 400px;
            top: 10px;
        }
        25% {
            transform: rotate(0deg);
            right: 400px;
            top: 200px;
        }
        30% {
            transform: rotate(-5deg);
            right: 200px;
            top: 100px;
        }
        35% {
            transform: rotate(-15deg);
            right: 200px;
            top: 100px;
        }
        45% {
            transform: rotate(15deg);
            right: 200px;
            top: 100px;
        }
        60% {
            transform: rotate(15deg);
            right: 200px;
            top: 100px;
        }
        70% {
            transform: rotate(10deg);
            right: 350px;
            top: 70px;
        }
        80% {
            transform: rotate(0deg);
            right: 20px;
            top: 200px;
        }
        90% {
            transform: rotate(10deg);
            right: 400px;
            top: 100px;
        }
        100% {
            transform: rotate(-10deg);
            right: 0;
            top: 40px;
        }
    }
</style>