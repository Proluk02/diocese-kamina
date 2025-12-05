import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                kamina: {
                    gold: '#D4AF37',    
                    blue: '#003366',   
                },
                
                brand: {
                    dark: '#0f172a',    // Bleu nuit très sombre (Sidebar / Slate 900)
                    primary: '#1e293b', // Bleu gris (Header sombre / Slate 800)
                    accent: '#D4AF37',  // Alias du Doré pour les accents
                    
                    bg: '#f3f4f6',      // Gris très clair (Fond de page Light)
                    'bg-dark': '#111827', // Gris très sombre (Fond de page Dark)
                    
                    success: '#10b981', // Vert (Validation)
                    danger: '#ef4444',  // Rouge (Erreur/Suppression)
                    warning: '#f59e0b', // Orange (En attente)
                    info: '#3b82f6',    // Bleu clair (Info)
                },
                
                // Alias sémantiques pour la Sidebar (Facilite la maintenance)
                sidebar: {
                    bg: '#0F172A',
                    hover: '#1E293B',
                    active: '#D4AF37',
                    text: '#94A3B8',
                }
            }
        },
    },

    plugins: [forms],
};