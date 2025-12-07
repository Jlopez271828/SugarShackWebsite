document.addEventListener("DOMContentLoaded", () => {

document.getElementById("submitBtn").addEventListener("click", () => {

    data = {

        name: document.getElementById("name").value,

        contact: document.getElementById("contact").value,

        description: document.getElementById("request").value

    }


    console.log(data);
    fetch("../PHP/recieveOrder.php", {

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