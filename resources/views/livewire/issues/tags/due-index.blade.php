<div class="relative ">

    <div class="dropdown dropdown-end">
        <label tabindex="0"
            class=" m-1 flex bg-SoftBg py-[6px] px-2 justify-start rounded-lg text-xs items-center gap-x-2  drop-shadow-lg cursor-pointer">
            <svg aria-hidden="true" id="calenderPicker" class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
            </svg>
            <p class="text-SoftText text-xs">{{ empty($due_date) ? 'Set Due Date' : $due_date }}</p>
        </label>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 bg-SoftBg drop-shadow-lg rounded-box w-40">
            <li class="mt-1">
                <button wire:click="setDueDateTmr">
                    <x-calendar-svg />
                    <p class="text-SoftText text-xs">Tommorow</p>
                </button>
            </li>
            <li class="mt-1">
                <button wire:click="setDueDateNextWeek">
                    <x-calendar-svg />
                    <p class="text-SoftText text-xs">Next Week</p>
                </button>
            </li>
            <li class="mt-1">
                <label class="cursor-pointer" for="datePicker{{ $index }}">
                    <x-calendar-svg />
                    <p class="text-SoftText text-xs">Custom</p>

                </label>
            </li>


        </ul>
    </div>


    <input datepicker autocomplete="off" id="datePicker{{ $index }}" wire:model="due_date" type="text"
        class="
    absolute top-0 left-0 focus:border-none focus:ring-0 focus:outline-none
    w-0 h-0 border-none bg-transparent"
        placeholder="Select date">
</div>

@if ($errors->has('due_date'))
    <p class="text-red-500 text-xs">{{ $errors->first('due_date') }}</p>
@endif



@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var datePicker= "#datePicker" + "{{ $index }}";
            console.log(datePicker );
            $("#calenderPicker").click(function() {
                $(datePicker).click()
            })

            $(datePicker).on("focusout", function(e) {
                date = e.target.value
                Livewire.emit('changeDueDate', date)
            })

        });
    </script>
@endpush
