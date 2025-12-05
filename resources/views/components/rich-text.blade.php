@props(['value' => ''])

<div
    wire:ignore
    x-data="{
        content: @entangle($attributes->wire('model')),
        init() {
            const quill = new Quill($refs.quillEditor, {
                theme: 'snow',
                placeholder: 'Rédigez le contenu de l\'article ici...',
                modules: {
                    toolbar: [
                        [{ 'header': [2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'clean']
                    ]
                }
            });

            // Initialiser le contenu si existant (Edit mode)
            if (this.content) {
                quill.root.innerHTML = this.content;
            }

            // Sync: Quill -> Livewire
            quill.on('text-change', () => {
                this.content = quill.root.innerHTML;
            });

            // Sync: Livewire -> Quill (pour le reset ou chargement externe)
            this.$watch('content', (newContent) => {
                if (newContent === '' || newContent === null) {
                    quill.root.innerHTML = '';
                } else if (quill.root.innerHTML !== newContent) {
                    // Vérification pour éviter boucle infinie
                    quill.root.innerHTML = newContent;
                }
            });
        }
    }"
    class="w-full rounded-lg shadow-sm"
>
    <div x-ref="quillEditor"></div>
</div>