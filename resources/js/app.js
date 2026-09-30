import 'animate.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

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
        const isEditing = Boolean(document.activeElement?.matches('input:not([type="checkbox"]):not([type="radio"]), textarea, select'));
        document.body.classList.toggle('is-editing', isEditing);
        document.querySelector('.mobile-tabs')?.classList.toggle('hidden', isEditing);
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

    const installHelp = document.querySelector('[data-install-help]');
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
    const isIos = /iphone|ipad|ipod/i.test(window.navigator.userAgent);
    if (!isStandalone && (installationPrompt || isIos)) {
        document.querySelectorAll('[data-install-app]').forEach((button) => { button.hidden = false; });
    }
    document.querySelectorAll('[data-close-install-help]').forEach((button) => button.addEventListener('click', () => installHelp?.close()));
    installHelp?.addEventListener('click', (event) => {
        if (event.target === installHelp) installHelp.close();
    });

    document.querySelectorAll('form').forEach((form) => {
        const title = form.querySelector('[data-program-title]');
        const slug = form.querySelector('[data-program-slug]');
        if (!title || !slug) return;

        const slugify = (value) => value.toLowerCase().normalize('NFKD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '')
            .slice(0, 200);
        let automatic = !slug.value || slug.value === slugify(title.value);
        title.addEventListener('input', () => {
            if (automatic) slug.value = slugify(title.value);
        });
        slug.addEventListener('input', () => { automatic = false; });
        form.querySelector('[data-regenerate-slug]')?.addEventListener('click', () => {
            automatic = true;
            slug.value = slugify(title.value);
            slug.focus();
        });
    });

    document.querySelectorAll('[data-rich-text]').forEach((editor) => {
        const surface = editor.querySelector('[data-editor-surface]');
        const input = editor.querySelector('[data-editor-input]');
        if (!surface || !input) return;

        const sync = () => { input.value = surface.innerHTML; };
        surface.addEventListener('input', sync);
        surface.closest('form')?.addEventListener('submit', sync);

        editor.querySelector('[data-format-block]')?.addEventListener('change', (event) => {
            surface.focus();
            document.execCommand('formatBlock', false, event.target.value);
            sync();
        });
        editor.querySelectorAll('[data-editor-command]').forEach((button) => button.addEventListener('mousedown', (event) => {
            event.preventDefault();
            const command = button.dataset.editorCommand;
            let value = null;
            if (command === 'createLink') {
                value = window.prompt('Enter a complete link, for example https://example.com');
                if (!value) return;
            }
            surface.focus();
            document.execCommand(command, false, value);
            sync();
        }));
    });

    document.querySelectorAll('[data-gallery-input]').forEach((input) => {
        const preview = input.closest('section')?.querySelector('[data-gallery-preview]');
        if (!preview) return;

        let objectUrls = [];
        input.addEventListener('change', () => {
            objectUrls.forEach((url) => URL.revokeObjectURL(url));
            objectUrls = [];
            preview.replaceChildren();
            const files = [...input.files];
            preview.classList.toggle('hidden', files.length === 0);
            preview.classList.toggle('grid', files.length > 0);

            files.forEach((file, index) => {
                const url = URL.createObjectURL(file);
                objectUrls.push(url);
                const card = document.createElement('figure');
                card.className = 'overflow-hidden rounded-xl border border-emerald-200 bg-white';
                const image = document.createElement('img');
                image.className = 'aspect-square w-full object-cover';
                image.src = url;
                image.alt = `Selected image ${index + 1}`;
                const caption = document.createElement('figcaption');
                caption.className = 'truncate px-3 py-2 text-[9px] font-bold text-slate-600';
                caption.textContent = `${index + 1}. ${file.name}`;
                card.append(image, caption);
                preview.append(card);
            });
        });
    });

    const galleryDialog = document.querySelector('[data-program-gallery-dialog]');
    const galleryDialogImage = galleryDialog?.querySelector('img');
    document.querySelectorAll('[data-program-gallery-open]').forEach((button) => button.addEventListener('click', () => {
        if (!galleryDialog || !galleryDialogImage) return;
        galleryDialogImage.src = button.dataset.programGalleryOpen;
        galleryDialogImage.alt = button.dataset.galleryAlt || 'Programme gallery image';
        galleryDialog.showModal();
    }));
    galleryDialog?.querySelector('[data-gallery-close]')?.addEventListener('click', () => galleryDialog.close());
    galleryDialog?.addEventListener('click', (event) => {
        if (event.target === galleryDialog) galleryDialog.close();
    });
};

let installationPrompt = null;
window.addEventListener('beforeinstallprompt', (event) => {
    event.preventDefault();
    installationPrompt = event;
    document.querySelectorAll('[data-install-app]').forEach((button) => { button.hidden = false; });
});
window.addEventListener('appinstalled', () => {
    installationPrompt = null;
    document.querySelectorAll('[data-install-app]').forEach((element) => { element.hidden = true; });
    document.querySelector('[data-install-help]')?.close();
});
document.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-install-app]');
    if (!button) return;
    if (!installationPrompt) {
        const isIos = /iphone|ipad|ipod/i.test(window.navigator.userAgent);
        if (isIos) document.querySelector('[data-install-help]')?.showModal();
        return;
    }
    button.disabled = true;
    const feedback = document.querySelector('[data-install-feedback]');
    try {
        await installationPrompt.prompt();
        const choice = await installationPrompt.userChoice;
        if (feedback && choice.outcome === 'accepted') {
            feedback.textContent = 'School House Consult is being added to your home screen.';
            feedback.hidden = false;
        }
    } catch {
        if (feedback) {
            feedback.textContent = 'Please use your browser menu to add School House Consult to your home screen.';
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
        console.warn('School House Consult offline support could not be enabled.', error);
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
