@props(['value' => ''])

<div
    wire:ignore
    x-data="{
        value: @entangle($attributes->wire('model')),
        init() {
            let quill = new Quill(this.$refs.quillEditor, {
                theme: 'snow',
                placeholder: 'Écrivez votre texte ici...',
                modules: {
                    toolbar: [
                        // Titres
                        [{ 'header': [2, 3, 4, false] }],
                        
                        // Style de texte
                        ['bold', 'italic', 'underline', 'strike'],
                        
                        // Couleurs
                        [{ 'color': [] }, { 'background': [] }],
                        
                        // Alignement (Indispensable pour les paroles de chants)
                        [{ 'align': [] }],
                        
                        // Listes et Indentation
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        
                        // Extras
                        ['blockquote', 'link', 'clean']
                    ]
                }
            });

            // 1. Initialisation : Charger la valeur existante
            // Utilisation de $nextTick pour s'assurer que le DOM est prêt
            this.$nextTick(() => {
                if (this.value) {
                    quill.root.innerHTML = this.value;
                }
            });

            // 2. Quill -> Livewire : À chaque modification
            quill.on('text-change', () => {
                let html = quill.root.innerHTML;
                
                // Nettoyage si l'éditeur est vide
                if (html === '<p><br></p>' || html === '<p></p>') {
                    html = '';
                }
                
                this.value = html;
                
                // Force l'envoi à Livewire (Solution robuste)
                @this.set('{{ $attributes->wire('model')->value() }}', html);
            });

            // 3. Livewire -> Quill : Si la donnée change depuis le serveur
            this.$watch('value', (newValue) => {
                if (quill.root.innerHTML !== newValue) {
                    quill.root.innerHTML = newValue ?? '';
                }
            });
        }
    }"
    class="w-full bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 overflow-hidden group"
>
    <!-- Zone d'édition -->
    <div x-ref="quillEditor" class="min-h-[200px] text-gray-900 dark:text-gray-100 font-sans text-base leading-relaxed"></div>
    
    <!-- CSS Personnalisé pour l'intégration Dark Mode -->
    <style>
        /* Toolbar */
        .ql-toolbar { 
            border-color: inherit !important; 
            background-color: #f8fafc; 
            border-top: none; border-left: none; border-right: none; 
            border-bottom: 1px solid #e2e8f0;
        }
        
        /* Container */
        .ql-container { 
            border: none !important; 
            font-size: 1rem; 
        }

        /* Dark Mode */
        .dark .ql-toolbar { 
            background-color: #1f2937; 
            border-bottom: 1px solid #374151;
        }
        
        /* Icônes de la toolbar en Dark Mode */
        .dark .ql-stroke { stroke: #9ca3af !important; }
        .dark .ql-fill { fill: #9ca3af !important; }
        
        /* Dropdowns (Alignement, Couleur, Header) en Dark Mode */
        .dark .ql-picker { color: #9ca3af !important; }
        .dark .ql-picker-options { background-color: #1f2937 !important; border-color: #374151 !important; }
        .dark .ql-picker-item { color: #e5e7eb !important; }
        .dark .ql-picker-item:hover { color: #D4AF37 !important; } /* Kamina Gold au survol */
        
        /* Editor Content */
        .ql-editor { padding: 1rem; }
        .ql-editor.ql-blank::before { color: #9ca3af; font-style: italic; }
    </style>
</div>