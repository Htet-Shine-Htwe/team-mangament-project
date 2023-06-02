<div class="relative">
    <div class="space-y-4" x-data="crop">
        @include('components.profile-image-edit-modal')
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
        <form action="{{ route('saveCropped') }}" method="POST">
            @csrf
            <button type="submit">Click</button>
        </form>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var resize = $('#upload-demo').croppie({
                enableExif: true,
                enableOrientation: true,
                viewport: {
                    width: 300,
                    height: 300,
                    type: 'circle'
                },

                boundary: {
                    width: 300,
                    height: 300
                }
            });

            $('#profile').on('change', function() {
                var reader = new FileReader();
                Alpine.data('dropdown', () => ({
                    crop: true,
                    close() {
                        this.crop = !this.crop
                    }
                }))

                reader.onload = function(e) {
                    console.log(e.target.result);
                    resize.croppie('bind', {
                        url: e.target.result,
                        points: [77, 469, 280, 739]
                    }).then(function() {
                        console.log('success bind image');
                    });

                }
                reader.readAsDataURL(this.files[0]);
            });

            $("#saveCropped").on('click', function(e) {
                e.preventDefault();

                resize.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(img) {
                    $.ajax({
                        url: '{{ route('saveCropped') }}',
                        type: "POST",
                        data: {
                            "image": img
                        },
                        success: function(data) {
                            html = '<img src="' + img + '" />';
                            $(".profile_photo").html(html);
                            console.log(data);
                        },
                        error: function(data) {
                            console.log(data);
                        }

                    })
                });

            })
        })
    </script>
@endpush
