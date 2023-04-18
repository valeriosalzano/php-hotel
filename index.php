<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Hotel</title>
</head>

<body>
  <header>
    <h1>PHP Hotel</h1>
  </header>

  <main>

    <table class="table table-hover">
      <thead>
        <tr>
          <?php
          foreach ($hotels[0] as $key => $value) {
            $title = '';
            switch ($key) {
              case 'name':
                $title = 'Nome';
                break;
              case 'description':
                $title = 'Descrizione';
                break;
              case 'parking':
                $title = 'Parcheggio';
                break;
              case 'vote':
                $title = 'Punteggio';
                break;
              case 'distance_to_center':
                $title = 'Distanza dal centro';
                break;
              default:
                echo '$key default!';
                break;
            }
            echo "<th> $title </th>";
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $odd = true;
        foreach ($hotels as $hotel) {

          echo "<tr ".($odd? "class='table-light'":"")." >";
          $odd = !$odd;

          foreach ($hotel as $key => $value) {
            $info = '';
            switch ($key) {
              case 'parking':
                $info = $value? 'Si' : 'No';
                break;
              case 'distance_to_center':
                $info = $value.' km';
                break;
              default:
                $info = $value;
                break;
            }
            echo "<td> $info  </td>";
          }
          echo "<tr>";
        }
        ?>
      </tbody>
    </table>

  </main>

</body>

</html>