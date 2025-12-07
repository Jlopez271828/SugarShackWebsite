document.addEventListener("DOMContentLoaded", () => {

document.getElementById("submitBtn").addEventListener("click", () => {

    data = {

        events: document.getElementById("events").value,
        announcements: document.getElementById("announcements").value

    }


    console.log(data);
    fetch("../PHP/updateEvents.php", {

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