import modal from './modules/modal';

const registeredModules = { modal };

document.querySelectorAll(':scope [data-js]').forEach((element) => {
    initializeModules(element);
});

function initializeModules(elem) {
    const module = elem.getAttribute('data-js');

    if (module === undefined) {
        throw 'Module not defined (use data-module="")';
    } else if (module in registeredModules) {
        if (elem.getAttribute('data-initialized') === 'true') return;
        new registeredModules[module](elem);
        elem.setAttribute('data-initialized', true);
    } else {
        throw `Module ${module} not found`;
    }
}
