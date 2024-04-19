
localStorage.setItem('darkmode', window.matchMedia("(prefers-color-scheme: dark)").matches);
const element = document.body;
element.classList.toggle('dark-mode', window.matchMedia("(prefers-color-scheme: dark)").matches);