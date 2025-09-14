<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Google Sheet Website</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 6px;
      text-align: left;
      font-size: 14px;
    }
    th {
      background-color: #f4f4f4;
    }
    tr:nth-child(even) {
      background-color: #fafafa;
    }
  </style>
</head>
<body>
  <h1>Google Sheet Data</h1>
  <div id="sheet-data">Loading...</div>

  <script>
    const apiKey = "AIzaSyBhMQ9nXfaDdlxROGRznJz5M7pvHnMIsvw";
    const sheetId = "1chA3ZTopsu1P5IyP1-0kNFZPZQwGysUFIVaoOy6TGl8";
    const range = "A1:AE230";

    const url = `https://sheets.googleapis.com/v4/spreadsheets/${sheetId}/values/${range}?key=${apiKey}`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        if (!data.values) {
          document.getElementById("sheet-data").innerHTML = "No data found or access denied.";
          return;
        }

        let table = "<table>";
        data.values.forEach((row, rowIndex) => {
          table += "<tr>";
          row.forEach(cell => {
            if (rowIndex === 0) {
              table += `<th>${cell}</th>`;
            } else {
              table += `<td>${cell}</td>`;
            }
          });
          table += "</tr>";
        });
        table += "</table>";

        document.getElementById("sheet-data").innerHTML = table;
      })
      .catch(err => {
        document.getElementById("sheet-data").innerHTML = "Error loading data.";
        console.error(err);
      });
  </script>
</body>
</html>
