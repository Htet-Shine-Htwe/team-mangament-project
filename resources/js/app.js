import './bootstrap';

import Alpine from 'alpinejs';

import 'flowbite';

import Croppie from 'croppie';

window.Alpine = Alpine;

Alpine.start();

const themeSwitch = document.querySelectorAll('.theme-switch');
const fontSwitch = document.querySelectorAll('.font-switch');

const sidebarSwitch = document.getElementById('sidebarToggle');
const mainLayout = document.getElementById('mainLayout');
const sideBar = document.getElementById('sidebar');

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

sidebarSwitch.addEventListener('click', function (e) {
    let sidebar = localStorage.getItem('sidebar') == 'true' ? true : false;
    let next = !sidebar;

    localStorage.setItem('sidebar', next);

    if(next)
    {
        sideBar.classList.add('d-block');
        sideBar.classList.add('w-[20%]');
        sideBar.classList.remove('hidden');
        sideBar.classList.remove('w-[0%]');
        mainLayout.classList.add('w-[80%]');
        mainLayout.classList.remove('w-[100%]');

    }
    else{
        sideBar.classList.remove('d-block');
        sideBar.classList.remove('w-[20%]');
        sideBar.classList.add('hidden');
        sideBar.classList.add('w-[0%]');
        mainLayout.classList.remove('w-[80%]');
        mainLayout.classList.add('w-[100%]');
    }

})


