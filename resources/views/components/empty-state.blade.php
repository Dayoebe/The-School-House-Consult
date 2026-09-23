@props(['title', 'text'])<div class="flex items-center gap-7 rounded border border-line bg-white p-[38px] max-[640px]:rounded-xl max-[640px]:p-[25px]">
<span class="grid h-[62px] w-[62px] shrink-0 place-items-center rounded bg-[#edf1f7] text-navy">
<i class="fa-solid fa-folder-open text-xl" aria-hidden="true"></i>
</span>
<div>
<h3 class="mb-2.5 text-[21px] font-semibold text-navy">{{ $title }}</h3>
<p class="max-w-[800px] text-[14px] text-muted">{{ $text }}</p>
</div>
</div>
