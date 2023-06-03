<div class="relative">
    <div class="space-y-4" x-data="crop">
        <div class=" text-PrimaryText  border-b-[1px] w-full border-SeparateBorder">

        </div>
        <div id="profile_photo">

        </div>
        <div class="py-4  text-PrimaryText  sm:rounded-lg">
            <div class="px-8 pb-8 sm:px-24">
                @include('components.delete-workspace')
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        })
    </script>
@endpush
