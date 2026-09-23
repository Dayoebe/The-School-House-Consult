@props(['faq'])<details class="border-b border-line first:border-t first:border-line">
<summary class="flex cursor-pointer list-none items-center justify-between gap-6 py-6 text-[17px] font-semibold text-navy [&::-webkit-details-marker]:hidden">{{ $faq->question }}<span class="text-[25px] font-normal text-[#a54c09] transition group-open:rotate-45" aria-hidden="true">+</span>
</summary>
<p class="pb-[26px] pr-[30px] text-[15px] text-muted">{{ $faq->answer }}</p>
</details>
