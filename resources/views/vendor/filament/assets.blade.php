@if (isset($data))
    <script>
        window.filamentData = @js($data)
    </script>
@endif

@foreach ($assets as $asset)
    @if (! $asset->isLoadedOnRequest())
        {{ $asset->getHtml() }}
    @endif
@endforeach

<style>
    :root {
        @foreach ($cssVariables ?? [] as $cssVariableName => $cssVariableValue) --{{ $cssVariableName }}:{{ $cssVariableValue }}; @endforeach
    }

    @foreach ($customColors ?? [] as $customColorName => $customColorShades) .fi-color-{{ $customColorName }} { @foreach ($customColorShades as $customColorShade) --color-{{ $customColorShade }}:var(--{{ $customColorName }}-{{ $customColorShade }}); @endforeach } @endforeach

    /* Custom sidebar collapse styling */
    /* Expanded width */
    .fi-sidebar.fi-main-sidebar {
        width: 14rem; /* 56 */
        transition: width .25s ease, min-width .25s ease;
        min-width: 14rem;
        overflow: hidden;
    }

    /* Collapsed (when Filament's sidebar doesn't have .fi-sidebar-open) */
    .fi-sidebar.fi-main-sidebar:not(.fi-sidebar-open) {
        width: 4rem; /* 16 */
        min-width: 4rem;
    }

    /* Hide labels and badges when collapsed */
    .fi-sidebar.fi-main-sidebar:not(.fi-sidebar-open) .fi-sidebar-item-label,
    .fi-sidebar.fi-main-sidebar:not(.fi-sidebar-open) .fi-sidebar-item-badge-ctn,
    .fi-sidebar.fi-main-sidebar:not(.fi-sidebar-open) .fi-sidebar-header-logo-ctn,
    .fi-sidebar.fi-main-sidebar:not(.fi-sidebar-open) .fi-sidebar-nav .fi-sidebar-nav-groups .fi-sidebar-group .fi-sidebar-group-label {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity .18s ease;
    }

    /* Adjust main content margin depending on sidebar open state */
    .fi-main-ctn {
        transition: margin-left .25s ease;
        margin-left: 14rem;
    }

    .fi-main-ctn:not(.fi-main-ctn-sidebar-open) {
        margin-left: 4rem;
    }

    /* Ensure icons remain visible and centered */
    .fi-sidebar.fi-main-sidebar .fi-sidebar-item-btn { display:flex; align-items:center; gap:0.75rem; }
    .fi-sidebar.fi-main-sidebar:not(.fi-sidebar-open) .fi-sidebar-item-icon { margin: 0 auto; }

    /* Smooth transitions for grouped borders */
    .fi-sidebar .fi-sidebar-item-grouped-border { transition: opacity .2s ease; }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        try {
            const stored = localStorage.getItem('filamentSidebarCollapsed');

            // stored === 'true' means collapsed
            if (stored !== null) {
                window.requestAnimationFrame(() => {
                    try {
                        if (window.Alpine && Alpine.store && Alpine.store('sidebar')) {
                            if (stored === 'true') {
                                Alpine.store('sidebar').close();
                            } else {
                                Alpine.store('sidebar').open();
                            }
                        }
                    } catch (e) {
                        // ignore
                    }
                });
            }

            // Listen for toggle clicks on elements that control the sidebar (aria-controls="fi-main-sidebar")
            document.addEventListener('click', (e) => {
                const btn = e.target.closest('[aria-controls="fi-main-sidebar"]');
                if (! btn) return;

                // Delay reading state to allow Filament/Alpine to update
                setTimeout(() => {
                    try {
                        if (window.Alpine && Alpine.store && Alpine.store('sidebar')) {
                            const isOpen = !!Alpine.store('sidebar').isOpen;
                            localStorage.setItem('filamentSidebarCollapsed', isOpen ? 'false' : 'true');
                        }
                    } catch (err) {
                        // ignore
                    }
                }, 60);
            });
        } catch (err) {
            // ignore
        }
    });
</script>
