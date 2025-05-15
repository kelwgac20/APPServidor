<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Area del triangulo rectangulo</title>
</head>
<body>
    <?php
        $cateto1=10; 
        $cateto2=15;

        $area = ($cateto1 * $cateto2) / 2;

        $hipotenusa = sqrt($cateto1**2 + $cateto2**2);
        $hipotenusa = round($hipotenusa, 2); // Redondear a 2 decimales

    ?>

    <h1>Area del triangulo</h1>
    <h2>
    cateto1 = <?php echo $cateto1?><br>
    cateto2 = <?php echo $cateto2?><br>
    </h2>
    <h1> Area = <?php echo $area; ?> </h1>
    <h1> Hipotenusa = <?php echo $hipotenusa; ?> </h1>

</body>
</html>