<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search</title>
    <script>
        function searchBooks() {
            const searchQuery = document.getElementById("search").value;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "search.php?query=" + encodeURIComponent(searchQuery), true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("bookResults").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>

    <h4>Search Books</h4>
    <input type="text" id="search" placeholder="Search by title, author, or ISBN">
    <button onclick="searchBooks()">Search</button>
    <div id="bookResults"></div>

</body>
</html>
