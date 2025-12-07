document.addEventListener("DOMContentLoaded", () => {

document.getElementById("submitBtn").addEventListener("click", () => {

    data = {

        button: "pressing the button"

    }


    console.log(data);
    fetch("../PHP/sendAlerts.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify(data)


    })
    .then(response => response.text())
    .then(data => {console.log(data)});


});







});
