<div>

    @if ($currentWorkspace->logo_path != "empty")
    <img src="{{ getWorkshopPhoto($currentWorkspace->logo_path,'s3') }}"  class="w-6 h-6 "/>
    @else

    <div class="px-[4px] py-[2px] text-white rounded-sm text-[8px]" style="background-color: {{ $haxColor }};">
        <p class="">{{ $workspaceName }}</p>
        <!-- Content goes here -->
    </div>
    @endif
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>
