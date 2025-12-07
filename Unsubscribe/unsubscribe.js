document.addEventListener("DOMContentLoaded", () => {

document.getElementById("submitBtn").addEventListener("click", () => {

    data = {


        email: document.getElementById("contact").value


    }


    console.log(data);
    fetch("../PHP/unsubscribeFromEmailList.php", {

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