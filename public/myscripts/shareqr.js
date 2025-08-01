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
    qr.value = text;
}

window.addEventListener("DOMContentLoaded", function () {
    document.getElementById("toclickqr").click();
});

document.getElementById("backbtn").addEventListener("click", function () {
    const home = localStorage.getItem("homeurl");
    window.location.href = `${baseURL}` + "" + home;
});