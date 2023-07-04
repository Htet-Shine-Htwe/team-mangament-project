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
                        class=" w-8 h-8 flex items-center justify-center rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" id="column">
                            <path fill="#576d7e"
                                d="m7.824 2-2.246.115c.815.815.731.735.8.807L4.298 5.004l.707.707 2.08-2.08c.07.073-.013-.01.799.803h.002L8 2.176A.166.166 0 0 0 7.824 2zM11.5 2c-.277 0-.5.223-.5.5v9c0 .277.223.5.5.5h2c.277 0 .5-.223.5-.5v-9c0-.277-.223-.5-.5-.5h-2zm-4 3c-.277 0-.5.223-.5.5v6c0 .277.223.5.5.5h2c.277 0 .5-.223.5-.5v-6c0-.277-.223-.5-.5-.5h-2zM3.625 7A.624.624 0 0 0 3 7.625v3.75c0 .346.279.625.625.625h1.75A.624.624 0 0 0 6 11.375v-3.75A.624.624 0 0 0 5.375 7h-1.75zM2.4 13a.5.5 0 0 0 .051 1h12.041a.5.5 0 1 0 0-1H2.452a.5.5 0 0 0-.052 0z">
                            </path>
                        </svg>
                    </button>

                    <button id="showRow" data-layout="row"
                        class=" bg-SoftBg w-8 h-8 flex items-center justify-center rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 32 32"
                            id="menu-list">
                            <path fill="#576d7e"
                                d="M28 9.25H4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm0 7H4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm0 7H4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm0-21H4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class=" w-full">
        <div data-layout="column" id="issue-container" class="flex w-full flex-col gap-x-3 overflow-x-scroll pb-10">

            @foreach ($issues as $status)

                <div class="max-h-[60vh] overflow-y-scroll relative">
                    <div wire:key='status-{{ $status['id'] }}' wire:ignore
                        class="issues-title-col px-12 py-4  w-full flex justify-between bg-SoftBg items-center border-b-[1px] border-SeparateBorder ">
                        <div class="flex items-center gap-x-2">
                            <i style="color: {{ $status['color'] }}" class="fa-solid fa-circle text-gray-300"></i>
                            <p class="font-medium text-sm">{{ $status['title'] }}</p>
                            {{-- <span class="badge">{{ $status['status_count']}}</span> --}}
                        </div>
                        <div class="flex items-center">
                            <i class="fa-solid fa-plus"></i>
                            <div wire:loading wire:target='loadMore'
                                class="animate-spin flex items-center justify-center  ml-28">
                                <i class="fa-solid fa-spinner "></i>
                            </div>
                        </div>
                    </div>
                    @php
                        $color = $status['color'];
                    @endphp

                    @forelse ($status['issues'] as $issue)
                        @include('livewire.issues.column-view')

                    @empty
                    @endforelse

                    <button class="absolute bottom-0 left-1/2" wire:key='status-{{ $status['id'] }}'
                    wire:click="loadMore('{{ $status['title'] }}','{{ $status['id'] }}')">
                    loadmore
                </button>
                </div>

                {{-- col end --}}
                <div wire:key='status-{{ $status['id'] }}' id="issue-box" class="flex flex-col">

                    {{-- row start --}}
                    <div
                        class="issues-row px-12 py-4  w-[300px] flex justify-between bg-SoftBg items-center border-b-[1px] border-SeparateBorder ">
                        <div class="flex items-center gap-x-2">
                            <i style="color: {{ $status['color'] }}" class="fa-solid fa-circle text-gray-300"></i>
                            <p class="font-medium text-sm">{{ $status['title'] }}</p>
                            {{-- <span class="badge">{{ $status->issues_count }}</span> --}}
                        </div>
                        <div class="flex items-center">
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
                $(this).click(function() {
                    $(this).nextUntil('.issues-title-col').slideToggle(300);
                })
            })

        });
    </script>
@endpush
