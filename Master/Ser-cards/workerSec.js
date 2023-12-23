var toggleInfoLink = document.createElement("a");
        toggleInfoLink.href = "#";
        toggleInfoLink.classList.add("toggle-info", "btn");
        toggleInfoLink.textContent = "Show More"; // Set the text content
        toggleInfoLink.style.color = "#ffffff"; // Set text color
        toggleInfoLink.style.backgroundColor = "#007bff"; // Set background color
        toggleInfoLink.style.padding = "5px 10px"; // Set padding

        cardTitle.appendChild(toggleInfoLink);
