/*sidebar*/
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
  const heading = document.querySelector(".navbar-brand h2");

  // Function to handle the scroll event
  function handleScroll() {
    const scrollY = window.scrollY;

    // Change background color when scrolled down
    if (scrollY > 50) {
      navbar.classList.add("bg-body-tertiary");
    } else {
      navbar.classList.remove("bg-body-tertiary");
    }

    // Calculate the font size based on scroll position
    // Interpolate font size from h2 (2rem) to h4 (1.5rem)
    let fontSize = 2 - 0.5 * (scrollY / 150);
    fontSize = Math.max(fontSize, 1.5); // Ensure font size does not go below 1.5rem

    // Apply the font size to the heading
    heading.style.fontSize = fontSize + "rem";
  }

  // Add scroll event listener
  window.addEventListener("scroll", handleScroll);
});
/*sidebar*/

/* horizontally scroll menu */

document.addEventListener("DOMContentLoaded", function () {
  const sideScroll = document.querySelector(".side-scroll");
  const prevButtons = document.querySelectorAll(".prev-button");
  const nextButtons = document.querySelectorAll(".next-button");

  // Calculate the scroll amount based on the width of a single scroll item
  const scrollAmount = sideScroll.querySelector(".scroll-item").offsetWidth * 2;

  // Function to handle button clicks and scroll accordingly
  function handleScroll(event) {
    const target = event.target;

    // Determine the direction of the scroll based on the button clicked
    if (target.classList.contains("prev-button")) {
      sideScroll.scrollBy({
        left: -scrollAmount,
        behavior: "smooth",
      });
    } else if (target.classList.contains("next-button")) {
      sideScroll.scrollBy({
        left: scrollAmount,
        behavior: "smooth",
      });
    }
  }

  // Add event listeners to previous and next buttons
  prevButtons.forEach((button) => {
    button.addEventListener("click", handleScroll);
  });

  nextButtons.forEach((button) => {
    button.addEventListener("click", handleScroll);
  });
});

/* horizontally scroll menu */

/*Filter Price Range*/

function updatePriceRange(slider) {
  // Update the displayed value when the range slider changes
  document.getElementById("priceRangeValue").innerText =
    slider.value.toLocaleString();

  // Update the slider fill
  var value = ((slider.value - slider.min) / (slider.max - slider.min)) * 100;
  slider.style.background =
    "linear-gradient(to right, #007bff " + value + "%, #ccc " + value + "%)";
}

/*Filter Price Range*/

/*Favourite*/
// Select all heart icons
// document.addEventListener("DOMContentLoaded", function () {
//   // Select all heart icons
//   const heartIcons = document.querySelectorAll(".heart-icon");

//   // Debugging: log heartIcons
//   console.log(heartIcons);

//   // Add click event listener to each heart icon
//   heartIcons.forEach(function (icon) {
//     if (icon) {
//       icon.addEventListener("click", function () {
//         // Toggle the 'liked' class
//         icon.classList.toggle("liked");

//         // Toggle the 'data-liked' attribute
//         const isLiked = icon.getAttribute("data-liked") === "true";
//         icon.setAttribute("data-liked", !isLiked);
//         console.log("like it");
//       });
//     }
//   });
// });

/*Favourite*/

/*Copy Address*/

// Function to copy the restaurant address to clipboard
function copyAddress() {
  // Get the address element
  const addressElement = document.getElementById("restaurant-address");
  // Create a range to select the text
  const range = document.createRange();
  range.selectNodeContents(addressElement);
  // Get the current selection
  const selection = window.getSelection();
  // Remove any previous selections
  selection.removeAllRanges();
  // Add the range to the selection
  selection.addRange(range);
  // Execute the copy command
  document.execCommand("copy");
  // Clear the selection
  selection.removeAllRanges();
  // Alert the user that the address has been copied
  alert("Address copied to clipboard!");
  console.log("Copy Successfully");
}

// Attach the event listener to the copy icon
document.getElementById("copy-icon").addEventListener("click", copyAddress);

/* Toggle Open Time of Restaurant*/

document.addEventListener("DOMContentLoaded", function () {
  // Get the "show more" button and the full schedule element
  const toggleSchedule = document.getElementById("toggle-schedule");
  const fullSchedule = document.getElementById("full-schedule");

  // Add click event listener to the button
  toggleSchedule.addEventListener("click", function () {
    // Toggle the display of the full schedule
    if (fullSchedule.style.display === "none") {
      fullSchedule.style.display = "block";
      toggleSchedule.textContent = "Show less";
    } else {
      fullSchedule.style.display = "none";
      toggleSchedule.textContent = "Show more";
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const restaurantElements = document.querySelectorAll(".restaurant-display");

  restaurantElements.forEach((restaurant) => {
    restaurant.addEventListener("mouseenter", function (event) {
      event.target.classList.remove("card");
      event.target.classList.add("shadow");
    });

    restaurant.addEventListener("mouseleave", function (event) {
      event.target.classList.remove("shadow");
      event.target.classList.add("card");
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const itemElements = document.querySelectorAll(".item-display");

  itemElements.forEach((item) => {
    item.addEventListener("mouseenter", function (event) {
      event.target.classList.remove("border");
      event.target.classList.add("shadow");
    });

    item.addEventListener("mouseleave", function (event) {
      event.target.classList.remove("shadow");
      event.target.classList.add("border");
    });
  });
});
