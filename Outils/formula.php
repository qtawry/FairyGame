<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ProjetJeux : installation</title>

    <link rel="stylesheet" href="../Web/public/css/bootstrap.min.css">


</head>
<body>

<h1>Batiments</h1>

<div class="row">
    <div class="col-md-3">
        <h2>Bar</h2>
        <?php
        $or = 1000;
        $influence = 100;
        echo "<table class='table'> <tr>
    <td>Niveau</td>
    <td>Or</td>
    <td>Influence</td>
    </tr>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>" . round($or * (pow(1.60, ($i - 1)))) . "</td>";
                echo "<td>" . round($influence * (pow(1.42, ($i - 1)))) . "</td>";
                echo '</tr>';
            }
            echo "</table>";
            ?></div>


        <div class="col-md-3">
            <h2>Dortoir</h2>
            <?php
            $or = 1000;
            echo "<table class='table'>
                <tr>
                    <td>Niveau</td>
                    <td>Or</td>
                    <td>Influence</td>
                </tr>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>" . round($or * (pow(1.27, ($i - 1)))) . "</td>";
                echo "<td>0</td>";
                echo '</tr>';
            }
            echo "</table>";
            ?>
        </div>


        <div class="col-md-3">
            <h2>Tableau de missions</h2>
            <?php
            $or = 1000;
            $influence = 100;
            echo "<table class='table'> <tr>
    <td>Niveau</td>
    <td>Or</td>
    <td>Influence</td>
    </tr>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>" . round($or * (pow(1.5, ($i) - 1))) . "</td>";
                echo "<td>" . round($influence * (pow(1.42, ($i - 1)))) . "</td>";
                echo '</tr>';
            }
            echo "</table>";
            ?>
        </div>


        <div class="col-md-3">
            <h2>Marchand</h2>
            <?php
            $or = 10000;
            $influence = 10000;
            echo "<table class='table'> <tr>
    <td>Niveau</td>
    <td>Or</td>
    <td>Influence</td>
    </tr>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>" . round($or * (pow(2, ($i) - 1))) . "</td>";
                echo "<td>" . round($influence * (pow(2, ($i - 1)))) . "</td>";
                echo '</tr>';
            }
            echo "</table>";
            ?>
        </div>
    </div>
    <h1>Mage</h1>

    <div class="row">

        <div class="col-md-3">
            <h2>XP</h2>
            <?php
            echo "<table class='table'> <tr>
                <td>Niveau</td>
                <td>XP total</td>
                <td>XP to level up</td>
                </tr>";
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>" . round(100 * (pow(2, ($i) - 1))) . "</td>";
                if ($i == 1)
                    echo "<td>" . round(100 * (pow(2, ($i) - 1))) . "</td>";
                else
                    echo "<td>" . (round(100 * (pow(2, ($i) - 1))) - round(100 * (pow(2, ($i) - 2)))) . "</td>";
                echo '</tr>';
            }
            echo "</table>";
            ?>
        </div>
    </div>
</div>
</body>
</html>