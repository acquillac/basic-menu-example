<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css">
    <title>Menu</title>
  </head>
  <body>
    <div class="container">
      <div class="output"></div>
    </div>

    <?php include 'sheetdata.php';?>

    <script>
      const dataOutput = document.querySelector(".output");

      let url = "data.json";
      let request = new XMLHttpRequest();
      request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
          displayData(request.response);
        }
      };
      request.open("GET", url, true);
      request.send();

      function displayData(data) {
        let parsedData = JSON.parse(data);
        let dataArray = parsedData.data;
        dataArray.shift();

        dataArray.forEach((item) => {
          let itemHTML = `
            <div class="menu-item">
              <p>${item[0]}</p>
              <p>${item[1]}</p>
            </div>
        `;
          dataOutput.innerHTML = dataOutput.innerHTML + itemHTML;
        });
      }
    </script>
  </body>
</html>
