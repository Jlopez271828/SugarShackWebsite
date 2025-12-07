document.addEventListener("DOMContentLoaded", () => {

document.getElementById("signUpBtn").addEventListener("click", (event) => {

    const input = document.getElementById("emailInput");

    let isValid = validateEmail(input.value);

    if(!isValid || input.value === ""){

        warn("invalid email");
        return;

    }


    data = {

        email: input.value

    }

    console.log(input.value);

    fetch("PHP/addToEmailList.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify(data)


    })
    .then(response => response.text())
    .then(data => {

        if(data === "GOOD"){
            
            confirm("email recieved and validated");

        }
        else{
            console.log(data);
            warn("bad email recieved");
        }
    });


});

});

function confirm(text = "email added"){

    const para = document.createElement("h3");
    // const newText = document.createTextNode();
    para.innerText = text;
    para.className = "good";
    para.id = "confirmation"
    document.body.appendChild(para);

    setTimeout(para => {

        document.getElementById("confirmation").remove();

    }, 3000);

}

function warn(text = "updated Incorrectly"){

    const para = document.createElement("h3");
    // const newText = document.createTextNode();
    para.innerText = text;
    para.className = "bad";
    para.id = "badconfirmation"
    document.body.appendChild(para);

    setTimeout(para => {

        document.getElementById("badconfirmation").remove();

    }, 3000);

}

const validateEmail = (email) => {
    return String(email)
      .toLowerCase()
      .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
};