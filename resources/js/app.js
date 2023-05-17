import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const themeSwitch = document.querySelectorAll('.theme-switch');

let themes = ['theme-light', 'theme-dark'];
themeSwitch.forEach(ts => {
ts.addEventListener('click', function (e) {
        let theme = e.target.value;

        if (e.target.parentElement.tagName === 'BUTTON') {
            theme = e.target.parentElement.value;
          }
        let removeThemes = themes.filter(rt => rt != 'theme-' + theme);

        removeThemes.map(rm => {
            document.body.classList.remove(`${rm}`);
        })
        localStorage.setItem('theme', theme);
        document.body.classList.add('theme-' + theme);

    })
});
