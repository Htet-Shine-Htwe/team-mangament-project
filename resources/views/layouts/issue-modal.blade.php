<div id="test"
    class="absolute w-full h-full flex justify-center items-start pt-20 bg-gray-600 bg-opacity-70 z-10">
    <!-- Main modal -->
    <div id="defaultModal" class="z-0 w-3/6 p-4 ">
        <div class="relative ">
            <!-- Modal content -->
            <livewire:issues.model.index  >
        </div>
    </div>

</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Livewire.on('refreshIssues', postId => {
                $("#test").hide();
            console.log('refreshIssues')
            })

    });
    </script>
@endpush
