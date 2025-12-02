import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Couleurs inspirées de KBH Dashboard & Diocèse
                brand: {
                    dark: '#0f172a',    // Bleu nuit très sombre (Sidebar)
                    primary: '#1e293b', // Bleu gris (Header/Cards foncées)
                    accent: '#D4AF37',  // Le Doré du diocèse (pour les boutons/liens actifs)
                    bg: '#f3f4f6',      // Gris très clair (Fond de page)
                    success: '#10b981', // Vert (Boutons valider/payer)
                    danger: '#ef4444',  // Rouge (Refuser/Supprimer)
                    blue: '#003366',    // Bleu officiel du diocèse
                }
            }
        },
    },

    plugins: [forms],
};