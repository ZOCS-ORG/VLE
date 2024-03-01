
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
</head>

<body>

    <div class="container">
        <h1>:(</h1>
        <!-- <br> -->
        <h2>A <span>404</span> error occured, Page not found, check the URL and try again.</h2><br><br>
        <h3><a href="javascript:history.back()">Go Back</a></h3>
    </div>

</body>

</html>


<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:300');

    body {
        background: #3498DB;
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
    }

    .container{
        width: 100%;
        height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    h1 {
        font-size: 20vh;
    }

    h2 span {
        font-size: 4rem;
        font-weight: 600;
    }

    a:link,
    a:visited {
        text-decoration: none;
        color: #fff;
    }

    h3 a:hover {
        text-decoration: none;
        background: #fff;
        color: #3498DB;
        cursor: pointer;
    }
</style>