<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff; 
        }
        .navbar-brand img {
            height: 40px; 
        }
        .navbar-nav .nav-link {
            color: #ffffff; 
        }
        .navbar-nav .nav-link:hover {
            color: #ffd700; 
        }
        .search-form {
            flex-grow: 1; 
        }
        .search-input {
            width: 300px; /
        }
        .btn-outline-success {
            margin-left: 0.5rem;
        }
        .logo {
            width: 75px;
            height: 75px;
        }
        .btn-outline-danger {
            background-color: #e00404; 
            border: none; 
            color: #ffffff; 
        }
        .justify-content-between {
            justify-content: space-between; 
        }
        .form-control, .mr-2 ,.search-input{
            margin-left: 0.5rem;
            padding: 1rem;
            width: 10rem;
            
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark justify-content-between">
        <a class="navbar-brand" href="index.php">
            <img src="https://www.shutterstock.com/image-vector/judge-hammer-icon-vector-design-600nw-1707322342.jpg" class= "logo" alt="Logo"> 
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
            </ul>
            <form class="form-inline search-form" method='POST'>
                <input class="form-control mr-2 search-input" type="text" name="itemName" required placeholder='Search an Item'>
                <button class="btn btn-outline-light" type="submit" name='search'>Search</button>
            </form>
            <div class="ml-3">
                <h5 class="text-white d-inline">Welcome, <?php echo "{$_COOKIE['user_first_name']}"; ?></h5>
                <form method='POST' class="d-inline">
                    <input type="submit" value="+" class="btn btn-outline-success" name='addItem'>
                    <input type="submit" value="Sign Out" class="btn btn-outline-danger" name='signOut'>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="text-right">
            <form action="#" method="post" class="d-inline">
                <input type="submit" value='Sort By Price' name='price' class="btn btn-primary">
                <input type="submit" value='Sort By Categories' name='category' class="btn btn-primary">
            </form>
            <?php
                if(isset($_POST['price'])){
                    header('location:sortedbyprice.php');
                }if(isset($_POST['category'])){
                    header('location:sortedbycategories.php');
                }
            ?>
        </div>
        <div class="mt-3">
            <form action="#" method="post" class="d-inline">
                <input type="submit" value='About Us' name='about' class="btn btn-primary">
                <input type="submit" value='Contact Us' name='contact' class="btn btn-primary">
                <input type="submit" value='Privacy Policy' name='privpol' class="btn btn-primary">
            </form>
            <?php
                if(isset($_POST['about'])){
                    header('location:about.php');
                }if(isset($_POST['privpol'])){
                    header('location:privacy.php');
                }if(isset($_POST['contact'])){
                    header('location:contact.php');
                }
            ?>
        </div>
 </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>