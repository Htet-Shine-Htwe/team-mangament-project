<div class="">
    <div class="space-y-4">
        <div class=" text-PrimaryText  border-b-[1px] w-full border-SeparateBorder">
            <div class="p-8 sm:px-24">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="py-4  text-PrimaryText  sm:rounded-lg">
            <div class="px-8 pb-8 sm:px-24">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@push('js')
<script>

</script>
@endpush
