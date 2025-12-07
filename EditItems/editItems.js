
document.addEventListener("DOMContentLoaded", () => {

    const modalOverlay = document.getElementById('modalOverlay');
    const modalClose = document.getElementById('modalClose');
    const ingredientsInput = document.getElementById('ingredientsInput');
    const ingredientsError = document.getElementById('ingredientsError');
    const submitIngredients = document.getElementById('submitIngredients');
    const messageDiv = document.getElementById('result');

    let currentProductId = 0;


document.addEventListener("click", (event) => {

    if(event.target.matches(".updateBtn")){

        console.log("clicked");
        console.log("I, " + event.target.id + " have been clicked");


        const itemID = event.target.parentElement.parentElement.id;

        console.log("supposed id: " + itemID + ", supposed button id: " + "price_" + itemID);
        console.log("supposed cost: " + document.getElementById("price_" + itemID).innerText);
        // const title = document.getElementById("title_" + itemID).innerText;
        // const description = document.getElementById("desc_" + itemID).innerText;
        // let active = document.getElementById("active_" + itemID).checked;

        const data = {

            item_id: itemID,
            title: document.getElementById("title_" + itemID).innerText,
            description: document.getElementById("desc_" + itemID).innerText,
            active: document.getElementById("active_" + itemID).checked,
            price: document.getElementById("price_" + itemID).innerText,
	    selling: document.getElementById("sellingBtn_" + itemID).checked

        }

	console.log(data);

        fetch("/PHP/editCard.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify(data)

        })
        .then(response => response.text())
        .then(data => {

            if(data === "GOOD"){
                confirm();

            }
            else{
                warn();
            }
        })
        .catch(error => console.error("Error:", error));


    }

    if(event.target.matches(".cardImg")){

        const itemID = event.target.parentElement.parentElement.parentElement.id;
        console.log("id of image clicked: " + itemID);

        document.getElementById('imageInput_' + itemID).click();


    }

    if(event.target.matches(".updateImage")){

        if(selectedFile === null){
            
            warn("No image selected");


        }
        else{

            const itemID = event.target.parentElement.parentElement.id;
            if(itemID != cachedID){

                warn("you are uploading the image of a different product");

            }else{

                const formData = new FormData();
                formData.append("file", selectedFile);
                formData.append("itemID", itemID);

                fetch("/PHP/editImage.php", {

                    method: "POST",
                    body: formData

                })
                .then(response => response.text())
                .then(data => {
                    
                    if(data === "GOOD"){
                        confirm();
                        selectedFile = null;

                    }
                    else{
                        console.log(data);
                        warn();

                    }

                });

            }

        }

    }

    if (event.target.matches('.ingredientsBtn')){
        currentProductId = event.target.closest('.card').id;

        



        openModal();
    }



    

});

document.addEventListener("change", event => {

    if(event.target.matches(".imageInput")){

        const file = event.target.files[0];
        const itemID = event.target.parentElement.parentElement.id;

        if(file){

            selectedFile = file;
            cachedID = itemID;

            document.getElementById("updateImage_" + itemID).disabled = false;

            const reader = new FileReader();
            reader.onload = function(e){
                document.getElementById("image_" + itemID).src = e.target.result;
            }
            reader.readAsDataURL(file);

        }


    }


});

// Open modal
function openModal() {

    fetch('/PHP/getIngredients.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            item_id: currentProductId
        })
    })
    .then(response => response.ok ? response.text() : Promise.reject("Error"))
    .then(result => {
        console.log("result: " + result);
        ingredientsInput.value = result;
    });


    modalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden'; // prevent scrolling

    // ingredientsInput.value = '';
    ingredientsError.textContent = '';
    modalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden'; // prevent scrolling
}

// Close modal
function closeModal() {
    modalOverlay.classList.remove('active');
    document.body.style.overflow = ''; // restore scrolling
}

// Close modal on background click or close button
modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay || e.target === modalClose) {
        closeModal();
    }
});

// Submit logic
submitIngredients.addEventListener('click', () => {
    const text = ingredientsInput.value.trim();

    // Clear error
    ingredientsError.textContent = '';

    console.log("item_id: " + currentProductId);
    console.log("text: " + text);
    
    fetch('/PHP/editIngredients.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ingredients: text,
            item_id: currentProductId
        })
    })
    .then(response => response.ok ? response.text() : Promise.reject("Error"))
    .then(result => {
        messageDiv.textContent = 'Ingredient Succesfully updated';
        messageDiv.style.color = 'green';

        setTimeout(() => {
        closeModal();
        }, 1000);
    })
    .catch(error => {
        ingredientsError.textContent = 'Something went wrong. Please try again.';
        console.error(error);
    });
});


let selectedFile = null;
let numFiles = 0;
let cachedID = 0;

document.getElementById("addBtn").addEventListener("click", () => {

    formData = new FormData();
    //formData.append("val", "1543")

    fetch("/PHP/addCard.php", {

        method: "POST",
        body: formData

    })
    .then(response => response.text())
    .then(data => {

        const clone = document.getElementById("1").cloneNode(true);
        clone.id = data;
        clone.firstElementChild.querySelector(".cardImg").id = "image_" + data; //img
        clone.firstElementChild.querySelector(".cardImg").src = "/images/items" + data + ".wepb";
        clone.firstElementChild.querySelector(".imageInput").id = "imageInput_" + data; //hidden input
        clone.firstElementChild.querySelector(".updateImage").id = "updateImage_" + data; //update image button
        clone.firstElementChild.querySelector(".title").id = "title_" + data; //title
        clone.firstElementChild.querySelector(".title").innerText = "A";
        clone.firstElementChild.querySelector(".desc").id = "desc_" + data; //description
        clone.firstElementChild.querySelector(".desc").innerText = "A";
        clone.firstElementChild.querySelector(".price").id = "price_" + data; //price
        clone.firstElementChild.querySelector(".price").innerText = "1";
        clone.firstElementChild.querySelector(".activeBtn").id = "active_" + data; //active
        clone.firstElementChild.querySelector(".activeBtn").checked = true;
        clone.firstElementChild.querySelector(".seqNo").id = "seqNo_" + data; //seq_no
        clone.firstElementChild.querySelector(".seqNo").innerText = data;
        document.getElementById("container").appendChild(clone);


    });



});

});

function confirm(){

    const para = document.createElement("h3");
    // const newText = document.createTextNode();
    para.innerText = "Updated correctly";
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
