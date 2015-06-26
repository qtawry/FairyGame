<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ProjetJeux : Formules</title>

    <link rel="stylesheet" href="../Web/public/css/bootstrap.min.css">


</head>
<body>
<p><a href="https://graphsketch.com/">Check your formule with a graph</a> </p>

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
    <div class="col-md-4">
        <h2>Damages</h2>
        <?php
        echo "<table class='table'> <tr>
                <td>Niveau Mage</td>
                <td>DPS</td>
                <td>Support</td>
                <td>Tank</td>
                </tr>";
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<td>$i</td>";
            echo '<td>' . floor(($i*3)*(100+$i)/100) . '</td>';
            echo '<td>' . floor(($i)*(100+$i)/100) . '</td>';
            echo '<td>' . floor(($i)*(100+$i)/100) . '</td>';
            echo '</tr>';
        }
        echo "</table>";
        ?>
    </div>
</div>

<h1>Missions</h1>
<div class="row">
    <div class="col-md-4">
        <h2>Difficulty mission</h2>
        <?php
        echo "<table class='table'> <tr>
                <td>Mission level</td>
                <td>HP</td>
                <td>Damages</td>
                </tr>";
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<td>$i</td>";
            //echo '<td>' . max(0,round(($l+$i)*$i)) . ' <br/> '. floor(pow($i,1.44)).'</td>';
            echo '<td>'. floor(pow($i,1.82)). '</td>';
            echo '<td>'. floor(pow($i,2.2)). '</td>';
            echo '</tr>';
        }
        echo "</table>";
        ?>
    </div>
</div>
<h1>Mission damages</h1>
<div class="row">
    <div class="col-md-6">
        <h2>DPS & Support damages taken per round</h2>
        <?php
        echo "<table class='table'> <tr>
                <td>Niveau Mage</td>
                <td>Miss lvl 1</td>
                <td>Miss lvl 2</td>
                <td>Miss lvl 3</td>
                <td>Miss lvl 4</td>
                <td>Miss lvl 5</td>
                <td>Miss lvl 6</td>
                <td>Miss lvl 7</td>
                <td>Miss lvl 8</td>
                <td>Miss lvl 9</td>
                <td>Miss lvl 10</td>
                </tr>";
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<td>$i</td>";
            for ($l = 1 ; $l<=10; $l++){
                //echo '<td>' . ((2*(3*$i) + 1*$i) - max(0,round(2*$l-$i)) * 3) ." <br/> " . ((2*(3*$i) + 1*$i) - max(0,round(2*$l-$i)) * 6)  . '</td>';
                echo '<td>';
                echo round(pow($l,2.2)/$i);
                echo '</td>';
            }
            echo '</tr>';
        }
        echo "</table>";
        ?>
    </div>

    <!-- Damages taken -->
    <div class="col-md-6">
        <h2>Tank damages taken per round</h2>
        <?php
        echo "<table class='table'> <tr>
                <td>Niveau Mage</td>
                <td>Miss lvl 1</td>
                <td>Miss lvl 2</td>
                <td>Miss lvl 3</td>
                <td>Miss lvl 4</td>
                <td>Miss lvl 5</td>
                <td>Miss lvl 6</td>
                <td>Miss lvl 7</td>
                <td>Miss lvl 8</td>
                <td>Miss lvl 9</td>
                <td>Miss lvl 10</td>
                </tr>";
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<td>$i</td>";
            for ($l = 1 ; $l<=10; $l++){
                //echo '<td>' . ((2*(2*$i) + 1*$i) - max(0,round(2*$l-$i)) * 3) ." <br/> " . ((2*(2*$i) + 1*$i) - max(0,round(2*$l-$i)) * 6)  . '</td>';
                echo '<td>';
                echo round(pow($l,2.2)/($i*3));
                echo '</td>';
            }
            echo '</tr>';
        }
        echo "</table>";
        ?>
    </div>
</div>
</div>

</body>
</html>