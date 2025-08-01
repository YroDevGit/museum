const qr = new QRious({
    element: document.getElementById('qrCanvas'),
    size: 250,
    value: ''
});

function generateQRCode() {
    const text = document.getElementById('qrText').value.trim();
    if (!text) {
        alert("Please enter text or a URL.");
        return;
    }
    let qrtext = null;
    mypost({
        url: `${apiURL}/qr/get/` + text,
        method: "GET",
        success: function (response) {
            if (response.code == 200) {
                const data = response.details.data;
                const token = response.details.token;
                const qrtextresult = `photographer/remote/${data.id}/${token}`;
                qr.value = qrtextresult;
                console.log(qrtextresult);
            } else {
                alert(response.message);
            }
        },
        error: function (error) {
            alert(error);
        }
    });
}

window.addEventListener("DOMContentLoaded", function () {
    const id = document.getElementById('qrText').value.trim();
});