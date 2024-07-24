<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Example</title>
    <style>
        .order-list {
            display: none;
        }
        .show-order-list .order-list {
            display: block;
        }
    </style>
</head>
<body>
    <div class="toggle-section">
        <button class="toggle-button">Show</button>
        <div class="order-list">
            <p>Order List 1</p>
            <button class="close-button">Close</button>
        </div>
    </div>
    <div class="toggle-section">
        <button class="toggle-button">Show</button>
        <div class="order-list">
            <p>Order List 2</p>
            <button class="close-button">Close</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButtons = document.querySelectorAll('.toggle-button');
            const closeButtons = document.querySelectorAll('.close-button');

            toggleButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const section = button.closest('.toggle-section');
                    const orderList = section.querySelector('.order-list');

                    if (orderList.style.display === 'block') {
                        orderList.style.display = 'none';
                        button.textContent = 'Show';
                    } else {
                        orderList.style.display = 'block';
                        button.textContent = 'Hide';
                    }
                });
            });

            closeButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const section = button.closest('.toggle-section');
                    const orderList = section.querySelector('.order-list');
                    const toggleButton = section.querySelector('.toggle-button');

                    orderList.style.display = 'none';
                    toggleButton.textContent = 'Show';
                });
            });
        });
    </script>
</body>
</html>
