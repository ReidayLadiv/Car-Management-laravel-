<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Car Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .navbar {
            margin-bottom: 50px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .actions button {
            background-color: #f44336;
            color: white;
            margin-right: 5px;
        }
        .actions button:first-child {
            background-color: #4CAF50;
        }
        .actions button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand nav-link btn btn-custom" href="{{route('welcome')}}">Home</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-custom" href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link btn btn-custom" href="{{{route('profile')}}}">Profile</a>
                    </li>
            </ul>
        </div>
    </nav>
    <h1 style="margin-top: 50px">Car Management</h1>
    <form id="carForm">
        @csrf
        <input type="hidden" id="carId">
        <input type="hidden" id="user_id">
        <label for="brand">Brand:</label>
        <select id="brand" name="brand" required onchange="populateModels()">
            <option value="">Select Brand</option>
            <option value="Lamborghini">Lamborghini</option>
            <option value="Ferrari">Ferrari</option>
            <option value="BMW">BMW</option>
            <option value="Mercedes-Benz">Mercedes-Benz</option>
            <option value="Toyota">Toyota</option>
            <option value="Volkswagen">Volkswagen</option>
            <option value="Ford">Ford</option>
            <option value="Porsche">Porsche</option>
            <option value="Audi">Audi</option>
            <option value="Nissan">Nissan</option>
            <option value="Honda">Honda</option>
            <option value="Chevrolet">Chevrolet</option>
        </select>
        <label for="model">Model:</label>
        <select id="model" name="model" required>
            <option value="">Select Model</option>
        </select>
        <label for="launchDate">Launch Date:</label>
        <input type="date" id="launchDate" name="launchDate" required>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <label for="color">Color:</label>
        <select id="color" name="color" required>
            <option value="">Select Color</option>
            <option value="Black">Black</option>
            <option value="White">White</option>
            <option value="Gray">Gray</option>
            <option value="Silver">Silver</option>
            <option value="Red">Red</option>
            <option value="Blue">Blue</option>
            <option value="Brown">Brown</option>
            <option value="Green">Green</option>
            <option value="Yellow">Yellow</option>
            <option value="Orange">Orange</option>
        </select>
        <button type="submit" id="saveButton">Save</button>
    </form>
    <table id="carsTable">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Launch Date</th>
                <th>Price</th>
                <th>Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be populated here -->
        </tbody>
    </table>

    <script>
        // Función para recargar la página

        const models = {
            'Lamborghini': ['Huracán', 'Aventador', 'Urus', 'Gallardo', 'Murciélago'],
            'Ferrari': ['488', 'F8 Tributo', 'Portofino', 'Roma', 'SF90 Stradale'],
            'BMW': ['3 Series', '5 Series', '7 Series', 'X5', 'X3'],
            'Mercedes-Benz': ['C-Class', 'E-Class', 'S-Class', 'GLC', 'GLE'],
            'Toyota': ['Camry', 'Corolla', 'Prius', 'Highlander', 'RAV4'],
            'Volkswagen': ['Golf', 'Passat', 'Tiguan', 'Jetta', 'Atlas'],
            'Ford': ['F-150', 'Mustang', 'Explorer', 'Escape', 'Ranger'],
            'Porsche': ['911', 'Cayenne', 'Panamera', 'Macan', 'Taycan'],
            'Audi': ['A3', 'A4', 'A6', 'Q5', 'Q7'],
            'Nissan': ['Altima', 'Rogue', 'Sentra', 'Versa', 'Maxima'],
            'Honda': ['Civic', 'Accord', 'CR-V', 'Pilot', 'Fit'],
            'Chevrolet': ['Silverado', 'Malibu', 'Equinox', 'Camaro', 'Tahoe']
        };

        function populateModels() {
            const brandSelect = document.getElementById('brand');
            const modelSelect = document.getElementById('model');
            const selectedBrand = brandSelect.value;

            // Limpiar el select de modelos
            modelSelect.innerHTML = '<option value="">Select Model</option>';

            if (selectedBrand && models[selectedBrand]) {
                models[selectedBrand].forEach(model => {
                    const option = document.createElement('option');
                    option.value = model;
                    option.textContent = model;
                    modelSelect.appendChild(option);
                });
            }
        }

        async function fetchCars() {
            const response = await fetch('/fetch-cars');
            if (response.ok) {
                const cars = await response.json();
                const tableBody = document.getElementById('carsTable').getElementsByTagName('tbody')[0];
                tableBody.innerHTML = '';

                cars.forEach(car => {
                    const row = tableBody.insertRow();
                    row.innerHTML = `
                        <td>${car.brand}</td>
                        <td>${car.model}</td>
                        <td>${car.launchDate}</td>
                        <td>${car.price}</td>
                        <td>${car.color}</td>
                        <td class="actions">
                            <button onclick="editCar(${car.id})">Edit</button>
                            <button onclick="deleteCar(${car.id})">Delete</button>
                        </td>
                    `;
                });
            } else {
                console.error('Failed to fetch cars');
            }
        }

        async function createOrUpdateCar() {
            const carId = document.getElementById('carId').value;
            const brand = document.getElementById('brand').value;
            const model = document.getElementById('model').value;
            const launchDate = document.getElementById('launchDate').value;
            const price = document.getElementById('price').value;
            const color = document.getElementById('color').value;

            // Validar que el precio no sea negativo
            if (price < 0) {
                alert('Price cannot be negative.');
                return;
            }

            // Validar que la fecha de lanzamiento no sea hoy o en el futuro
            const today = new Date().toISOString().split('T')[0];
            if (launchDate >= today) {
                alert('Launch Date cannot be today or in the future.');
                return;
            }

            const data = { brand, model, launchDate, price, color };

            let url = '/cars';
            let method = 'POST';

            if (carId) {
                url += `/${carId}`;
                method = 'PUT';
            }

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                document.getElementById('carForm').reset();
                document.getElementById('carId').value = '';
                fetchCars();
            } else {
                console.error('Failed to create or update car');
            }
        }

        async function editCar(id) {
            const response = await fetch(`/cars/${id}`);
            if (response.ok) {
                const car = await response.json();

                document.getElementById('carId').value = car.id;
                document.getElementById('brand').value = car.brand;
                populateModels();  // Actualizar los modelos al editar
                document.getElementById('model').value = car.model;
                document.getElementById('launchDate').value = car.launchDate;
                document.getElementById('price').value = car.price;
                document.getElementById('color').value = car.color;
            } else {
                console.error('Failed to fetch car details');
            }
        }

        async function deleteCar(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch(`/cars/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            if (response.ok) {
                fetchCars();
            } else {
                console.error('Failed to delete car');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Fetch cars on page load
            fetchCars();

            // Attach event listener to the save button
            document.getElementById('saveButton').addEventListener('click', createOrUpdateCar);

            // Attach event listener to the brand select for model population
            document.getElementById('brand').addEventListener('change', populateModels);
        });
    </script>
</body>
</html>


<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        async function createOrUpdateCar() {
            const carId = document.getElementById('carId').value;
            const brand = document.getElementById('brand').value;
            const launchDate = document.getElementById('launchDate').value;
            const price = document.getElementById('price').value;
            const color = document.getElementById('color').value;

            const data = { brand, launchDate, price, color };

            let url = '/post';
            let method = 'POST';

            if (carId) {
                url += `/${carId}`;
                method = 'PUT';
            }

            const response = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                document.getElementById('carForm').reset();
                document.getElementById('carId').value = '';
                fetchCars();
            } else {
                console.error('Failed to create or update car');
            }
        }

        // Rest of your JavaScript code...

    });
</script>
