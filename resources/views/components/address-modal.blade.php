@props(['title', 'route'])
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('general.profile.addresses.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <x-input-label class="form-label form-label-sm" for="name">Name Of Address</x-input-label>
                        <x-input-text name="name" class="form-control form-control-sm border-success-subtle" required />
                        <x-input-error name="name" :message="$errors->first('name')" />
                    </div>
                    <h3 class="fs-6 fw-light mt-3 mb-2">Address Details</h3>
                    <div class="row mb-3">
                        <div class="col-2">
                            <x-input-label for="street_address">{{ __('Street') }}</x-input-label>
                        </div>
                        <div class="col-10">
                            <x-input-text name="street_address" class="form-control form-control-sm border-success-subtle" required />
                            <x-input-error name="street_address" :message="$errors->first('street_address')" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <x-input-label for="city">{{ __('City') }}</x-input-label>
                        </div>
                        <div class="col-10">
                            <x-input-text name="city" class="form-control form-control-sm border-success-subtle" required />
                            <x-input-error name="city" :message="$errors->first('city')" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <x-input-label for="province">{{ __('Province') }}</x-input-label>
                        </div>
                        <div class="col-10">
                            <x-select-dropdown name="province" options="Eastern Cape, Free State, Gauteng, Kwa-Zulu Natal, Limpopo, Mpumalanga, Northern Cape, North West, Western Cape" class="form-control form-control-sm border-success-subtle" required />
                            <x-input-error name="province" :message="$errors->first('province')" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <x-input-label for="postal_code">{{ __('Postal Code') }}</x-input-label>
                        </div>
                        <div class="col-10">
                            <x-input-text name="postal_code" class="form-control form-control-sm border-success-subtle" required />
                            <x-input-error name="postal_code" :message="$errors->first('postal_code')" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <x-input-text type="checkbox" name="is_primary" class="" autocomplete="off" required />
                        <x-input-label for="is_primary">{{ __('Make this my primary address') }}</x-input-label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <x-button type="button" class="btn btn-success">Save</x-button>
            </div>
        </form>
    </div>
</div>