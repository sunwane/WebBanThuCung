<?php
    $searchType = isset($_GET['searchType']) ? $_GET['searchType'] : ''; //kiểm tra xem có tồn tại biến trong isset chưa, có thì gán $get, ko thì gán''
    $searchText = isset($_GET['searchtext']) ? $_GET['searchtext'] : '';
    $searchQuery = $searchText ? "WHERE $searchType LIKE '%$searchText%'" : '';
?>