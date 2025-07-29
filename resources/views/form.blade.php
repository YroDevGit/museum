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
                <input type="hidden" value="<?=$_GET['rem']?? ''?>" name="" id="remid">
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
    <script>
        // Ensure the DOM is fully loaded before running the script
        document.addEventListener('DOMContentLoaded', function() {
            const sharedAlbum = localStorage.getItem("shared");
            const albumID = localStorage.getItem("album");
            // --- Form Submission Logic ---
            const detailsForm = document.getElementById('details-form');
            const nameInput = document.getElementById('name-input');
            const emailInput = document.getElementById('email-input');
            const venueSelect = document.getElementById('venue-select');
            const formMessage = document.getElementById('form-message');

            detailsForm.addEventListener('submit', function() {
                event.preventDefault();

                const name = nameInput.value.trim();
                const email = emailInput.value.trim();
                const venue = venueSelect.value;

                if (!name || !email || !venue) {
                    formMessage.textContent = 'Please fill in all fields.';
                    formMessage.className = 'mt-4 text-center text-sm font-medium text-red-600';
                    return;
                }

                let url = "/photographer/add"
                if(sharedAlbum == "true"){
                    url = "/photographer/invited/"+albumID;
                }

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        name: name,
                        email: email,
                        venue_id: venue,
                        remote_id:document.querySelector("#remid").value
                    },
                    success: function(response){
                        if(response.code == 200){
                            Swal.fire({
                            title: "SUCCESS",
                            text: "Registration Completed",
                            icon: "success"
                        }).then(()=>{
                            const data = response?.details?.data;
                            const albums = data.albums;
                            const users = data.users;
                            const album_id = albums.id;
                            const user_id = users.id;
                            const hometoken = data.hometoken;
                            window.location.href = `/photographer/album/${album_id}/user/${user_id}/${hometoken}`;
                        });return;
                        }else{
                            Swal.fire({
                            title: "FAILED",
                            text: response.details.error ?? "Submission failed",
                            icon: "success"
                        });return;
                        }
                    },
                    error: function(error){
                        Swal.fire({
                            title: "ERROR",
                            text: error,
                            icon: "success"
                        });return;
                    }
                    
                });
                console.log('Form Submitted!');
                console.log('Name:', name);
                console.log('Email:', email);
                console.log('Venue:', venue);

                formMessage.textContent = 'Details submitted successfully!';
                formMessage.className = 'mt-4 text-center text-sm font-medium text-green-600';

                detailsForm.reset();
            });
        });
    </script>
</body>
</html>
