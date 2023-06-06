<div>
    @if ($photo)
    <img src="{{ getLogo() }}"  class="w-6 h-6 "/>
    @else

    <div class="px-[4px] py-[2px] rounded-sm text-[8px]" style="background-color: {{ $haxColor }};">
        <p class="">{{ $workspace }}</p>
        <!-- Content goes here -->
    </div>
    @endif
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>
