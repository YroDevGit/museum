<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Page</title>
    <!-- Tailwind CSS CDN for responsive styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter font for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Apply Inter font to the body */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('includes.baseURL');
</head>

<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4 sm:p-6 md:p-8">
    <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-6 text-center">
        Submit Your Details
    </h1>

    <!-- Form Section -->
    <div class="w-full max-w-xl bg-white p-6 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Please fill out the form below</h2>
        <form id="details-form" class="space-y-4">
            <div>

                <label for="name-input" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" id="name-input" name="name" placeholder="Your Name"
                    class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">
            </div>
            <div>
                <label for="email-input" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email-input" name="email" placeholder="your.email@example.com"
                    class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">
            </div>
            <div>
                <label for="venue-select" class="block text-gray-700 text-sm font-bold mb-2">Venue:</label>
                <select id="venue-select" name="venue"
                    class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out">
                    <option value="">Select a Venue</option>
                    <option value="1">Venue 1</option>
                    <option value="2">Venue 2</option>
                    <option value="3">Venue 3</option>
                </select>
            </div>
            <div class="flex justify-center pt-4">
                <button type="submit"
                    class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-150 ease-in-out">
                    Submit Details
                </button>
            </div>
        </form>
        <div id="form-message" class="mt-4 text-center text-sm font-medium text-gray-600"></div>
    </div>

    <script src="jquery-3.6.0.min.js"></script>
    <script src="{{ asset('myscripts/form.js') }}"></script>
</body>

</html>
