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
                        [{ 'header': [2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'clean']
                    ]
                }
            });

            // 1. Initialisation : Charger la valeur existante (IMPORTANT pour l'edit)
            // On utilise un petit délai pour s'assurer que Livewire a envoyé la donnée
            this.$nextTick(() => {
                if (this.value) {
                    quill.root.innerHTML = this.value;
                }
            });

            // 2. Quill -> Livewire
            quill.on('text-change', () => {
                let html = quill.root.innerHTML;
                if (html === '<p><br></p>' || html === '<p></p>') html = '';
                this.value = html;
                @this.set('{{ $attributes->wire('model')->value() }}', html);
            });

            // 3. Livewire -> Quill
            this.$watch('value', (newValue) => {
                if (quill.root.innerHTML !== newValue) {
                    quill.root.innerHTML = newValue ?? '';
                }
            });
        }
    }"
    class="w-full bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-300 dark:border-gray-600 overflow-hidden"
>
    <div x-ref="quillEditor" class="min-h-[150px] text-gray-900 dark:text-gray-100"></div>
    
    <style>
        .ql-toolbar { border-color: inherit !important; background-color: #f9fafb; border-top: none; border-left: none; border-right: none; }
        .dark .ql-toolbar { background-color: #1f2937; color: #e5e7eb; }
        .ql-container { border: none !important; font-size: 1rem; }
        .dark .ql-stroke { stroke: #9ca3af !important; }
        .dark .ql-fill { fill: #9ca3af !important; }
        .dark .ql-picker { color: #9ca3af !important; }
    </style>
</div>