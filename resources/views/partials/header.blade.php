<div class="p-4 bg-primary d-flex justify-content-between align-items-start" style="height: 10rem;">
    <div class="d-flex align-items-center gap-3">
        <i class="bi {{ $icon }} flex-item" style="color: white; font-size: 24px;"></i>
        <h4 class="text-light flex-item m-0">{{ $title }}</h4>
    </div>
    <h4 class="text-white m-0 text-center">Halo, {{ auth()->user()->role === 'Admin' ? auth()->user()->role : '' }}
        {{ explode(' ', auth()->user()->name)[0] }}
    </h4>
</div>
