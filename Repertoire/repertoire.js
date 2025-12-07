

document.addEventListener('DOMContentLoaded', () => {
  const modalOverlay = document.getElementById('modalOverlay');
  const modalClose = document.getElementById('modalClose');
  const emailInput = document.getElementById('emailInput');
  const emailError = document.getElementById('emailError');
  const submitEmail = document.getElementById('submitEmail');
  const messageDiv = document.getElementById('subscribeMessage');

  const modalOverlay2 = document.getElementById('modalOverlay2');
  const modalClose2 = document.getElementById('modalClose2');
  const ingredients = document.getElementById('ingredientsText');

  let currentProductId = null;

  // Event delegation for all subscribe buttons
  document.getElementById('container').addEventListener('click', function(e) {
    if (e.target.matches('.notifyBtn')) {
      const productDiv = e.target.closest('.card');
      currentProductId = productDiv.id;
      openModal();
    }

    if (e.target.matches('.ingredientsBtn')) {

      const card =  e.target.closest('.card');
      currentProductId = card.id;

      console.log("I was clicked. id = " + currentProductId);
      openModal2();
    }
  });

  // Open modal
  function openModal() {
    emailInput.value = '';
    emailError.textContent = '';
    modalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden'; // prevent scrolling
  }

  function openModal2() {

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
      ingredients.innerText = result;
    })
    .catch(error => {
      ingredients.innerText = 'Something went wrong. Please try again.';
      console.error(error);
    });
    modalOverlay2.classList.add('active');
    document.body.style.overflow = 'hidden'; // prevent scrolling
  }

  // Close modal
  function closeModal() {
    modalOverlay.classList.remove('active');
    document.body.style.overflow = ''; // restore scrolling
  }

  function closeModal2() {
    modalOverlay2.classList.remove('active');
    document.body.style.overflow = ''; // restore scrolling
  }

  // Close modal on background click or close button
  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay || e.target === modalClose) {
      closeModal();
    }
  });

  modalOverlay2.addEventListener('click', (e) => {
    if (e.target.matches('.modal-overlay') || e.target.matches('.modal-close')) {
      closeModal2();
    }
  });

  // Submit logic
  submitEmail.addEventListener('click', () => {
    const email = emailInput.value.trim();
    const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

    if (!isValid) {
      emailError.textContent = 'Please enter a valid email address.';
      return;
    }

    // Clear error
    emailError.textContent = '';

    console.log("item_id: " + currentProductId);
    // Send email and product ID via POST to PHP
    fetch('/PHP/addAlert.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        email: email,
        item_id: currentProductId
      })
    })
    .then(response => response.ok ? response.text() : Promise.reject("Error"))
    .then(result => {
      messageDiv.textContent = 'Thank you, you will be notified when this item is being sold!';
      messageDiv.style.color = 'green';

      setTimeout(() => {
        closeModal();
      }, 1000);
    })
    .catch(error => {
      emailError.textContent = 'Something went wrong. Please try again.';
      console.error(error);
    });
  });
});