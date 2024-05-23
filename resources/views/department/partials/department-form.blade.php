<x-primary-button-link href="{{ route('department.create') }}" id="department-dialog">
    {{ __('Add Department') }}
</x-primary-button-link>

<div id="department-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Create Department
            </h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">
                    This is a simple modal example.
                </p>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 gap-4 sm:px-6 sm:flex sm:flex-row-reverse">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>
            <x-secondary-button>
                {{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Modal Component
        class Modal {
            constructor() {
                this.modal = $('#department-modal');
                this.closeModalButton = $('#closeModalButton');

                // Listen for close click
                this.closeModalButton.on('click', () => this.close());

                // Listen for outside click
                $(window).on('click', (event) => {
                    if ($(event.target).is(this.modal)) {
                        this.close();
                    }
                });
            }

            open() {
                this.modal.removeClass('hidden');
            }

            close() {
                this.modal.addClass('hidden');
            }
        }

        // Instantiate the modal
        const modal = new Modal();

        // Get open modal button
        const openModalButton = $('#department-dialog');

        // Listen for open click
        openModalButton.on('click', (event) => {
            event.preventDefault(); // Prevent default link behavior
            modal.open();
        });
    });
</script>