document.addEventListener("DOMContentLoaded", () => {

document.getElementById("submitBtn").addEventListener("click", () => {

    data = {

        subject: document.getElementById("subject").value,

        message: document.getElementById("message").value,

        title: document.getElementById("email_title").value,

        selfonly: document.getElementById("selfBtn").checked

    }


    console.log(data);
    fetch("../PHP/sendToEmailList.php", {

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