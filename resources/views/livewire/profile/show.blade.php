<div class="relative">
    <div class="space-y-4">
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
            $('#cropModel').hide();

            $(document).on('click', function(event) {
                // Check if the click target is outside the model
                if (!$(event.target).closest('#cropInnerModel').length) {
                    // Close the model here
                    $('#cropModel').hide(300);
                }
            });
            var resize = $('#upload-demo').croppie({
                enableExif: true,
                viewport: {
                    width: 250,
                    height: 250,
                    type: 'circle'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });

            var formData = new FormData();
            var croppedImage = 'empty';

            $('#profile').on('change', function() {
                var reader = new FileReader();

                reader.onload = function(e) {

                    resize.croppie('bind', {
                        url: e.target.result,
                        points: [0, 0, 0, 0]
                    }).then(function() {
                        console.log('success bind image');
                    });

                }
                // $('#cropModel').show(300);

                reader.readAsDataURL(this.files[0]);


            });

            $('#closeModel').on('click', function() {
                $('#cropModel').hide();
            });

            function dataURLtoBlob(dataURL) {
                const arr = dataURL.split(',');
                const mime = arr[0].match(/:(.*?);/)[1];
                const bstr = atob(arr[1]);
                let n = bstr.length;
                const u8arr = new Uint8Array(n);
                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new Blob([u8arr], {
                    type: mime
                });
            }

            $("#saveCropped").on('click', function(e) {
                e.preventDefault();

                resize.croppie('result', {
                    type: 'canvas',
                    size: 'viewport',
                    dataType: 'json',
                }).then(function(img) {
                    const blob = dataURLtoBlob(img);
                    const file = new File([blob], 'cropedp.jpeg', {
                        type: 'image/jpeg'
                    });
                    croppedImage = file;

                    formData.append('image', croppedImage);
                    formData.append('name', 'htet');

                    Livewire.emit('startLoading');
                    $.ajax({
                            url: '{{ route('saveCropped') }}',
                            type: "POST",
                            data: formData,
                            processData: false, // Prevent jQuery from processing the formData
                            contentType: false,
                            complete: function() {
                                Livewire.emit('stopLoading');
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        })
                        .done(function(response) {
                            $('#cropModel').hide(300);
                        })
                });

            })
        });
    </script>
@endpush
