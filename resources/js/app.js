// Livewire provides Alpine. The application shell uses native browser controls.
const initialiseShell = () => {
    const menu = document.querySelector('#mobile-menu');
    const menuButtons = document.querySelectorAll('[data-open-menu]');
    let menuTrigger = null;

    const closeMenu = () => {
        if (menu?.open) menu.close();
    };

    menuButtons.forEach((button) => button.addEventListener('click', () => {
        if (!menu) return;
        menuTrigger = button;
        menu.showModal();
        document.body.classList.add('menu-is-open');
        menuButtons.forEach((trigger) => trigger.setAttribute('aria-expanded', 'true'));
    }));

    document.querySelectorAll('[data-close-menu]').forEach((button) => button.addEventListener('click', closeMenu));
    menu?.addEventListener('close', () => {
        document.body.classList.remove('menu-is-open');
        menuButtons.forEach((button) => button.setAttribute('aria-expanded', 'false'));
        menuTrigger?.focus();
    });
    menu?.addEventListener('click', (event) => {
        if (event.target !== menu) return;
        const bounds = menu.getBoundingClientRect();
        if (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom) closeMenu();
    });
    window.matchMedia('(min-width: 1191px)').addEventListener('change', (event) => {
        if (event.matches) closeMenu();
    });

    const reflectFormFocus = () => {
        document.body.classList.toggle('is-editing', Boolean(document.activeElement?.matches('input:not([type="checkbox"]):not([type="radio"]), textarea, select')));
    };
    document.addEventListener('focusin', reflectFormFocus);
    document.addEventListener('focusout', () => window.setTimeout(reflectFormFocus, 0));

    const reflectConnection = () => {
        const notice = document.querySelector('[data-connection-notice]');
        if (notice) notice.hidden = navigator.onLine;
    };
    window.addEventListener('online', reflectConnection);
    window.addEventListener('offline', reflectConnection);
    reflectConnection();
};

let installationPrompt = null;
window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    installationPrompt = event;
    document.querySelectorAll('[data-install-app]').forEach((button) => { button.hidden = false; });
});
window.addEventListener('appinstalled', () => {
    installationPrompt = null;
    document.querySelectorAll('[data-install-app], .install-help').forEach((element) => { element.hidden = true; });
});
document.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-install-app]');
    if (!button || !installationPrompt) return;
    button.disabled = true;
    const feedback = document.querySelector('[data-install-feedback]');
    try {
        await installationPrompt.prompt();
        const choice = await installationPrompt.userChoice;
        if (feedback && choice.outcome === 'accepted') {
            feedback.textContent = 'School House is being added to your home screen.';
            feedback.hidden = false;
        }
    } catch {
        if (feedback) {
            feedback.textContent = 'Please use your browser menu to add School House to your home screen.';
            feedback.hidden = false;
        }
    } finally {
        installationPrompt = null;
        button.hidden = true;
        button.disabled = false;
    }
});

const registerOfflineSupport = () => {
    const source = document.querySelector('meta[name="school-house-service-worker"]')?.content;
    if (!import.meta.env.PROD || !window.isSecureContext || !('serviceWorker' in navigator) || !source) return;
    navigator.serviceWorker.register(source).catch((error) => {
        console.warn('School House offline support could not be enabled.', error);
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initialiseShell, { once: true });
} else {
    initialiseShell();
}
if (document.readyState === 'complete') {
    registerOfflineSupport();
} else {
    window.addEventListener('load', registerOfflineSupport, { once: true });
}
