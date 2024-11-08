<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Field Example</title>
</head>
<body>
    <label for="statusSelect">Select Status:</label>
    <select id="statusSelect" name="status">
        <!-- Options will be added here dynamically -->
    </select>

    <script>
        fetch('setting.json')
            .then(response => response.json())
            .then(data => {
                const selectElement = document.getElementById('statusSelect');
                data.statuses.forEach(status => {
                    if (status.id !== 1) {
                        const option = document.createElement('option');
                        option.value = status.id;
                        option.textContent = status.status;
                        selectElement.appendChild(option);
                    }
                });
            })
            .catch(error => console.error('Error fetching the JSON:', error));
    </script>
</body>
</html>
