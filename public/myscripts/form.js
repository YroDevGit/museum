
//registered
const alreadyRegistered = localStorage.getItem("homeurl");
if (alreadyRegistered && alreadyRegistered !== null && alreadyRegistered !== "null") {
    window.location.href = baseURL + alreadyRegistered;
}


// form loaded
document.addEventListener('DOMContentLoaded', function () {
    const sharedAlbum = localStorage.getItem("shared");
    const albumID = localStorage.getItem("album");
    // --- Form Submission Logic ---
    const detailsForm = document.getElementById('details-form');
    const nameInput = document.getElementById('name-input');
    const emailInput = document.getElementById('email-input');
    const venueSelect = document.getElementById('venue-select');
    const formMessage = document.getElementById('form-message');

    detailsForm.addEventListener('submit', function () {
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
        if (sharedAlbum == "true") {
            url = "/photographer/invited/" + albumID;
        }

        mypost({
            url: apiURL+url,
            method: "POST",
            data: JSON.stringify({
                name: name,
                email: email,
                venue_id: venue,
                remote_id: localStorage.getItem("remote_id")
            }),
            success: function (response) {
                if(response.code != 200){
                    alert(response.details.error);return;
                }
                const data = response?.details?.data;
                const albums = data.albums;
                const users = data.users;
                const album_id = data.album_id ?? albums.id;
                const user_id = users.id;
                const hometoken = data.hometoken;
                localStorage.setItem("album", album_id);
                if (response.code == 200) {
                    Swal.fire({
                        title: "SUCCESS",
                        text: "Registration Completed",
                        icon: "success"
                    }).then(() => {
                        window.location.href =
                            `/photographer/album/${album_id}/user/${user_id}/${hometoken}`;
                    });
                    return;
                } else {
                    Swal.fire({
                        title: "FAILED",
                        text: response.details.error ?? "Submission failed",
                        icon: "success"
                    });
                    return;
                }
            },
            error: function (error) {
                Swal.fire({
                    title: "ERROR",
                    text: error,
                    icon: "success"
                });
                return;
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