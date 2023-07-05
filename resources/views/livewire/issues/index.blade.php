<div class="relative flex flex-col h-[100vh] bg-PrimaryBg rounded-lg w-ful  shadow pb-10 overflow-y-scroll">
    <!-- Modal header -->
    <header class="w-full block">
        <div class="flex w-full items-center justify-between px-12 py-6 shadow-lg border-b border-SeparateBorder ">
            <h3 class=" text-xl font-semibold">
                All Issues
            </h3>

            <div class="">
                <div class="flex items-center bg-SoftBg rounded-lg">
                    <button id="showColumn" data-layout="column"
                        class=" w-8 h-8 flex active-btn items-center justify-center rounded-lg">
                        @include('components.svgs.column-svg')
                    </button>

                    <button id="showRow" data-layout="row"
                        class=" bg-SoftBg w-8 h-8 flex items-center justify-center rounded-lg">
                        @include('components.svgs.row-svg')
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class=" w-full">
        <div data-layout="column" id="issue-container" class="flex w-full flex-col gap-x-3 overflow-x-scroll pb-10">

            @foreach ($issues as $status)
                <div wire:key='status-{{ $status['id'] }}'
                    class="issues-title-col px-12 py-4  w-full flex justify-between bg-SoftBg items-center border-b-[1px] border-SeparateBorder ">
                    <div class="flex items-center gap-x-2">
                        <i style="color: {{ $status['color'] }}" class="fa-solid fa-circle text-gray-300"></i>
                        <p class="font-medium text-sm">{{ $status['title'] }}</p>
                        <span class="badge">{{ $status['issue_count'] }}</span>
                    </div>
                    <div class="flex items-center gap-x-4">

                        <button class="flex w-full justify-center" wire:key='status-{{ $status['id'] }}'
                            wire:click="loadMore('{{ $status['title'] }}','{{ $status['id'] }}')">
                            <div wire:loading wire:target='loadMore' class="animate-spin ">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </div>
                            <div wire:loading.remove wire:target='loadMore' class="">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </div>
                        </button>


                        <i class="fa-solid fa-plus"></i>

                    </div>
                </div>
                @php
                    $color = $status['color'];
                @endphp
                <div class="max-h-[60vh] overflow-y-scroll relative">

                    @forelse ($status['issues'] as $issue)
                        @include('livewire.issues.column-view')

                    @empty
                    @endforelse

                </div>

                {{-- col end --}}
                <div wire:key='status-{{ $status['id'] }}' id="issue-box" class="flex flex-col mt-3">

                    {{-- row start --}}
                    <div
                        class="issues-row px-12 py-4  w-[300px] flex justify-between bg-SoftBg items-center border-b-[1px] border-SeparateBorder ">
                        <div class="flex items-center gap-x-2">
                            <i style="color: {{ $status['color'] }}" class="fa-solid fa-circle text-gray-300"></i>
                            <p class="font-medium text-sm">{{ $status['title'] }}</p>
                            <span class="badge">{{ $status['issue_count'] }}</span>
                        </div>
                        <div class="flex items-center gap-x-4">
                            <button class="flex w-full justify-center" wire:key='status-{{ $status['id'] }}'
                                wire:click="loadMore('{{ $status['title'] }}','{{ $status['id'] }}')">
                                <div wire:loading wire:target='loadMore' class="animate-spin ">
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </div>
                                <div wire:loading.remove wire:target='loadMore' class="">
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                </div>
                            </button>
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    {{-- row end --}}
                    @php
                        $color = $status['color'];
                    @endphp
                    @forelse ($status['issues'] as $issue)
                        @include('livewire.issues.row-view')
                    @empty
                    @endforelse
                </div>
            @endforeach


        </div>
    </div>
    <!-- Modal footer -->

</div>

@push('js')
    <script>
        window.addEventListener('initSomething', event => {
            $(".issues-row").removeClass("flex").addClass("hidden")

            // anything you want to initialize
        })


        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('issue-container');
            const buttons = document.querySelectorAll('button[data-layout]');

            $(".issues-row").removeClass("flex").addClass("hidden")

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const layout = button.getAttribute('data-layout');
                    container.setAttribute('data-layout', layout);
                    $("button[data-layout]").removeClass("active-btn");

                    $("button[data-layout='" + layout + "']").addClass("active-btn");

                    if (layout == 'column') {
                        $("#issue-container").removeClass("flex-row").addClass("flex-col");
                        $(".issues-row").removeClass("flex").addClass("hidden")
                        $(".issues-col").removeClass("hidden").addClass("flex")
                        $(".issues-title-col").removeClass("hidden").addClass("flex")
                    } else {
                        $("#issue-container").removeClass("flex-col").addClass("flex-row");
                        $("#issue-box").removeClass("flex").removeClass("flex-col")
                        $(".issues-row").removeClass("hidden").addClass("flex")
                        $(".issues-col").removeClass("flex").addClass("hidden")
                        $(".issues-title-col").removeClass("flex").addClass("hidden")

                    }

                });

            });

            $(".issues-title-col").each(function() {
                $(this).click(function(event) {
                    if (event.target === this) {
                        event.stopPropagation();
                        $(this).nextUntil('.issues-title-col').slideToggle(300);
                    }
                })
            })

/
            $.ajax({
                url: '/api/issues',
                type: 'GET',
                dataType: 'json',

                success: function(response) {
                    // Handle the successful response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle the error
                    console.log(error);
                }
            });
        });
    </script>
@endpush
