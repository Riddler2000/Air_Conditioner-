<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>name</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- StyleSheet -->
    <link rel="stylesheet" href="./CSS/styles.css" />
    <link rel="stylesheet" href="./CSS/all.min.css">
    <style>
    * {
        box-sizing: border-box;
    }

    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 280px;
    }

    /* The popup form - hidden by default */
    .form-popup {
        display: none;
        position: fixed;
        bottom: 0px !important;
        right: 15px !important;
        border: 3px solid #f1f1f1;
        z-index: 30 !important;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=number],
    .form-container input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
        border-radius: 10px;
        width: 100%;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=number]:focus,
    .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover,
    .open-button:hover {
        opacity: 1;
    }

    .m98 {
        width: 500px;
        height: 500px;
        overflow: auto;
    }
    </style>
</head>

<body>
    <div class="popup">
        <div id="myForm">
            <form action="./index.php" method="POST" class="form-container">
                <h1>custom</h1>
                <input type="number" name="Tempmin" id="" placeholder="Temperature °C MIN">
                <input type="number" name="Tempmax" id="" placeholder="Temperature °C MAX">
                <input type="number" name="Hummin" id="" placeholder="Humidity % MIN ">
                <input type="number" name="Hummax" id="" placeholder="Humidity % MAX ">
                <button type="submit" class="btn">Go</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="nav">
        <div class="nav__center container">
            <div class="nav__logo" onclick="home()">
                <h1><span>Air</span>Conditioner</h1>
            </div>

            <ul class="nav__list">
                <div class="cart__icon">
                    <h2>Region : </h2>
                </div>
                <select name="countries" id="countries">
                    <option value="none" selected>None</option>
                    <?php
                     require 'conn.php';
                      $q = "SELECT * FROM Region";
  $result = $conn->query($q);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
echo '
  <option value="'.$row['name'].'">'.$row['name'].'</option>
';
}
}

                    
                    ?>
                    <option value="custom">custom</option>
                </select>

                <div class="hamburger">
                    <svg>
                        <use xlink:href="./images/sprite.svg#icon-menu"></use>
                    </svg>
                </div>
        </div>
    </nav>
    <!-- Navigation -->
    <section class="products">
        <div class="product__center">
            <div class="product">
                <?php                       
            $sq="SELECT * FROM prodect where id=".$_GET['id'];
                    $result1 = $conn->query($sq);
                    if ($result1->num_rows > 0) {
                    $i=0;
                    while ($row = $result1->fetch_assoc()) {
                                            echo ' <h1>'.$row['name'].'</h1>
                <div class="product__footer">

                    <div class="tag">
                        
                                <span>'.$row['tempmin'].' °C -'.$row['tempmax'].' °C </span>
                                <span>'.$row['hummin'].' % -'.$row['hummax'].' % </span>
                    </div>
                </div>
                <div class="image__container">
                    <img src="'.$row['image'].'" alt="" />
                </div>
                <h3>suitable countries</h3>
                <div class = "m98">
                <h5>
                    <ul>';
                                            $q = "SELECT * FROM Region where  (tempmin>=".$row['tempmin']." and tempmax<=".$row['tempmax'].")and( hummin >=".$row['hummin']."
                    and hummax<=".$row['hummax']." )";
  $result = $conn->query($q);
if ($result->num_rows > 0) {
while ($row1 = $result->fetch_assoc()) {
echo'
   <li>'.$row1['name'].'</li>
                    ';
            }
           echo '</ul>
                </h5>
                </div>
            </div>';
}
                    }
                    }
                    ?>
    </section>
    <script type="text/javascript">
    function home() {
        window.location = ('http://localhost//Air_Conditioner/');
    }
    const countries = document.getElementById("countries");
    countries.onchange = function() {
        if (countries.value === "custom") {
            openForm()
        } else if ((countries.value === "None")) {
            window.location = ('http://localhost//Air_Conditioner/');
        } else {
            window.location = ('http://localhost//Air_Conditioner/?countries=' + countries.value);
        }

    }

    function openForm() {
        document.getElementById("myForm").style.display = "block ";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
    </script>

</body>

</html>