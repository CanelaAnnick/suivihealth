@extends('layouts.dashboard')
@section('title', $title.' — SuiviHealth')
@section('page-title', $title)

@section('sidebar')
    @include('partials.'.$roleSidebar, ['active' => $active])
@endsection

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl py-16 text-center">
    <div class="w-12 h-12 mx-auto rounded-xl bg-navy-900/5 flex items-center justify-center text-navy-800 mb-4">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
    </div>
    <h3 class="text-[14px] font-semibold text-slate-900">Page en construction</h3>
    <p class="text-slate-500 text-[13px] mt-1">Cette section sera développée à l'étape suivante.</p>
</div>
@endsection