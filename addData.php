<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- StyleSheet -->
    <link rel="stylesheet" href="./CSS/styles.css" />
    <link rel="stylesheet" href="./CSS/all.min.css">
    <style>
    input {
        width: 100%;
        padding: 20px;
        border-radius: 10px;
        font-size: 20px;
        margin: 5px;
        font-weight: 700;
        text-align: center;
        color: #ddd;
        background-color: #333;
    }

    input[type=button] {
        color: #ddd;
        background-color: rgb(76, 66, 170);
    }

    .active {
        color: red !important;
    }
    </style>
    <title>add</title>
</head>

<body>
    <div class="nav">
        <div class="nav__center container">
            <div class="nav__logo" onclick="home()">
                <h1><span>Air</span>Conditioner</h1>
            </div>
            <?php
            if(isset($_POST['name'])&&isset($_POST['Hummin'])&& isset($_POST['Hummax'])&&isset($_POST['Tempmin'])&&isset($_POST['Tempmax'])){
require 'conn.php';
$q = "INSERT INTO ".$_POST['database']."(
    `name`,
    `tempmin`,
    `tempmax`,
    `hummin`,
    `hummax`,
    `image`
)
VALUES(
    '".$_POST['name']."',
    ".$_POST['Tempmin'].",
    ".$_POST['Tempmax'].",
    ".$_POST['Hummin'].",
    ".$_POST['Hummax'].",
    '".$_POST['scrimage']."'
)";
        mysqli_query($conn,$q);
        $conn->close();
}
?>
            <ul class="nav__list">
                <div class="cart__icon">
                    <h2 id="con1">Region</h2>
                    <h2 class="active" id="con2">prodect</h2>
                    <div class="hamburger">
                        <svg>
                            <use xlink:href="./images/sprite.svg#icon-menu"></use>
                        </svg>
                    </div>
                </div>
        </div>
    </div>
    <section class="products">
        <div class="product__center">
            <!-- Single Product -->
            <div class="product">
                <form action="./addData.php" method="post">
                    <input type="text" name="name" id="" placeholder="name">
                    <input type="file" name="iamge" id="filepath">
                    <input type="hidden" name="database" value="prodect" id="datas">
                    <input type="hidden" name="scrimage" id="srcimd">
                    <input type="number" name="Tempmin" id="" placeholder="Temperature °C MIN">
                    <input type="number" name="Tempmax" id="" placeholder="Temperature °C MAX">
                    <input type="number" name="Hummin" id="" placeholder="Humidity % MIN ">
                    <input type="number" name="Hummax" id="" placeholder="Humidity % MAX ">
                    <input type="submit" value="" id="even" hidden>
                    <input type="button" value="Add prodect" name="event" id="eve">
                </form>
            </div>
        </div>
    </section>
    <script>
    function home() {
        window.location = ('http://localhost:2222//Air_Conditioner/');
    }
    document.getElementById('eve').onclick = function() {
        document.getElementById('even').click();
    }
    const filepath = document.getElementById("filepath");
    const image = document.getElementById("srcimd");
    const c1 = document.getElementById("con1");
    const c2 = document.getElementById("con2");
    const databasemy = document.getElementById("datas");
    const eve = document.getElementById("eve");
    filepath.addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            image.value = reader.result;
        });
        reader.readAsDataURL(this.files[0]);
    });
    c1.onclick = function() {
        c2.classList.remove('active');
        c1.classList.add('active');
        filepath.hidden = true;
        databasemy.value = "Region";
        eve.value = "Add Region";
    }
    c2.onclick = function() {
        c1.classList.remove('active');
        c2.classList.add('active');
        filepath.hidden = false;
        databasemy.value = "prodect";
        eve.value = "Add prodect";
    }
    </script>

</body>

</html>