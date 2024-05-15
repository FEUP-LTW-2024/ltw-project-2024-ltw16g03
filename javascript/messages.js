// Get reference to the form
var form = document.getElementById('message_input');

// Add event listener to the form's submit event
form.addEventListener('submit', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();

    // Get reference to input field
    const inputField = this.querySelector(".input_info");
    if (inputField.value.trim() == "") return;

    // Build Message element
    const messageElement = buildMessage.call(inputField);
    
    // Clear the input field if needed
    inputField.value = '';
});

function buildMessage() {
    const text = this.value;
    const userNameText = this.getAttribute("data-userName");

    const article = document.createElement('article');
    article.classList.add('message', 'user');
    const userName = document.createElement("p");
    userName.classList.add("username");
    userName.textContent = userNameText;
    article.appendChild(userName);
    const content = document.createElement("p");
    content.classList.add("content");
    content.textContent = text;
    article.appendChild(content);

    document.querySelector("main").insertBefore(article, this.parentElement);
}

