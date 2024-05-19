
const searchUser = document.querySelector('#searchUser')
if (searchUser) {
    searchUser.addEventListener('input', searchUsers);
}

async function searchUsers() {
    const response = await fetch('../api/search_users.php?search=' + this.value)
    const users = await response.json()

    const section = document.querySelector('#users_promote')
    section.innerHTML = ''

    for (const user of users) {
        const article = document.createElement('article');
        const username = document.createElement('h3');
        const button1 = document.createElement('button');
        const button2 = document.createElement('button');
        username.textContent = user.Username;
        article.className = 'show_users';

        button1.textContent = 'Promote';
        button1.className = 'button2promote';
        button1.className = 'yellow';
        button1.setAttribute('data-userid', user.UserId);
        button2.addEventListener("click", deleteUser);

        button2.className = 'red';
        button2.textContent = 'Ban';
        button2.className = 'button2ban';
        button2.setAttribute('data-userid', user.UserId);
        button2.addEventListener("click", promote2Admin);

        article.appendChild(username);
        article.appendChild(button1);
        article.appendChild(button2);
        section.appendChild(article);
    }
}

const button2banuser = document.querySelectorAll('.button2ban')
for (const button of button2banuser) {
    button.addEventListener("click", deleteUser);
}

async function deleteUser() {
    const response = fetch('../api/delete_user.php?id=' + this.getAttribute("data-userid"));
}

const button1promote = document.querySelectorAll('.button1promote')
for (const button of button1promote) {
    button.addEventListener("click", promote2Admin);
}

async function promote2Admin() {
    const response = fetch('../api/promote_admin.php?id=' + this.getAttribute("data-userid"));
}