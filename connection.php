<?php

$connection = mysqli_connect(
    "localhost",
    "root",
    "root",
    "jobseadb",
    "8889"
);

$error = mysqli_connect_error();

if ($error != null) {
    echo "<p> Could not connect to the database. </p>";
}
