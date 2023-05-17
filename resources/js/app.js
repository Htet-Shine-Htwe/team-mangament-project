import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const themeSwitch = document.querySelectorAll('.theme-switch');
const fontSwitch = document.querySelectorAll('.font-switch');

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

let fonts = ['font-Sans','font-roboto','font-Libre','font-kanit','font-Pt'];
fontSwitch.forEach(fs => {
fs.addEventListener('click', function (e) {
        let font = e.target.value;

        if (e.target.parentElement.tagName === 'BUTTON') {
            font = e.target.parentElement.value;
          }
        let removeFonts = fonts.filter(rt => rt != 'font-' + font);

        removeFonts.map(rm => {
            document.body.classList.remove(`${rm}`);
        })
        localStorage.setItem('font', font);
        document.body.classList.add('font-' + font);

    })
});
