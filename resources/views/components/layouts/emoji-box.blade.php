<div class="" x-data="{ emoji: false }">
    <button wire:click.prevent="" x-on:click="emoji = true" @keydown.escape="emoji = false"
        class="px-3 py-2  rounded-l-lg bg-gray-300 bg-opacity-40 border-[1px] border-SeparateBorder hover:bg-HoverBg transition">
        <span>&#x{{ Str::substr($selectedEmoji, 0, 5) }}</span>
    </button>
    <div x-show="emoji" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-20">
        <div @click.away="emoji = false" class="p-4 bg-SoftBg rounded-lg shadow-xl h-[200px] w-[280px] overflow-scroll"
            id="emojiContainer">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold">Select an Emoji</h2>
                <button x-on:click="emoji = false"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <x-cross-icon/>
                </button>
            </div>
            <div class="grid grid-cols-5 gap-2 ">
                @foreach ($emojis as $emoji)
                    <button wire:click.prevent="selectEmoji('{{ $emoji['codes'] }}')"
                        class="p-2 bg-SecondaryBg rounded-lg hover:bg-HoverBg focus:outline-none">
                        &#x{{ Str::substr($emoji['codes'], 0, 5) }}
                    </button>
                @endforeach
                <div x-data="{
                    observe()
                    {
                        const observer = new IntersectionObserver((emojis)=>{
                            emojis.forEach(emoji => {
                                if(emoji.isIntersecting)
                                @this.loadMore();
                            })
                        })
                        observer.observe(this.$el)
                    }
                }" x-init="observe">

                </div>
            </div>
            <div wire:loading class="animate-spin flex items-center justify-center  ml-28">
                <i class="fa-solid fa-spinner "></i>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            $('#cropModel').hide();

            let isLoading = false;
            const emojiContainer = document.getElementById('emojiContainer');

            emojiContainer.addEventListener('scroll', function(){
                if (isLoading) {
                    return;
                }
                const containerHeight = emojiContainer.offsetHeight;
                const contentHeight = emojiContainer.scrollHeight;
                const scrollOffset = emojiContainer.scrollTop;

                if (containerHeight + scrollOffset >= contentHeight) {
                    isLoading = true;
                    Livewire.emit('loadMore', function() {
                        isLoading = false;
                    });
                }
            });


        });
    </script>
@endpush
