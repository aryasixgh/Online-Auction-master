<?php
    require_once('connection.php');
    include_once('navigation.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction - Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sulphur+Point:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/master.css">
    <style>
        body {
            font-family: 'Sulphur Point', sans-serif;
            background-color: #f8f9fa;
        }
        .itemCard {
            text-decoration: none;
            color: inherit;
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            border-radius: 10px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #28a745; /* Green color for active items */
        }
        .expired {
            color: #dc3545; /* Red color for expired items */
        }
        .active {
            color: #28a745; /* Green color for active items */
        }
        .expired, .active {
            font-weight: bold;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="body">
            <div class="row row-cols-1 row-cols-md-4">
                <?php
                    $query = "SELECT image,item_name,due_date,item_id,init_bid,current_bid FROM auction_item";
                    $result = $conn->query($query);
                    $rows = $result->num_rows;
                    if($rows >= 1){
                        while ($data = $result->fetch_assoc()){
                            $name = $data['item_name'];
                            $image = $data['image'];
                            $due_date = $data['due_date'];
                            $price = $data['current_bid'] != 0 ? $data['current_bid'] : $data['init_bid'];
                            $status = $CURRENTDATE <= $due_date ? 'active' : 'expired';
                            $statusText = $status === 'active' ? 'Active' : 'Expired';
                            $statusClass = $status === 'active' ? 'active' : 'expired';
                            $id = $data['item_id'];

                            echo '<a href="singleItem.php?itemId=' . $id . '&itemName=' . $name . '" class="itemCard">
                                    <div class="col mb-4">
                                        <div class="card">
                                            <img src="' . $image . '" class="card-img-top" alt="' . $name . '" height="300">
                                            <div class="card-body">
                                                <h5 class="card-title">' . $name . '</h5>
                                                <span class="' . $statusClass . '">' . $statusText . '</span>
                                                <h5 class="price" style="float:right;">Rs. ' . $price . '</h5>
                                            </div>
                                        </div>
                                    </div>
                                  </a>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>