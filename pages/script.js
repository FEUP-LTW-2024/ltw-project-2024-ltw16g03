
localStorage.setItem('darkmode', window.matchMedia("(prefers-color-scheme: dark)").matches);
const element = document.body;
element.classList.toggle('dark-mode', window.matchMedia("(prefers-color-scheme: dark)").matches);

function changedarkmode() {
    const wasDarkmode = localStorage.getItem('darkmode') === 'true';
    localStorage.setItem('darkmode', !wasDarkmode);
    document.body.classList.toggle('dark-mode', !wasDarkmode); 
}

function onload() {
    document.body.classList.toggle('dark-mode', localStorage.getItem('darkmode') === 'true');
}