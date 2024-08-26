<!DOCTYPE html>
<html>
    <head>
        <title>Movie Database</title>
        <style>
            .container {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                width: 600px;
                padding: 10px;
                margin: 10px;
            }

            .container p {
                margin: 5px;
                border: 2px solid black;
                padding: 10px;
            }

            .container p span {
                text-decoration: none;
                color: green;
                cursor: pointer;
            }

            #error {
                color: red;
            }
        </style>
    </head>
    <body>
        <h1>Movie Database</h1>
        <div class="container">
            <p><span id="view">View All</span></p>
            <p><span id="add">Add A Movie</a></p>
            <p><span id="search">Search Movies</a></p>
        </div>
        <div id="table">
        </div>
    </body>

    <script>
        async function fetchTable() {
            const response = await fetch('view_all.php');
            const text = await response.text();
            document.getElementById('table').innerHTML = text;
        }

        async function addMovie() {
            const formHTML = `
                <p id="error"></p>
                <form id="movie-form" action="add_form.php" method="post">
                    <label for="title">Movie Title:</label>
                    <input type="text" id="title" name="title"><br><br>
                    <label for="year">Release Year:</label>
                    <input type="number" id="year" name="year"><br><br>
                    <input type="submit" value="Add Movie">
              </form>
            `;
            document.getElementById('table').innerHTML = formHTML;
            let form = document.getElementById('movie-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                submitForm(form);
            });
        }

        async function searchMovies() {
            const searchHTML = `
                <div id="searchForm">
                    <h2>Search Movies</h2>
                    <form id="search-form">
                        <label for="searchTitle">Search Movie Titles:</label>
                        <input type="text" id="searchTitle" name="searchTitle"> 
                        <br> 
                        <br>
                        <label for="searchYear">Search Release Year:</label>
                        <input type="number" id="searchYear" name="searchYear">
                        <button type="submit">Search</button>
                    </form>
                    <div id="searchResults"></div>
                </div>
            `;
            document.getElementById('table').innerHTML = searchHTML;

            const searchForm = document.getElementById('search-form');
            searchForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const title = document.getElementById('searchTitle').value.trim();
                const year = document.getElementById('searchYear').value.trim();
                performSearch(title, year);
            });
        }

        async function performSearch(title, year) {
            const formData = new FormData();
            formData.append('title', title);
            formData.append('year', year);

            const response = await fetch('search.php', {
                method: 'POST',
                body: formData
            });
            const text = await response.text();
            document.getElementById('searchResults').innerHTML = text;
        }

        async function submitForm(form) {
            let title = document.getElementById('title');
            let year = document.getElementById('year');
            let error = document.getElementById('error');

            //check if form is filled
            if (title.value.trim() === '' || year.value.trim() === '') {
                error.innerHTML = "Complete All Fields!";
                return;
            }

            let formData = new FormData(form);
            let response = await fetch('add_form.php', {
                method: 'POST',
                body: formData
            });
            let text = await response.text();
            if (response.ok) {
                document.getElementById('table').innerHTML = 'Success! Movie added to the database.';
            }
        }

        document.getElementById('view').onclick = fetchTable;
        document.getElementById('add').onclick = addMovie;
        document.getElementById('search').onclick = searchMovies;
        window.onload = fetchTable;
    </script>
</html>