
<!DOCTYPE html>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <LINK href="css/materialize.min.css" rel="stylesheet" type="text/css">
    <LINK href="css/bonus.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    </head>
    <body>
        <header>
        <!-- NAV COMMENCE ICI --->
            <nav class="pink lighten-2">
            <div class="nav-wrapper">
                <span style="float:left;"><h5>Candy Rush </h5></span>
                    <a href="#!" class="brand-logo center"> <img src="lollipop.png">
                    <ul id="nav-mobile" class="right">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="logout.php">Logout</a></li>
                    </ul>
                    </div>
            </nav>
        </header>
        <!-- NAV TERMINE ICI --->
    </head>
    
        <?php if ($_SESSION["is_admin"] !=1 && $_COOKIE["is_admin"] != 1 && $_SESSION["search"] == TRUE){ ?>
        <aside>
            <?php include_once "search_form.php"; ?>
        </aside>  
    <?php };?>
    <body>
    <main>
