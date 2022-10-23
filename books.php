<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = 'cd6a1e66311b76b59496118be78bc469b02a0373bff6aecfe2aaf366e9b16682d1229d33d98ad10b0e2ca3161e98aad7f0b71294c2b4b579ee88f80385b16df9a5ac2ca253b2ddcf2aa8b3fffe6c3dbf1b39e4c6c503e87404d8b0f7cf409671878703c836a83ccb2ed8395545434bd2dd8e4f602d338fdce6937937172f7c64';

    try {
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
          'Authorization' => 'Bearer ' . $token,        
          'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
          'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<pre>';
        var_dump($e);
    }
    return null; 
}

$books = getBooks();
?>

<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>BOOKS IN THE BIBLE</title>
    </head>
    <body style="background-color:white">
        <div class = "container">
            <h1 style = "padding-bottom: 20px; color:black">BIBLE BOOK LIST</h1> 
            <div class = "row">
                <div class = "col-10">
                    <table class="table table-striped">
                        <tr class="table-info">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                        </tr>
                        <?php
                            foreach($books->data as $bookData) {
                            $book = $bookData->attributes;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $bookData->id; ?></td>
                            <td><?php echo $book->name; ?></td>
                            <td><?php echo $book->author; ?></td>
                            <td><?php echo $book->category; ?></td>
                        </tr>
                        
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>