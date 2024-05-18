<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #33ccff;
            padding-top: 20px;
            padding-left: 20px;
            color: white;
        }

        .sidebar a {
            display: block;
            padding: 10px 0;
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .content {
            margin-left: 280px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h1><?php echo $dashboard; ?></h1>
        <a href="#create">Create</a>
        <a href="#read">Read</a>
        <a href="#update">Update</a>
        <a href="#delete">Delete</a>
        <a href="logout.php">Logout</a>
    </div>