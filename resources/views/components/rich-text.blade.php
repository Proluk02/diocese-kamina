@props(['value' => ''])

<div
    wire:ignore
    x-data="{
        content: '{{ $value }}',
        init() {
            // 1. Initialisation de Quill avec barre d'outils COMPLÈTE
            let quill = new Quill(this.$refs.quillEditor, {
                theme: 'snow',
                placeholder: 'Rédigez le contenu complet ici...',
                modules: {
                    toolbar: [
                        // POLICE ET TAILLE
                        [{ 'font': [] }], 
                        [{ 'size': ['small', false, 'large', 'huge'] }], 

                        // TITRES
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                        // GRAS, ITALIQUE, SOULIGNÉ, BARRÉ
                        ['bold', 'italic', 'underline', 'strike'], 

                        // COULEUR TEXTE ET SURLIGNAGE
                        [{ 'color': [] }, { 'background': [] }], 

                        // ALIGNEMENTS (Gauche, Centre, Droite, Justifié)
                        [{ 'align': [] }],

                        // LISTES ET RETRAITS
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }], 

                        // EXPOSANT / INDICE
                        [{ 'script': 'sub'}, { 'script': 'super' }],

                        // CITATION ET BLOC DE CODE
                        ['blockquote', 'code-block'],

                        // LIENS, IMAGES, VIDÉOS
                        ['link', 'image', 'video'],

                        // NETTOYER LE FORMATAGE
                        ['clean']
                    ]
                }
            });

            // 2. Remplir l'éditeur (Mode Édition)
            let initialContent = @this.get('{{ $attributes->wire('model')->value() }}');
            if (initialContent) {
                quill.root.innerHTML = initialContent;
            }

            // 3. Écouter les changements et sauvegarder via $wire.set
            quill.on('text-change', () => {
                let html = quill.root.innerHTML;
                let contentToSave = (html === '<p><br></p>' || html.trim() === '') ? null : html;
                @this.set('{{ $attributes->wire('model')->value() }}', contentToSave);
            });
        }
    }"
    class="w-full bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 overflow-hidden"
>
    <!-- Conteneur de l'éditeur -->
    <div x-ref="quillEditor" class="min-h-[300px] text-gray-900 dark:text-gray-100"></div>

    <!-- Styles CSS spécifiques pour Quill en Dark Mode -->
    <style>
        /* La barre d'outils */
        .ql-toolbar {
            border-color: inherit !important;
            border-top: none; border-left: none; border-right: none;
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb !important;
        }
        
        /* Dark Mode: Barre d'outils */
        .dark .ql-toolbar { 
            background-color: #1f2937; 
            color: #e5e7eb; 
            border-bottom: 1px solid #374151 !important;
        }

        /* Corps de l'éditeur */
        .ql-container { 
            border: none !important; 
            font-family: inherit; 
            font-size: 1rem; 
        }

        /* Icônes (SVG) en Dark Mode */
        .dark .ql-stroke { stroke: #9ca3af !important; }
        .dark .ql-fill { fill: #9ca3af !important; }
        
        /* Menus déroulants (Polices, Tailles, Alignements) */
        .dark .ql-picker { color: #9ca3af !important; }
        .dark .ql-picker-options { background-color: #1f2937 !important; border-color: #374151 !important; }
        .dark .ql-picker-item { color: #d1d5db !important; }
        .dark .ql-picker-item:hover { color: #ffffff !important; background-color: #374151; }
        
        /* Gestion de la hauteur minimum */
        .ql-editor { min-height: 300px; }
    </style>
</div>