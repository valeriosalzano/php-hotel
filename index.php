<?php

    // DATA
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

    $filters = $_GET ?? '';

    // FUNCTIONS 
    function printTableHeadings($array){
      foreach ($array[0] as $key => $value) {
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
    }

    function printStripedTableRows($array,$filters){
      $odd = true;
          foreach ($array as $element) {
            $isStriped = $odd? 'table-secondary':'';
            $isHidden = isHidden($element,$filters)? 'd-none': '';

            echo "<tr class='".$isStriped." ".$isHidden."' >";

            if($isHidden == ''){
              $odd = !$odd;
            }

            foreach ($element as $key => $value) {
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
              echo " <td> $info  </td> ";
            }
            echo "<tr>";
          }
    }

    function isHidden($hotel,$filters){
      $hidden = false;
      if(!empty($filters)){
        foreach ($filters as $key => $filter) {
          switch ($key) {
            case 'name':
              if(!empty($filter)){
                $hidden = !str_contains($hotel[$key],$filter);
              }
              break;
            case 'vote':
              if(!empty($filter)){
                $hidden = $hotel['vote']<$filter;
              }
              break;
            case 'parking':
              $hidden = $hotel['parking'] == false;
              break;
            case 'distance_to_center':
              $hidden = $hotel['distance_to_center']>$filter;
              break;
            default:
              echo "isHidden deafult!";
              break;
          }
          if($hidden){
            //rejected
            return $hidden;
          }
        }
      }
      //approved
      return $hidden;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Hotel</title>
</head>

<body class="bg-black text-white">

  <header class="text-center">
    <h1 class="display-1 my-5 fw-5">PHP Hotel</h1>
  </header>

  <main class="container">
    <!-- FORM -->
    <form class="row row-cols-lg-auto g-3 align-items-center mb-4" method="GET">
      <div class="col-12">
        <label class="visually-hidden" for="nameFilter">Name Search</label>
        <div class="input-group">
          <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
          <input type="text" class="form-control" id="nameFilter" name="name" placeholder="Cerca per nome...">
        </div>
      </div>

      <div class="col-12">
        <label class="visually-hidden" for="voteFilter">Rating</label>
        <select class="form-select" id="voteFilter" name="vote">
          <option selected value="">Punteggio...</option>
          <?php
            for ($i=1; $i<=5; $i++){
              echo "<option value='$i'>$i</option>";
            }
          ?>
        </select>
      </div>

      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="parkingFilter" name="parking">
          <label class="form-check-label" for="parkingFilter">
            Parcheggio
          </label>
        </div>
      </div>

      <div class="col-12">
        <label for="distanceFilter" class="form-label">Distanza dal centro (0 - 50km)</label>
        <input type="range" class="form-range" id="distanceFilter" min="0" max="50" name="distance_to_center" value="50">
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <div class="col-12">
        <button type="reset" class="btn btn-warning">Reset</button>
      </div>
    </form>
    
    <!-- TABLE -->
    <div class="border border-2 rounded-2 overflow-hidden border-dark">
      <table class="table mb-0 table-light" >
        <thead>
          <tr>
            <?php
              printTableHeadings($hotels);
            ?>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php
            printStripedTableRows($hotels,$filters);
          ?>
        </tbody>
      </table>
    </div>

  </main>

</body>

</html>