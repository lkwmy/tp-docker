<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POZOS - Student List</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        h1   { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px 16px; border: 1px solid #ccc; text-align: left; }
        th   { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        button { padding: 10px 20px; background: #2c3e50; color: white; border: none; cursor: pointer; font-size: 15px; border-radius: 4px; }
        button:hover { background: #3d5166; }
        .error { color: red; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>POZOS - Student List</h1>
    <button onclick="loadStudents()">List Students</button>
    <div id="result"></div>

    <script>
        function loadStudents() {
            // URL pointing to the API service (use the service name from docker-compose)
            var url = 'http://<api_ip_or_name:port>/pozos/api/v1.0/get_student_ages';

            fetch(url, {
                headers: {
                    'Authorization': 'Basic ' + btoa('toto:python')
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('HTTP error ' + response.status);
                return response.json();
            })
            .then(data => {
                var html = '<table><tr><th>Name</th><th>Age</th></tr>';
                data.students.forEach(function(s) {
                    html += '<tr><td>' + s.name + '</td><td>' + s.age + '</td></tr>';
                });
                html += '</table>';
                document.getElementById('result').innerHTML = html;
            })
            .catch(err => {
                document.getElementById('result').innerHTML =
                    '<p class="error">Error: ' + err.message + '</p>';
            });
        }
    </script>
</body>
</html>
